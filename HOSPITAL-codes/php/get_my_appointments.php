<?php
// Önceki çıktıları temizle
ob_start();

session_start();
require_once 'db_connection.php';

// Tüm çıktıları temizle
ob_end_clean();

// Sadece JSON header'ı ayarla
header('Content-Type: application/json');

try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Not logged in');
    }

    $sql = "SELECT 
            a.*,
            CONCAT(d.first_name, ' ', d.last_name) as doctor_name,
            d.specialty as doctor_specialty,
            d.email as doctor_email,
            CONCAT(p.first_name, ' ', p.last_name) as patient_name,
            p.tc_number,
            p.phone as patient_phone
            FROM appointments a
            LEFT JOIN doctors d ON d.id = a.doctor_id
            LEFT JOIN patients p ON p.id = a.patient_id
            WHERE a.patient_id = ? 
            AND a.status = 'active'
            ORDER BY a.appointment_date ASC, a.appointment_time ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    die(json_encode([
        'status' => 'success',
        'data' => $appointments
    ]));

} catch (Exception $e) {
    die(json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]));
}
?>
