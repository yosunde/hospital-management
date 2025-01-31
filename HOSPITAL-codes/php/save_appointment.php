<?php
require_once 'db_connection.php';
header('Content-Type: application/json');
session_start();

// Debug için
error_log("Save appointment started");
error_log("Session data: " . json_encode($_SESSION));

if (!isset($_SESSION['user_id'])) {
    error_log("No session user_id found");
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

try {
    // POST verilerini al ve logla
    $postData = file_get_contents('php://input');
    error_log("Received POST data: " . $postData);
    
    $data = json_decode($postData, true);
    if (!$data) {
        throw new Exception('Invalid JSON data received');
    }

    $doctorId = $data['doctor_id'];
    list($date, $time) = explode(' ', $data['time']);
    $patientId = $_SESSION['user_id'];

    error_log("Processing appointment for: Doctor ID: $doctorId, Date: $date, Time: $time, Patient ID: $patientId");

    // Direkt olarak appointments tablosuna ekle
    $stmt = $conn->prepare("
        INSERT INTO appointments (
            patient_id,
            doctor_id,
            appointment_date,
            appointment_time,
            status
        ) VALUES (
            :patient_id,
            :doctor_id,
            :date,
            :time,
            'active'
        )
    ");

    $result = $stmt->execute([
        'patient_id' => $patientId,
        'doctor_id' => $doctorId,
        'date' => $date,
        'time' => $time
    ]);

    if ($result) {
        error_log("Appointment saved successfully");
        echo json_encode(['success' => true]);
    } else {
        error_log("Failed to save appointment");
        echo json_encode(['success' => false, 'message' => 'Failed to save appointment']);
    }

} catch(Exception $e) {
    error_log("Error in save_appointment: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
