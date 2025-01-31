<?php
require_once 'db_connection.php';
session_start();
header('Content-Type: application/json');



try {
    

    $stmt = $conn->prepare("
        SELECT 
            a.*,
            d.first_name as doctor_first_name,
            d.last_name as doctor_last_name
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.id
        WHERE a.patient_id = :patient_id
        ORDER BY a.appointment_date, a.appointment_time
    ");
    
    $stmt->execute(['patient_id' => $_SESSION['user_id']]);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'appointments' => $appointments
    ]);

} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?> 