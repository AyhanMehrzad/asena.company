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

    // Pattern Body IDs from Melipayamak panel
    const BODY_ID_OTP          = '12345'; // کد تایید
    const BODY_ID_BOOKING      = '12345'; // رزرو نوبت
    const BODY_ID_SHIPPING     = '12345'; // ارسال سفارش
    const BODY_ID_SUBSCRIPTION = '12345'; // بسته اشتراک
    const BODY_ID_CHARITY      = '12345'; // خیریه
    const BODY_ID_RESCHEDULE   = '12345'; // تغییر زمان نوبت

    public function __construct() {
        $this->apiKey   = 'd3cbc1e6-79e8-4a25-910e-35e86370cad0';
        $this->username = '09146676978';
        $this->password = 'NZ456QM9L';
        $this->from     = '2170007653';
    }

    /**
     * Normalize Iranian phone number to standard 09... format
     */
    public static function normalizePhone($phone) {
        $phone = trim($phone);
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
        // Try Console OTP API first
        if (!empty($this->apiKey)) {
            $url = "https://console.melipayamak.com/api/send/otp/{$this->apiKey}";
            $res = $this->postJson($url, ['to' => $phone, 'text' => (string)$code]);
            if (!empty($res['ok'])) return true;
        }
        return $this->sendPatternRequest($phone, self::BODY_ID_OTP, [$code]);
    }

    /**
     * Send Booking Confirmation
     */
    public function sendBookingConfirmation($phone, $date, $time) {
        $phone = self::normalizePhone($phone);
        return $this->sendPatternRequest($phone, self::BODY_ID_BOOKING, [$date, $time]);
    }

    /**
     * Send Appointment Reschedule Alert
     */
    public function sendAppointmentReschedule($phone, $doctorName, $petName, $newDate, $newTime, $reason = '') {
        $phone = self::normalizePhone($phone);
        $patternSent = $this->sendPatternRequest($phone, self::BODY_ID_RESCHEDULE, [$doctorName, $petName, $newDate, $newTime]);
        if (!$patternSent) {
            $text = "کاربر گرامی آسنا، زمان نوبت ویزیت پت شما ($petName) با دکتر $doctorName به علت «" . ($reason ?: 'موارد فورس‌ماژور و هماهنگی مجدد مطب') . "» به تاریخ $newDate ساعت $newTime تغییر یافت.\nasena.company";
            $this->sendDirectSms($phone, $text);
        }
        return true;
    }

    /**
     * Send Direct SMS
     */
    public function sendDirectSms($phone, $text) {
        $phone = self::normalizePhone($phone);
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
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function sendShippingUpdate($phone, $orderId) {
        $phone = self::normalizePhone($phone);
        return $this->sendPatternRequest($phone, self::BODY_ID_SHIPPING, [$orderId]);
    }

    public function sendSubscriptionSent($phone) {
        $phone = self::normalizePhone($phone);
        return $this->sendPatternRequest($phone, self::BODY_ID_SUBSCRIPTION, ['ماهانه']);
    }

    public function sendCharityThankYou($phone, $amount) {
        $phone = self::normalizePhone($phone);
        $formattedAmount = number_format($amount);
        return $this->sendPatternRequest($phone, self::BODY_ID_CHARITY, [$formattedAmount]);
    }

    private function sendPatternRequest($phone, $bodyId, array $textVariables) {
        $phone = self::normalizePhone($phone);

        // Try Console Shared API if valid pattern registered
        if (!empty($this->apiKey) && $bodyId !== '12345') {
            $url = "https://console.melipayamak.com/api/send/shared/{$this->apiKey}";
            $res = $this->postJson($url, ['to' => $phone, 'bodyId' => (int)$bodyId, 'args' => array_values($textVariables)]);
            if (!empty($res['ok'])) return true;
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
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
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
