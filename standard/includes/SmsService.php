<?php
/**
 * SmsService.php — Universal Meli Payamak SMS Gateway for ASENA Platform
 *
 * Supports:
 * 1. Modern Meli Payamak Console REST API (Token-based: /api/send/otp, /api/send/shared, /api/send/simple)
 * 2. Classic Meli Payamak REST API (BaseServiceNumber, SendSMS, GetCredit)
 * 3. Classic Meli Payamak SOAP API (SendByBaseNumber, SendSimpleSMS2, GetCredit)
 * 4. Multi-layer configuration priority (Database site_settings -> .env/getenv -> constants -> defaults)
 */

class SmsService {
    private $apiKey;
    private $username;
    private $password;
    private $from;
    private $pdo;
    private static $lastError = '';
    private static $lastResponse = null;

    // Pattern Body IDs from Melipayamak panel (Can be overridden via DB, .env or constants)
    const BODY_ID_OTP            = '518597'; // کد تایید ورود/ثبت نام/فراموشی رمز
    const BODY_ID_BOOKING        = '528861'; // تایید رزرو نوبت به کاربر
    const BODY_ID_RESCHEDULE     = '528862'; // تغییر زمان نوبت
    const BODY_ID_SHIPPING       = '528863'; // ارسال سفارش به خریدار
    const BODY_ID_SUBSCRIPTION   = '528864'; // فعال‌سازی بسته اشتراک
    const BODY_ID_CHARITY        = '528865'; // قدردانی خیریه
    const BODY_ID_ADMIN_ORDER    = '528866'; // اطلاع‌رسانی سفارش جدید به مدیر
    const BODY_ID_DOCTOR_BOOKING = '528867'; // اطلاع‌رسانی نوبت جدید به پزشک

    public function __construct(?PDO $pdo = null) {
        $this->pdo = $pdo;
        if (!$this->pdo && isset($GLOBALS['pdo']) && $GLOBALS['pdo'] instanceof PDO) {
            $this->pdo = $GLOBALS['pdo'];
        }

        // 1. API Key (Console Token or Web Service Key)
        $this->apiKey = $this->resolveConfig('melipayamak_api_key', 'MELIPAYAMAK_API_KEY', 'd3cbc1e6-79e8-4a25-910e-35e86370cad0');

        // 2. Panel Username
        $this->username = $this->resolveConfig('melipayamak_username', 'MELIPAYAMAK_USERNAME', '09146676978');

        // 3. Panel Password / ApiKey
        $this->password = $this->resolveConfig('melipayamak_password', 'MELIPAYAMAK_PASSWORD', 'NZ456QM9L');

        // 4. Sender Line Number
        $this->from = $this->resolveConfig('melipayamak_from', 'MELIPAYAMAK_FROM', '2170007653');
    }

    /**
     * Resolve configuration value from DB -> getenv -> defined constant -> default
     */
    private function resolveConfig(string $dbKey, string $envKey, string $default): string {
        if ($this->pdo && function_exists('get_setting')) {
            $dbVal = get_setting($this->pdo, $dbKey, null);
            if (!empty($dbVal)) return trim((string)$dbVal);
        }
        $envVal = getenv($envKey);
        if (!empty($envVal)) return trim((string)$envVal);
        if (defined($envKey) && !empty(constant($envKey))) return trim((string)constant($envKey));
        return $default;
    }

    /**
     * Get effective body ID for a pattern type
     */
    public static function getBodyId($type, ?PDO $pdo = null) {
        $type = strtolower(trim($type));
        $dbKey = 'melipayamak_body_id_' . $type;
        $envKey = 'MELIPAYAMAK_BODY_ID_' . strtoupper($type);

        if ($pdo && function_exists('get_setting')) {
            $dbVal = get_setting($pdo, $dbKey, null);
            if (!empty($dbVal)) return trim((string)$dbVal);
        }

        $envVal = getenv($envKey);
        if (!empty($envVal)) return trim((string)$envVal);

        $constMap = [
            'otp'            => self::BODY_ID_OTP,
            'booking'        => self::BODY_ID_BOOKING,
            'shipping'       => self::BODY_ID_SHIPPING,
            'subscription'   => self::BODY_ID_SUBSCRIPTION,
            'charity'        => self::BODY_ID_CHARITY,
            'reschedule'     => self::BODY_ID_RESCHEDULE,
            'admin_order'    => self::BODY_ID_ADMIN_ORDER,
            'doctor_booking' => self::BODY_ID_DOCTOR_BOOKING,
        ];

        return $constMap[$type] ?? '12345';
    }

    /**
     * Normalize Iranian phone number to standard 09... format
     */
    public static function normalizePhone($phone) {
        $phone = trim((string)$phone);
        $phone = preg_replace('/[^\d+]/', '', $phone);
        if (strpos($phone, '+98') === 0) {
            $phone = '0' . substr($phone, 3);
        } elseif (strpos($phone, '0098') === 0) {
            $phone = '0' . substr($phone, 4);
        } elseif (preg_match('/^9\d{9}$/', $phone)) {
            $phone = '0' . $phone;
        }
        return $phone;
    }

    public static function getLastError() {
        return self::$lastError;
    }

    public static function getLastResponse() {
        return self::$lastResponse;
    }

    /**
     * Send OTP / Verification code
     */
    public function sendOtp($phone, $code) {
        $phone = self::normalizePhone($phone);
        if (empty($phone) || strlen($phone) < 10) {
            self::$lastError = 'شماره موبایل گیرنده نامعتبر است.';
            return false;
        }

        $code = (string)$code;
        $bodyId = self::getBodyId('otp', $this->pdo);

        // 1. Try Console OTP API
        if (!empty($this->apiKey)) {
            $url = "https://console.melipayamak.com/api/send/otp/{$this->apiKey}";
            // Try standard OTP JSON payload
            $res = $this->postJson($url, ['to' => $phone, 'text' => $code]);
            if ($res['ok']) return true;

            // Try shared-style OTP JSON payload
            if (!empty($bodyId) && $bodyId !== '12345') {
                $res2 = $this->postJson($url, ['to' => $phone, 'bodyId' => (int)$bodyId, 'args' => [$code]]);
                if ($res2['ok']) return true;
            }
        }

        // 2. Try Pattern Request (Console Shared -> Classic REST BaseServiceNumber -> Classic SOAP)
        $patternSent = $this->sendPatternRequest($phone, $bodyId, [$code]);
        if ($patternSent) {
            return true;
        }

        // 3. Fallback: Direct SMS
        $text = "کد تایید شما در سامانه آسنا: $code\nasena.company";
        return $this->sendDirectSms($phone, $text);
    }

    /**
     * Send Booking Confirmation to User
     */
    public function sendBookingConfirmation($phone, $date, $time) {
        $phone = self::normalizePhone($phone);
        $bodyId = self::getBodyId('booking', $this->pdo);
        $sent = $this->sendPatternRequest($phone, $bodyId, [$date, $time]);
        if (!$sent) {
            $text = "کاربر گرامی، نوبت ویزیت شما در آسنا برای تاریخ $date ساعت $time با موفقیت تایید شد.\nasena.company";
            return $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send Appointment Reschedule Alert
     */
    public function sendAppointmentReschedule($phone, $doctorName, $petName, $newDate, $newTime, $reason = '') {
        $phone = self::normalizePhone($phone);
        $bodyId = self::getBodyId('reschedule', $this->pdo);
        $patternSent = $this->sendPatternRequest($phone, $bodyId, [$doctorName, $petName, $newDate, $newTime]);
        if (!$patternSent) {
            $text = "کاربر گرامی آسنا، زمان نوبت ویزیت پت شما ($petName) با دکتر $doctorName به علت «" . ($reason ?: 'موارد فورس‌ماژور و هماهنگی مجدد مطب') . "» به تاریخ $newDate ساعت $newTime تغییر یافت.\nasena.company";
            return $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send Shipping / Order status update to buyer
     */
    public function sendShippingUpdate($phone, $orderId) {
        $phone = self::normalizePhone($phone);
        $bodyId = self::getBodyId('shipping', $this->pdo);
        $sent = $this->sendPatternRequest($phone, $bodyId, [(string)$orderId]);
        if (!$sent) {
            $text = "سفارش شما به شماره $orderId در آسنا پردازش و تحویل واحد ارسال شد.\nasena.company";
            return $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send Subscription Confirmation to user
     */
    public function sendSubscriptionSent($phone, $planName = 'ماهانه') {
        $phone = self::normalizePhone($phone);
        $bodyId = self::getBodyId('subscription', $this->pdo);
        $sent = $this->sendPatternRequest($phone, $bodyId, [$planName]);
        if (!$sent) {
            $text = "اشتراک $planName شما در سامانه آسنا با موفقیت فعال گردید.\nasena.company";
            return $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send Charity Donation Thank You
     */
    public function sendCharityThankYou($phone, $amount) {
        $phone = self::normalizePhone($phone);
        $formattedAmount = number_format((float)$amount);
        $bodyId = self::getBodyId('charity', $this->pdo);
        $sent = $this->sendPatternRequest($phone, $bodyId, [$formattedAmount]);
        if (!$sent) {
            $text = "کاربر گرامی، از حمایت ارزشمند شما به مبلغ $formattedAmount تومان به پویش خیریه حیوانات آسنا سپاسگزاریم.\nasena.company";
            return $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send New Order Notification to Admin(s)
     */
    public function sendAdminNewOrderAlert($phones, $orderId, $totalAmount) {
        if (empty($phones)) return false;

        $phoneList = is_array($phones) ? $phones : preg_split('/[,\s;]+/', (string)$phones);
        $formattedAmount = number_format((float)$totalAmount);
        $bodyId = self::getBodyId('admin_order', $this->pdo);

        $atLeastOneSent = false;
        foreach ($phoneList as $p) {
            $p = self::normalizePhone($p);
            if (empty($p)) continue;

            $sent = $this->sendPatternRequest($p, $bodyId, [(string)$orderId, $formattedAmount]);
            if (!$sent) {
                $text = "مدیر گرامی، سفارش جدید به شماره $orderId با مبلغ $formattedAmount تومان در سامانه آسنا ثبت شد.\nasena.company";
                $this->sendDirectSms($p, $text);
            }
            $atLeastOneSent = true;
        }

        return $atLeastOneSent;
    }

    /**
     * Send New Appointment Notification to Doctor
     */
    public function sendDoctorNewAppointmentAlert($phone, $doctorName, $petName, $date, $time) {
        $phone = self::normalizePhone($phone);
        if (empty($phone)) return false;

        $doctorName = $doctorName ?: 'همکار گرامی';
        $petName    = $petName ?: 'پت بیمار';
        $bodyId     = self::getBodyId('doctor_booking', $this->pdo);

        $sent = $this->sendPatternRequest($phone, $bodyId, [$doctorName, $petName, $date, $time]);
        if (!$sent) {
            $text = "دکتر $doctorName گرامی، نوبت جدید برای پت ($petName) در تاریخ $date ساعت $time در آسنا ثبت شد.\nasena.company";
            $this->sendDirectSms($phone, $text);
        }

        return true;
    }

    /**
     * Send Pattern / Shared Service Request (Multi-tier: Console Shared -> Classic REST -> Classic SOAP)
     */
    public function sendPatternRequest($phone, $bodyId, array $textVariables) {
        $phone = self::normalizePhone($phone);
        if (empty($phone)) return false;

        // Skip invalid/dummy pattern
        if ($bodyId === '12345' || empty($bodyId)) {
            self::$lastError = 'شناسه پترن تنظیم نشده است.';
            return false;
        }

        // Tier 1: Modern Console Shared REST API
        if (!empty($this->apiKey)) {
            $url = "https://console.melipayamak.com/api/send/shared/{$this->apiKey}";
            $res = $this->postJson($url, ['to' => $phone, 'bodyId' => (int)$bodyId, 'args' => array_values($textVariables)]);
            if (!empty($res['ok'])) {
                self::$lastResponse = $res;
                return true;
            }
        }

        // Tier 2: Classic REST API (BaseServiceNumber)
        $textString = implode(';', $textVariables);
        $data = [
            'username' => $this->username,
            'password' => $this->password,
            'from'     => $this->from,
            'to'       => $phone,
            'text'     => $textString,
            'bodyId'   => $bodyId
        ];
        $url = "https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber";
        $res = $this->postForm($url, $data);
        self::$lastResponse = $res;

        if ($res['ok']) {
            $json = json_decode($res['body'], true);
            if (isset($json['RetStatus']) && ($json['RetStatus'] == 1 || (is_numeric($json['Value']) && (float)$json['Value'] > 100))) {
                return true;
            }
            if (isset($json['Value']) && is_numeric($json['Value']) && (float)$json['Value'] > 100) {
                return true;
            }
        }

        // Tier 3: Classic SOAP API (SendByBaseNumber2)
        $soapRes = $this->sendSoapBaseNumber($phone, $bodyId, $textString);
        if ($soapRes['ok']) {
            self::$lastResponse = $soapRes;
            return true;
        }

        self::$lastError = 'ارسال پیامک با پترن خدماتی ناموفق بود: ' . ($res['body'] ?? $soapRes['error'] ?? 'خطای ناشناخته');
        return false;
    }

    /**
     * Send Direct / Simple SMS (Used for general alerts and fallback)
     */
    public function sendDirectSms($phone, $text) {
        $phone = self::normalizePhone($phone);
        if (empty($phone)) return false;

        // Tier 1: Console Simple SMS
        if (!empty($this->apiKey)) {
            $url = "https://console.melipayamak.com/api/send/simple/{$this->apiKey}";
            $res = $this->postJson($url, ['to' => $phone, 'from' => $this->from, 'text' => $text]);
            if (!empty($res['ok'])) {
                self::$lastResponse = $res;
                return true;
            }
        }

        // Tier 2: Classic REST SendSMS
        $data = [
            'username' => $this->username,
            'password' => $this->password,
            'from'     => $this->from,
            'to'       => $phone,
            'text'     => $text,
            'isflash'  => false
        ];
        $url = "https://rest.payamak-panel.com/api/SendSMS/SendSMS";
        $res = $this->postForm($url, $data);
        self::$lastResponse = $res;

        if ($res['ok']) {
            $json = json_decode($res['body'], true);
            if (isset($json['RetStatus']) && $json['RetStatus'] == 1) {
                return true;
            }
            if (isset($json['Value']) && is_numeric($json['Value']) && (float)$json['Value'] > 100) {
                return true;
            }
        }

        // Tier 3: Classic SOAP SendSimpleSMS2
        $soapRes = $this->sendSoapSimple($phone, $text);
        if ($soapRes['ok']) {
            self::$lastResponse = $soapRes;
            return true;
        }

        self::$lastError = 'ارسال پیامک مستقیم ناموفق بود: ' . ($res['body'] ?? $soapRes['error'] ?? 'خطای نامشخص');
        return false;
    }

    /**
     * Diagnose gateway connectivity & check balance
     */
    public function checkCredit() {
        // 1. Try Classic REST GetCredit
        $url = "https://rest.payamak-panel.com/api/SendSMS/GetCredit";
        $res = $this->postForm($url, ['username' => $this->username, 'password' => $this->password]);
        if ($res['ok']) {
            $json = json_decode($res['body'], true);
            if (isset($json['Value']) && is_numeric($json['Value']) && (float)$json['Value'] >= 0) {
                return ['ok' => true, 'credit' => (float)$json['Value'], 'source' => 'REST'];
            }
        }

        // 2. Try SOAP GetCredit
        $xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <GetCredit xmlns="http://tempuri.org/">
      <username>' . htmlspecialchars($this->username) . '</username>
      <password>' . htmlspecialchars($this->password) . '</password>
    </GetCredit>
  </soap:Body>
</soap:Envelope>';

        $ch = curl_init('http://api.payamak-panel.com/post/Send.asmx');
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $xml,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://tempuri.org/GetCredit"',
                'Content-Length: ' . strlen($xml)
            ],
            CURLOPT_TIMEOUT        => 8,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if (!$err && preg_match('/<GetCreditResult>([-\d\.]+)<\/GetCreditResult>/', (string)$response, $m)) {
            $val = (float)$m[1];
            if ($val >= 0) {
                return ['ok' => true, 'credit' => $val, 'source' => 'SOAP'];
            }
            return ['ok' => false, 'code' => $val, 'error' => self::translateErrorCode($val), 'raw' => $response];
        }

        return ['ok' => false, 'error' => 'امکان دریافت موجودی از سرور ملی‌پیامک وجود ندارد.', 'raw' => $res['body'] ?? $err];
    }

    /**
     * Map Melipayamak numerical error code to descriptive Persian text
     */
    public static function translateErrorCode($code) {
        $code = (int)$code;
        switch ($code) {
            case 0:
            case -111:
                return 'نام کاربری یا رمز عبور اشتباه است.';
            case -108:
                return 'آدرس IP شما به علت درخواست‌های ناموفق مکرر مسدود موقت شده است.';
            case -109:
                return 'الزام به تعریف IP مجاز در پنل ملی پیامک (منوی تنظیمات -> دسترسی وب‌سرویس).';
            case -110:
                return 'الزام به استفاده از ApiKey اختصاصی به جای رمز عبور در وب‌سرویس.';
            case 35:
                return 'شماره گیرنده در لیست سیاه مخابرات است (عدم دریافت پیامک تبلیغاتی). ارسال باید حتماً با الگوی خدماتی (Pattern) انجام شود.';
            default:
                return "کد خطای سامانه ملی‌پیامک: $code";
        }
    }

    private function postJson($url, array $data) {
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $jsonData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_TIMEOUT        => 7,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        $decoded = json_decode($response, true);
        $isSuccess = ($httpCode >= 200 && $httpCode < 300) && (!isset($decoded['status']) || (strpos((string)$decoded['status'], 'خطا') === false && strpos((string)$decoded['status'], 'معتبر نیست') === false));

        return ['ok' => $isSuccess, 'http_code' => $httpCode, 'data' => $decoded, 'body' => $response, 'error' => $err];
    }

    private function postForm($url, array $data) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 7,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        $isSuccess = ($httpCode >= 200 && $httpCode < 300) && empty($err);
        return ['ok' => $isSuccess, 'http_code' => $httpCode, 'body' => $response, 'error' => $err];
    }

    private function sendSoapBaseNumber($phone, $bodyId, $textString) {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <SendByBaseNumber2 xmlns="http://tempuri.org/">
      <username>' . htmlspecialchars($this->username) . '</username>
      <password>' . htmlspecialchars($this->password) . '</password>
      <text>' . htmlspecialchars($textString) . '</text>
      <to>' . htmlspecialchars($phone) . '</to>
      <bodyId>' . (int)$bodyId . '</bodyId>
    </SendByBaseNumber2>
  </soap:Body>
</soap:Envelope>';

        $ch = curl_init('http://api.payamak-panel.com/post/Send.asmx');
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $xml,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://tempuri.org/SendByBaseNumber2"',
                'Content-Length: ' . strlen($xml)
            ],
            CURLOPT_TIMEOUT        => 8,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if (!$err && preg_match('/<SendByBaseNumber2Result>([-\d]+)<\/SendByBaseNumber2Result>/', (string)$response, $m)) {
            $val = (float)$m[1];
            if ($val > 100) {
                return ['ok' => true, 'rec_id' => $val, 'raw' => $response];
            }
        }
        return ['ok' => false, 'error' => $err ?: 'پاسخ ناموفق وب‌سرویس SOAP', 'raw' => $response];
    }

    private function sendSoapSimple($phone, $text) {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <SendSimpleSMS2 xmlns="http://tempuri.org/">
      <username>' . htmlspecialchars($this->username) . '</username>
      <password>' . htmlspecialchars($this->password) . '</password>
      <to>' . htmlspecialchars($phone) . '</to>
      <from>' . htmlspecialchars($this->from) . '</from>
      <text>' . htmlspecialchars($text) . '</text>
      <isflash>false</isflash>
    </SendSimpleSMS2>
  </soap:Body>
</soap:Envelope>';

        $ch = curl_init('http://api.payamak-panel.com/post/Send.asmx');
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $xml,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://tempuri.org/SendSimpleSMS2"',
                'Content-Length: ' . strlen($xml)
            ],
            CURLOPT_TIMEOUT        => 8,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if (!$err && preg_match('/<SendSimpleSMS2Result>([-\d]+)<\/SendSimpleSMS2Result>/', (string)$response, $m)) {
            $val = (float)$m[1];
            if ($val > 100) {
                return ['ok' => true, 'rec_id' => $val, 'raw' => $response];
            }
        }
        return ['ok' => false, 'error' => $err ?: 'پاسخ ناموفق وب‌سرویس SOAP SendSimpleSMS2', 'raw' => $response];
    }
}
