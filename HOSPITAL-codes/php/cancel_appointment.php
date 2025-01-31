<?php
require_once 'db_connection.php';

header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}


try {
    

    // JSON verisini al
    $data = json_decode(file_get_contents('php://input'), true);
    $appointmentId = $data['appointment_id'];

    // Transaction başlat
    $conn->beginTransaction();

    // Randevunun bu kullanıcıya ait olduğunu kontrol et
    $stmt = $conn->prepare("
        SELECT doctor_id, appointment_date, appointment_time 
        FROM appointments 
        WHERE id = :id AND patient_id = :patient_id AND status = 'active'
    ");
    
    $stmt->execute([
        'id' => $appointmentId,
        'patient_id' => $_SESSION['user_id']
    ]);

    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$appointment) {
        throw new Exception('Invalid appointment or already cancelled');
    }

    // Randevuyu iptal et
    $stmt = $conn->prepare("
        UPDATE appointments 
        SET status = 'cancelled' 
        WHERE id = :id
    ");
    
    $stmt->execute(['id' => $appointmentId]);

    // Doktor müsaitliğini güncelle
    $stmt = $conn->prepare("
        UPDATE doctor_availability 
        SET is_booked = FALSE 
        WHERE doctor_id = :doctor_id 
        AND available_date = :date 
        AND available_time = :time
    ");

    $stmt->execute([
        'doctor_id' => $appointment['doctor_id'],
        'date' => $appointment['appointment_date'],
        'time' => $appointment['appointment_time']
    ]);

    $conn->commit();
    echo json_encode(['success' => true]);

} catch(Exception $e) {
    if ($conn) {
        $conn->rollBack();
    }
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
