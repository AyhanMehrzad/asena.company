<?php
/**
 * ASENA Enterprise OAuth Callback Handler
 * Supports Google Identity Services (GSI credential/id_token), Google OAuth2 Code Flow, and Apple Sign-In
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/config.php';

// Determine provider: Apple posts id_token or code; Google sends code, credential, or id_token
$provider = $_GET['provider'] ?? '';
if (!$provider) {
    if (isset($_POST['credential']) || (isset($_POST['id_token']) && isset($_POST['g_csrf_token']))) {
        $provider = 'google';
    } elseif (isset($_POST['id_token'])) {
        $provider = 'apple';
    } else {
        $provider = 'google';
    }
}

if (!in_array($provider, ['google', 'apple'])) {
    header('Location: ../login.php?error=' . urlencode('سرویس‌دهنده ورود نامعتبر است.'));
    exit;
}

$id_column = $provider === 'google' ? 'google_id' : 'apple_id';
$oauth_id = null;
$oauth_email = null;
$oauth_name = 'کاربر ' . ($provider === 'google' ? 'گوگل' : 'اپل');

if ($provider === 'google') {
    // 1. Check for Google Identity Services (GSI) credential / id_token (from One Tap or GSI button)
    $google_token = $_POST['credential'] ?? $_POST['id_token'] ?? null;
    
    if ($google_token) {
        // Verify token directly with Google Tokeninfo API
        $ch = curl_init('https://oauth2.googleapis.com/tokeninfo?id_token=' . urlencode($google_token));
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT        => 10
        ]);
        $verify_res = curl_exec($ch);
        $verify_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $payload = json_decode($verify_res, true);
        if ($verify_code === 200 && !empty($payload['sub'])) {
            $oauth_id = $payload['sub'];
            $oauth_email = $payload['email'] ?? null;
            $oauth_name = $payload['name'] ?? $oauth_name;
        } else {
            // Fallback to JWT payload decode if tokeninfo is unreachable
            $parts = explode('.', $google_token);
            if (count($parts) >= 2) {
                $decoded = json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true);
                if (!empty($decoded['sub'])) {
                    $oauth_id = $decoded['sub'];
                    $oauth_email = $decoded['email'] ?? null;
                    $oauth_name = $decoded['name'] ?? $oauth_name;
                }
            }
        }
    } 
    // 2. Fallback: Google OAuth2 Authorization Code flow
    elseif (isset($_GET['code'])) {
        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query([
                'code'          => $_GET['code'],
                'client_id'     => GOOGLE_CLIENT_ID,
                'client_secret' => GOOGLE_CLIENT_SECRET,
                'redirect_uri'  => GOOGLE_REDIRECT_URI,
                'grant_type'    => 'authorization_code'
            ]),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT        => 10
        ]);
        $response = curl_exec($ch);
        $curl_err = curl_error($ch);
        curl_close($ch);

        if ($curl_err) {
            header('Location: ../login.php?error=' . urlencode('خطای ارتباط با سرور گوگل: ' . $curl_err));
            exit;
        }

        $data = json_decode($response, true);
        
        if (!empty($data['access_token'])) {
            $ch2 = curl_init('https://www.googleapis.com/oauth2/v2/userinfo');
            curl_setopt_array($ch2, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $data['access_token']],
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_TIMEOUT        => 10
            ]);
            $user_response = curl_exec($ch2);
            curl_close($ch2);
            
            $user_info = json_decode($user_response, true);
            if (!empty($user_info['id'])) {
                $oauth_id = $user_info['id'];
                $oauth_email = $user_info['email'] ?? null;
                $oauth_name = $user_info['name'] ?? $oauth_name;
            }
        }
    }

    if (!$oauth_id) {
        $err_msg = isset($_GET['error']) ? $_GET['error'] : 'اطلاعات حساب کاربری از گوگل دریافت نشد.';
        header('Location: ../login.php?error=' . urlencode('ورود با گوگل ناموفق بود: ' . $err_msg));
        exit;
    }
} elseif ($provider === 'apple') {
    if (!isset($_POST['id_token'])) {
        header('Location: ../login.php?error=' . urlencode('شناسه امنیتی اپل یافت نشد.'));
        exit;
    }
    
    $token_parts = explode('.', $_POST['id_token']);
    if (count($token_parts) >= 2) {
        $payload = json_decode(base64_decode(strtr($token_parts[1], '-_', '+/')), true);
        if (isset($payload['sub'])) {
            $oauth_id = $payload['sub'];
            $oauth_email = $payload['email'] ?? null;
            
            if (isset($_POST['user'])) {
                $user_json = json_decode($_POST['user'], true);
                if (isset($user_json['name'])) {
                    $oauth_name = trim(($user_json['name']['firstName'] ?? '') . ' ' . ($user_json['name']['lastName'] ?? ''));
                }
            }
        }
    }
    
    if (!$oauth_id) {
        header('Location: ../login.php?error=' . urlencode('ساختار شناسه اپل نامعتبر است.'));
        exit;
    }
}

try {
    // 1. Check if user already linked with this OAuth ID
    $stmt = $pdo->prepare("SELECT id, name, role, phone, email FROM users WHERE $id_column = ?");
    $stmt->execute([$oauth_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. If not found by OAuth ID, check if email matches an existing user account
    if (!$user && !empty($oauth_email)) {
        $stmt_email = $pdo->prepare("SELECT id, name, role, phone, email FROM users WHERE email = ?");
        $stmt_email->execute([$oauth_email]);
        $existing_user = $stmt_email->fetch(PDO::FETCH_ASSOC);
        
        if ($existing_user) {
            // Link this OAuth account to the existing user
            $update_stmt = $pdo->prepare("UPDATE users SET $id_column = ? WHERE id = ?");
            $update_stmt->execute([$oauth_id, $existing_user['id']]);
            $user = $existing_user;
        }
    }

    if ($user) {
        // Log in user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_name'] = $user['name'] ?: $oauth_name;
        if (!empty($user['phone'])) {
            $_SESSION['user_phone'] = $user['phone'];
        }
        
        // If unverified dummy phone
        if (strpos($user['phone'] ?? '', '09OAUTH') === 0) {
            header('Location: ../complete_profile.php');
            exit;
        }
    } else {
        // Register new OAuth user
        $mock_phone = '09OAUTH' . rand(10000, 99999) . time();
        $insert = $pdo->prepare("INSERT INTO users (phone, name, email, $id_column, loyalty_points, role) VALUES (?, ?, ?, ?, 50, 'user')");
        $insert->execute([$mock_phone, $oauth_name, $oauth_email, $oauth_id]);
        
        $new_user_id = $pdo->lastInsertId();
        $_SESSION['user_id'] = $new_user_id;
        $_SESSION['user_role'] = 'user';
        $_SESSION['user_name'] = $oauth_name;
        $_SESSION['user_phone'] = $mock_phone;
        
        header('Location: ../complete_profile.php');
        exit;
    }

    header('Location: ../index.php');
    exit;
} catch (PDOException $e) {
    header('Location: ../login.php?error=' . urlencode('خطای پایگاه داده در ذخیره اطلاعات کاربری: ' . $e->getMessage()));
    exit;
}
