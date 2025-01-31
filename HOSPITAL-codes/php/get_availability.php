<?php
require_once 'db_connection.php';
header('Content-Type: application/json');

try {
    if (!isset($_GET['doctor_id'])) {
        throw new Exception('Doctor ID is required');
    }

    $doctorId = $_GET['doctor_id'];
    
    // Bugünden itibaren müsait zamanları getir
    $stmt = $conn->prepare("
        SELECT available_date, available_time 
        FROM doctor_availability 
        WHERE doctor_id = :doctor_id 
        AND available_date >= CURDATE() 
        AND is_booked = 0 
        ORDER BY available_date, available_time
    ");
    
    $stmt->execute(['doctor_id' => $doctorId]);
    $availability = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($availability)) {
        echo json_encode(['message' => 'No available appointments']);
    } else {
        echo json_encode($availability);
    }

} catch(Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
