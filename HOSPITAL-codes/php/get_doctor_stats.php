<?php
require_once 'db_connection.php';
header('Content-Type: application/json');



try {
    
    $doctor_id = $_GET['doctor_id'];
    $today = date('Y-m-d');

    // Bugünkü randevuları say
    $stmt = $conn->prepare("
        SELECT COUNT(*) as today 
        FROM appointments 
        WHERE doctor_id = :doctor_id 
        AND appointment_date = :today
    ");
    $stmt->execute(['doctor_id' => $doctor_id, 'today' => $today]);
    $todayCount = $stmt->fetch(PDO::FETCH_ASSOC)['today'];

    // Aktif randevuları say
    $stmt = $conn->prepare("
        SELECT COUNT(*) as active 
        FROM appointments 
        WHERE doctor_id = :doctor_id 
        AND status = 'active'
    ");
    $stmt->execute(['doctor_id' => $doctor_id]);
    $activeCount = $stmt->fetch(PDO::FETCH_ASSOC)['active'];

    // Toplam hasta sayısı (tekil hasta sayısı)
    $stmt = $conn->prepare("
        SELECT COUNT(DISTINCT patient_id) as total 
        FROM appointments 
        WHERE doctor_id = :doctor_id
    ");
    $stmt->execute(['doctor_id' => $doctor_id]);
    $totalPatients = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    echo json_encode([
        'today' => $todayCount,
        'active' => $activeCount,
        'total' => $totalPatients
    ]);

} catch(PDOException $e) {
    echo json_encode([
        'error' => $e->getMessage(),
        'today' => 0,
        'active' => 0,
        'total' => 0
    ]);
}
?>
