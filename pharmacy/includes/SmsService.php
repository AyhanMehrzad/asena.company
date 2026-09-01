<?php
/**
 * SmsService.php — Meli Payamak SMS Gateway for ASENA Platform
 *
 * Supports both modern Meli Payamak Console REST API (Token-based)
 * and classic BaseServiceNumber pattern/shared lines.
 */

class SmsService {
    private $apiKey;
    private $username;
    private $password;
    private $from;

    // Pattern Body IDs from Melipayamak panel (Can be overridden via .env or constants)
    const BODY_ID_OTP            = '518597'; // کد تایید ورود/ثبت نام/فراموشی رمز (تایید شده)
    const BODY_ID_BOOKING        = '528861'; // تایید رزرو نوبت به کاربر
    const BODY_ID_RESCHEDULE     = '528862'; // تغییر زمان نوبت
    const BODY_ID_SHIPPING       = '528863'; // ارسال سفارش به خریدار
    const BODY_ID_SUBSCRIPTION   = '528864'; // فعال‌سازی بسته اشتراک
    const BODY_ID_CHARITY        = '528865'; // قدردانی خیریه
    const BODY_ID_ADMIN_ORDER    = '528866'; // اطلاع‌رسانی سفارش جدید به مدیر
    const BODY_ID_DOCTOR_BOOKING = '528867'; // اطلاع‌رسانی نوبت جدید به پزشک

    public function __construct() {
        $this->apiKey   = getenv('MELIPAYAMAK_API_KEY') ?: 'd3cbc1e6-79e8-4a25-910e-35e86370cad0';
        $this->username = getenv('MELIPAYAMAK_USERNAME') ?: '09146676978';
        $this->password = getenv('MELIPAYAMAK_PASSWORD') ?: 'NZ456QM9L';
        $this->from     = getenv('MELIPAYAMAK_FROM') ?: '2170007653';
    }

    /**
     * Get effective body ID for a pattern type (reads .env first, then constant)
     */
    public static function getBodyId($type) {
        $envMap = [
            'otp'            => 'MELIPAYAMAK_BODY_ID_OTP',
            'booking'        => 'MELIPAYAMAK_BODY_ID_BOOKING',
            'shipping'       => 'MELIPAYAMAK_BODY_ID_SHIPPING',
            'subscription'   => 'MELIPAYAMAK_BODY_ID_SUBSCRIPTION',
            'charity'        => 'MELIPAYAMAK_BODY_ID_CHARITY',
            'reschedule'     => 'MELIPAYAMAK_BODY_ID_RESCHEDULE',
            'admin_order'    => 'MELIPAYAMAK_BODY_ID_ADMIN_ORDER',
            'doctor_booking' => 'MELIPAYAMAK_BODY_ID_DOCTOR_BOOKING',
        ];

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

        if (isset($envMap[$type])) {
            $envVal = getenv($envMap[$type]);
            if (!empty($envVal)) return $envVal;
        }

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

    /**
     * Send OTP / Verification code
     */
    public function sendOtp($phone, $code) {
        $phone = self::normalizePhone($phone);
        $bodyId = self::getBodyId('otp');
        // Try Console OTP API first
        if (!empty($this->apiKey)) {
            $url = "https://console.melipayamak.com/api/send/otp/{$this->apiKey}";
            $res = $this->postJson($url, ['to' => $phone, 'text' => (string)$code]);
            if (!empty($res['ok'])) return true;
        }
        return $this->sendPatternRequest($phone, $bodyId, [$code]);
    }

    /**
     * Send Booking Confirmation to User
     */
    public function sendBookingConfirmation($phone, $date, $time) {
        $phone = self::normalizePhone($phone);
        $bodyId = self::getBodyId('booking');
        $sent = $this->sendPatternRequest($phone, $bodyId, [$date, $time]);
        if (!$sent) {
            $text = "کاربر گرامی، نوبت ویزیت شما در آسنا برای تاریخ $date ساعت $time با موفقیت تایید شد.\nasena.company";
            $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send Appointment Reschedule Alert
     */
    public function sendAppointmentReschedule($phone, $doctorName, $petName, $newDate, $newTime, $reason = '') {
        $phone = self::normalizePhone($phone);
        $bodyId = self::getBodyId('reschedule');
        $patternSent = $this->sendPatternRequest($phone, $bodyId, [$doctorName, $petName, $newDate, $newTime]);
        if (!$patternSent) {
            $text = "کاربر گرامی آسنا، زمان نوبت ویزیت پت شما ($petName) با دکتر $doctorName به علت «" . ($reason ?: 'موارد فورس‌ماژور و هماهنگی مجدد مطب') . "» به تاریخ $newDate ساعت $newTime تغییر یافت.\nasena.company";
            $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send Shipping / Order status update to buyer
     */
    public function sendShippingUpdate($phone, $orderId) {
        $phone = self::normalizePhone($phone);
        $bodyId = self::getBodyId('shipping');
        $sent = $this->sendPatternRequest($phone, $bodyId, [$orderId]);
        if (!$sent) {
            $text = "سفارش شما به شماره $orderId در آسنا پردازش و تحویل واحد ارسال شد.\nasena.company";
            $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send Subscription Confirmation to user
     */
    public function sendSubscriptionSent($phone, $planName = 'ماهانه') {
        $phone = self::normalizePhone($phone);
        $bodyId = self::getBodyId('subscription');
        $sent = $this->sendPatternRequest($phone, $bodyId, [$planName]);
        if (!$sent) {
            $text = "اشتراک $planName شما در سامانه آسنا با موفقیت فعال گردید.\nasena.company";
            $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send Charity Donation Thank You
     */
    public function sendCharityThankYou($phone, $amount) {
        $phone = self::normalizePhone($phone);
        $formattedAmount = number_format((float)$amount);
        $bodyId = self::getBodyId('charity');
        $sent = $this->sendPatternRequest($phone, $bodyId, [$formattedAmount]);
        if (!$sent) {
            $text = "کاربر گرامی، از حمایت ارزشمند شما به مبلغ $formattedAmount تومان به پویش خیریه حیوانات آسنا سپاسگزاریم.\nasena.company";
            $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send New Order Notification to Admin(s)
     * Supports comma-separated list or array of phone numbers
     */
    public function sendAdminNewOrderAlert($phones, $orderId, $totalAmount) {
        if (empty($phones)) return false;

        $phoneList = is_array($phones) ? $phones : preg_split('/[,\s;]+/', (string)$phones);
        $formattedAmount = number_format((float)$totalAmount);
        $bodyId = self::getBodyId('admin_order');

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
        $bodyId     = self::getBodyId('doctor_booking');

        $sent = $this->sendPatternRequest($phone, $bodyId, [$doctorName, $petName, $date, $time]);
        if (!$sent) {
            $text = "دکتر $doctorName گرامی، نوبت جدید برای پت ($petName) در تاریخ $date ساعت $time در آسنا ثبت شد.\nasena.company";
            $this->sendDirectSms($phone, $text);
        }

        return true;
    }

    /**
     * Send Direct / Simple SMS (Used for general alerts and pattern fallback)
     */
    public function sendDirectSms($phone, $text) {
        $phone = self::normalizePhone($phone);
        if (empty($phone)) return false;

        // Try Console Simple SMS first
        if (!empty($this->apiKey)) {
            $url = "https://console.melipayamak.com/api/send/simple/{$this->apiKey}";
            $res = $this->postJson($url, ['to' => $phone, 'from' => $this->from, 'text' => $text]);
            if (!empty($res['ok'])) return true;
        }

        $data = [
            'username' => $this->username,
            'password' => $this->password,
            'from'     => $this->from,
            'to'       => $phone,
            'text'     => $text,
            'isflash'  => false
        ];
        $url = "https://rest.payamak-panel.com/api/SendSMS/SendSMS";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_TIMEOUT, 6);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * Send Pattern / Shared Service Request (Supports Console REST & BaseServiceNumber REST)
     */
    private function sendPatternRequest($phone, $bodyId, array $textVariables) {
        $phone = self::normalizePhone($phone);
        if (empty($phone)) return false;

        // Try Console Shared API if valid pattern registered
        if (!empty($this->apiKey) && $bodyId !== '12345' && !empty($bodyId)) {
            $url = "https://console.melipayamak.com/api/send/shared/{$this->apiKey}";
            $res = $this->postJson($url, ['to' => $phone, 'bodyId' => (int)$bodyId, 'args' => array_values($textVariables)]);
            if (!empty($res['ok'])) return true;
        }

        // If bodyId is dummy / unapproved, return false to allow graceful direct SMS fallback
        if ($bodyId === '12345' || empty($bodyId)) {
            return false;
        }

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
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_TIMEOUT, 6);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            error_log("SmsService cURL Error: " . $err);
            return false;
        }

        $result = json_decode($response, true);
        if (isset($result['RetStatus']) && $result['RetStatus'] == 1) {
            return true;
        }
        return false;
    }

    private function postJson($url, array $data) {
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $jsonData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_TIMEOUT        => 6,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $decoded = json_decode($response, true);
        $isSuccess = ($httpCode >= 200 && $httpCode < 300) && (!isset($decoded['status']) || (strpos((string)$decoded['status'], 'خطا') === false && strpos((string)$decoded['status'], 'معتبر نیست') === false));

        return ['ok' => $isSuccess, 'data' => $decoded];
    }
}
