<?php

require('../config.php');
require('../model/Dbconnection.php');

$database = new Database($config['host'], $config['dbname'], $config['username'], $config['password']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatebtn'])) {
    $id = $_POST['id'];
    $name = $_POST['u_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $course = $_POST['course'];

    // Validate inputs and ensure confirm-password matches password
    if ($_POST['password'] !== $_POST['confirm-password']) {
        echo "Passwords do not match.";
        exit();
    }

    // Update the record in the database
    $query = "UPDATE `BookingAppointment` SET `patient_name`='?',`contact`='?',`email`='?',`date`='?',`time`='?',`address`='?',`need`='?',`which_department`='?' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $name, $email, $password, $course, $id);

    if ($stmt->execute()) {
        header("Location:../view/patientlist.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>