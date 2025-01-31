<?php
require_once 'db_connection.php';
header('Content-Type: application/json');



try {
    

    $data = json_decode(file_get_contents('php://input'), true);
    $doctorId = $data['doctorId'];
    $selectedDate = $data['date'];
    
    $stmt = $conn->prepare("
        SELECT available_time 
        FROM doctor_availability 
        WHERE doctor_id = :doctorId 
        AND available_date = :selectedDate 
        AND is_booked = FALSE
        ORDER BY available_time
    ");
    
    $stmt->execute([
        'doctorId' => $doctorId,
        'selectedDate' => $selectedDate
    ]);
    
    $times = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo json_encode([
        'success' => true,
        'times' => $times
    ]);

} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
