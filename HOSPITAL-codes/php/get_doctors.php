<?php
require_once 'db_connection.php';
header('Content-Type: application/json');

try {
    if (!isset($_GET['department'])) {
        throw new Exception('Department parameter is required');
    }

    $department = trim($_GET['department']);
    
    // Virgülden sonraki boşlukları standardize et
    $department = preg_replace('/,\s*/', ', ', $department);
    
    // Debug için
    error_log("Searching for department: " . $department);
    
    // SQL sorgusunda REPLACE kullan
    $stmt = $conn->prepare("
        SELECT id, first_name, last_name 
        FROM doctors 
        WHERE REPLACE(REPLACE(LOWER(TRIM(specialty)), ',', ', '), '  ', ' ') = LOWER(:specialty)
    ");
    
    $stmt->execute(['specialty' => $department]);
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($doctors);

} catch(Exception $e) {
    error_log("Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
