<?php
require_once 'db_connection.php';
header('Content-Type: application/json');

try {
    // Sadece uzmanlık alanlarını çek
    $stmt = $conn->prepare("SELECT DISTINCT specialty FROM doctors ORDER BY specialty");
    $stmt->execute();
    $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($departments === false) {
        throw new Exception('No departments found');
    }
    
    echo json_encode($departments);

} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch(Exception $e) {
    http_response_code(404);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
