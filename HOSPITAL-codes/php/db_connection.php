<?php
$servername = "sql210.infinityfree.com";  // MySQL hostname
$username = "if0_38087799";               // MySQL username
$password = "mesuruah1234";                   // Veritabanı oluştururken verdiğiniz şifre
$dbname = "if0_38087799_clinic_appointments";         // Database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>