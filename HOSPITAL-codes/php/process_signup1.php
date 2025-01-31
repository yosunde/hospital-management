<?php
require_once 'db_connection.php';
session_start();

// Debug için
error_log("POST verisi: " . print_r($_POST, true));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // JSON verisi olarak gelip gelmediğini kontrol et
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if ($data) {
        // JSON verisi
        $email = $data['email'];
        $password = $data['password'];
    } else {
        // Normal POST verisi
        $email = $_POST['email'];
        $password = $_POST['password'];
    }
    
    // Session'a kaydet
    $_SESSION['signup_email'] = $email;
    $_SESSION['signup_password'] = $password;
    
    // Debug için
    error_log("Session kaydedildi: " . print_r($_SESSION, true));
    
    // Başarılı yanıt
    echo json_encode(['status' => 'success']);
    exit();
}
?>