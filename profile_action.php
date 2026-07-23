<?php
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'add_pet') {
        $name = trim($_POST['pet_name'] ?? '');
        $type = trim($_POST['pet_type'] ?? '');
        $race = trim($_POST['pet_race'] ?? '');
        
        if (!empty($name) && !empty($type)) {
            $stmt = $pdo->prepare("INSERT INTO user_pets (user_id, name, type, race) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$user_id, $name, $type, $race])) {
                $_SESSION['profile_success'] = "حیوان خانگی جدید با موفقیت اضافه شد.";
            } else {
                $_SESSION['profile_error'] = "خطا در ثبت حیوان خانگی.";
            }
        } else {
            $_SESSION['profile_error'] = "نام و نوع حیوان الزامی است.";
        }
    } elseif ($action === 'upload_document') {
        $pet_id = (int)($_POST['pet_id'] ?? 0);
        $title = trim($_POST['doc_title'] ?? '');
        
        if ($pet_id > 0 && !empty($title) && isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['document']['tmp_name'];
            $fileName = $_FILES['document']['name'];
            $fileSize = $_FILES['document']['size'];
            $fileType = $_FILES['document']['type'];
            
            $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            if (in_array($fileExtension, $allowedExtensions)) {
                $uploadFileDir = 'uploads/documents/';
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;
                
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $stmt = $pdo->prepare("INSERT INTO pet_documents (pet_id, user_id, title, file_name, file_path) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$pet_id, $user_id, $title, $fileName, $dest_path]);
                    $_SESSION['profile_success'] = "سند با موفقیت آپلود شد.";
                } else {
                    $_SESSION['profile_error'] = "خطا در انتقال فایل.";
                }
            } else {
                $_SESSION['profile_error'] = "فرمت فایل مجاز نیست. فقط PDF، JPG، و PNG پشتیبانی می‌شود.";
            }
        } else {
            $_SESSION['profile_error'] = "لطفاً تمام فیلدها را پر کنید و فایلی انتخاب نمایید.";
        }
    }
}

header("Location: usr_profile.php");
exit;
?>
