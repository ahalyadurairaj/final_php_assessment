<?php
require('../model/Dbconnection.php');
require('../config.php');

$database = new Database($config['host'], $config['dbname'], $config['username'], $config['password']);

if (isset($_GET['id'])) {   
    $id = $_GET['id'];

    $deletequery = 'DELETE FROM `BookingAppointment` WHERE id = ?';
    $stmt = $pdo->prepare($deletequery);

    // Bind parameters
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location:../view/patientlist.php"); // Redirect to index.php
    } else {
        echo "Record not deleted: " . htmlspecialchars($stmt->error); // Debugging line
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
