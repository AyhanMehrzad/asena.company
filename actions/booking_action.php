<?php
require_once '../includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Save the referring URL so they can come back after login
    $_SESSION['redirect_after_login'] = 'booking.php';
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_id = (int)($_POST['doctor_id'] ?? 0);
    $date = $_POST['appointment_date'] ?? '';
    $time = $_POST['appointment_time'] ?? '';
    
    $pet_type = $_POST['pet_type'] ?? '';
    $pet_race = $_POST['pet_race'] ?? '';
    
    // Basic validation
    if ($doctor_id > 0 && !empty($date) && !empty($time) && !empty($pet_type)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, pet_type, pet_race, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
            $stmt->execute([$_SESSION['user_id'], $doctor_id, $date, $time, $pet_type, $pet_race]);
            
            // Award 20 loyalty points for booking
            $pdo->prepare("UPDATE users SET loyalty_points = loyalty_points + 20 WHERE id = ?")->execute([$_SESSION['user_id']]);
            
            // Redirect to payment page
            header("Location: payment.php?type=booking&id=" . $pdo->lastInsertId());
            exit;
        } catch (PDOException $e) {
            $error = "Error saving appointment: " . $e->getMessage();
        }
    } else {
        $error = "لطفا پزشک، تاریخ و زمان را به درستی انتخاب کنید.";
    }
    
    // If we reach here, there was an error. Store it in session and redirect back.
    $_SESSION['booking_error'] = $error ?? "خطای نامشخص";
    header("Location: booking.php");
    exit;
} else {
    // If accessed directly without POST, redirect back to booking page
    header("Location: booking.php");
    exit;
}
?>
