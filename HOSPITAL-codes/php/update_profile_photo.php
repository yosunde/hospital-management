<?php
require_once 'db_connection.php';
header('Content-Type: application/json');



try {
   

    if (!isset($_FILES['photo'])) {
        throw new Exception('No file uploaded');
    }

    $photo = $_FILES['photo'];
    $userId = $_POST['userId'];

    // Hata ayıklama için
    error_log("UserId: " . $userId);
    error_log("Photo: " . print_r($photo, true));

    // Dosya kontrolü
    if ($photo['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('File upload failed');
    }

    // Dosya türü kontrolü
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($photo['type'], $allowedTypes)) {
        throw new Exception('Invalid file type. Only JPG, PNG and GIF allowed.');
    }

    // Dosya boyutu kontrolü (max 5MB)
    if ($photo['size'] > 5 * 1024 * 1024) {
        throw new Exception('File too large. Maximum size is 5MB.');
    }

    // Uploads klasörünü oluştur
    $uploadDir = '../uploads/profile_photos/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Benzersiz dosya adı oluştur
    $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $uploadPath = $uploadDir . $filename;

    // Dosyayı yükle
    if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
        throw new Exception('Failed to save file');
    }

    // Veritabanını güncelle
    $stmt = $conn->prepare("UPDATE patients SET profile_photo = :photo WHERE id = :id");
    $result = $stmt->execute([
        'photo' => $filename,
        'id' => $userId
    ]);

    if (!$result) {
        throw new Exception('Database update failed');
    }

    echo json_encode([
        'success' => true,
        'photoUrl' => '../uploads/profile_photos/' . $filename,
        'message' => 'Profile photo updated successfully'
    ]);

} catch(Exception $e) {
    error_log("Error in update_profile_photo.php: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>