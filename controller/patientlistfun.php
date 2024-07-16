<?php
// Assuming you have established a PDO database connection ($pdo)
// Replace with your actual database connection details
$host = 'localhost';
$dbname = 'finalphp';
$username = 'dckap';
$password = 'Dckap2023Ecommerce';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to select all rows from BookingAppointment table
    require('../model/patientselect.php');
    
    // Prepare the statement
    $stmt = $pdo->prepare($view_pro);
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch all rows as an associative array
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
