<?php
require_once 'db_connection.php';
header('Content-Type: application/json');



try {
    

    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];
    $password = $data['password'];

    // Doktor bilgilerini kontrol et
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE email = :email AND password = :password");
    $stmt->execute([
        'email' => $email,
        'password' => $password
    ]);
    
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($doctor) {
        echo json_encode([
            'success' => true,
            'user' => [
                'id' => $doctor['id'],
                'name' => $doctor['first_name'] . ' ' . $doctor['last_name'],
                'specialty' => $doctor['specialty']
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
