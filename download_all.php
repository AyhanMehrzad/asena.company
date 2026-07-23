<?php
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT file_path, file_name FROM pet_documents WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($documents) === 0) {
        $_SESSION['profile_error'] = "هیچ سندی برای دانلود یافت نشد.";
        header("Location: usr_profile.php");
        exit;
    }
    
    $zip = new ZipArchive();
    $zipName = "pet_clinic_documents_" . time() . ".zip";
    $zipPath = "/tmp/" . $zipName; // Use system temp dir
    
    if ($zip->open($zipPath, ZipArchive::CREATE) !== TRUE) {
        die("Could not create zip file.");
    }
    
    foreach ($documents as $doc) {
        if (file_exists($doc['file_path'])) {
            $zip->addFile($doc['file_path'], $doc['file_name']);
        }
    }
    
    $zip->close();
    
    if (file_exists($zipPath)) {
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipName);
        header('Content-Length: ' . filesize($zipPath));
        readfile($zipPath);
        unlink($zipPath); // Delete after download
        exit;
    }
    
} catch (Exception $e) {
    die("Error generating zip: " . $e->getMessage());
}
?>
