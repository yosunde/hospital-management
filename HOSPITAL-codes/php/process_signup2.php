<?php
require_once 'db_connection.php';
session_start();


try {
    
    // Debug için session verilerini kontrol et
    var_dump($_SESSION);
    var_dump($_POST);
    
    // Session'dan email ve şifre bilgilerini al
    $email = $_SESSION['signup_email'];
    $password = $_SESSION['signup_password'];
    
    // Form verilerini al
    $first_name = $_POST['name'];
    $last_name = $_POST['surname'];
    $tc_number = $_POST['tc'];
    $date_of_birth = $_POST['dob'];
    $phone = $_POST['phone'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    
    // SQL sorgusu
    $sql = "INSERT INTO patients (email, password, first_name, last_name, tc_number, date_of_birth, phone, weight, height) 
            VALUES (:email, :password, :first_name, :last_name, :tc_number, :date_of_birth, :phone, :weight, :height)";
    
    $stmt = $conn->prepare($sql);
    
    // Parametreleri bağla
    $params = [
        'email' => $email,
        'password' => $password,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'tc_number' => $tc_number,
        'date_of_birth' => $date_of_birth,
        'phone' => $phone,
        'weight' => $weight,
        'height' => $height
    ];
    
    // Debug için parametreleri kontrol et
    var_dump($params);
    
    $stmt->execute($params);
    
    // Session'ı temizle
    session_destroy();
    
    // Başarılı kayıt sonrası yönlendirme
    header("Location: ../html/thank.html");
    exit();
    
} catch(PDOException $e) {
    echo "Kayıt işlemi başarısız: " . $e->getMessage();
    // Hata detaylarını göster
    var_dump($e->getTrace());
}

$conn = null;
?>