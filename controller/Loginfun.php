<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start session for storing logged-in user information

// Include config.php to access database credentials
$config = require("../config.php");

// Extract database credentials from $config array
$host = $config['host'];
$dbname = $config['dbname'];
$username = $config['username'];
$password = $config['password'];


$pass = $_POST['password'];
try {

    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginsubmit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            echo "<script>alert('Please enter both email and password');</script>";
        } else {

            // Prepare SQL statement to retrieve user by email
           require('../model/selectdocter.php');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && $password == $user['password']) {
                
                // Password matched, store user information in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];

                // Redirect to home page after successful login
                header("Location: ../view/patientlist.php");
                exit();
            } else {

                // Password is incorrect or user not found
                echo "<script>alert('Email or password is incorrect');</script>";
            }
        }
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
