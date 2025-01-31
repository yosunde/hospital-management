<?php
require_once 'db_connection.php';
header('Content-Type: application/json');



try {
    

    $doctor_id = $_GET['doctor_id'];
    $status = $_GET['status'] ?? 'all';

    $query = "
        SELECT 
            a.id,
            a.appointment_date,
            a.appointment_time,
            a.status,
            p.first_name,
            p.last_name,
            p.tc_number,
            p.date_of_birth,
            p.phone,
            p.weight,
            p.height
        FROM appointments a
        JOIN patients p ON a.patient_id = p.id
        WHERE a.doctor_id = :doctor_id
    ";

    if ($status !== 'all') {
        $query .= " AND a.status = :status";
    }

    $query .= " ORDER BY a.appointment_date DESC, a.appointment_time DESC";

    $stmt = $conn->prepare($query);
    $params = ['doctor_id' => $doctor_id];
    
    if ($status !== 'all') {
        $params['status'] = $status;
    }

    $stmt->execute($params);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($appointments);

} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
