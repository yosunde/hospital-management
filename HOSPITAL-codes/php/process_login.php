<?php
require_once 'db_connection.php';
header('Content-Type: application/json');



try {
    

    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];
    $password = $data['password'];

    // Kullanıcı bilgilerini al
    $stmt = $conn->prepare("SELECT * FROM patients WHERE email = :email AND password = :password");
    $stmt->execute([
        'email' => $email,
        'password' => $password
    ]);
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Oturum başlat ve kullanıcı bilgilerini sakla
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
        
        echo json_encode([
            'success' => true,
            'user' => [
                'name' => $user['first_name'] . ' ' . $user['last_name']
            ]
        ]);
    } else {
        echo json_encode(['success' => false]);
    }

} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}

$conn = null;
?>
