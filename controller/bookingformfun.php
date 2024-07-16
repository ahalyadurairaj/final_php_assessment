<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../config.php');
require('../model/Dbconnection.php');

$errors = []; // Initialize empty errors array

$database = new Database($config['host'], $config['dbname'], $config['username'], $config['password']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form fields
    $name = validateName($_POST['name']);
    $phone = validatePhone($_POST['phone']);
    $email = validateEmail($_POST['email']);
    $date = $_POST['date']; // No need to validate date, HTML5 date input handles format
    $time = $_POST['time']; // Similarly, no need to validate time format here
    $address = validateAddress($_POST['address']);
    $need = validateTextarea($_POST['need']);
    $department = validateSelect($_POST['department']);

    // Check if any validation errors
    if (empty($errors)) {
        // No errors, proceed to insert into database
        $data = [
            ':name' => $name,
            ':phone' => $phone,
            ':email' => $email,
            ':date' => $date,
            ':time' => $time,
            ':address' => $address,
            ':need' => $need,
            ':department' => $department
        ];

        // Insert data into database
        $database->insertBooking($data);

        // Redirect or display success message
        echo "<script>alert('Booking appointment successful!');</script>";
    }
}

// Function to validate name
function validateName($name) {
    global $errors;
    $trimmedName = trim($name);
    if (empty($trimmedName)) {
        $errors['name'] = "Name is required.";
    }
    return $trimmedName;
}

// Function to validate phone number
function validatePhone($phone) {
    global $errors;
    $trimmedPhone = trim($phone);
    if (empty($trimmedPhone)) {
        $errors['phone'] = "Phone number is required.";
    }
    // Add additional validation rules for phone number if needed
    return $trimmedPhone;
}

// Function to validate email
function validateEmail($email) {
    global $errors;
    $trimmedEmail = trim($email);
    if (empty($trimmedEmail)) {
        $errors['email'] = "Email address is required.";
    } elseif (!filter_var($trimmedEmail, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
    return $trimmedEmail;
}

// Function to validate address
function validateAddress($address) {
    global $errors;
    $trimmedAddress = trim($address);
    if (empty($trimmedAddress)) {
        $errors['address'] = "Address is required.";
    }
    // Add additional validation rules for address if needed
    return $trimmedAddress;
}

// Function to validate textarea (need)
function validateTextarea($need) {
    global $errors;
    $trimmedNeed = trim($need);
    if (empty($trimmedNeed)) {
        $errors['need'] = "Need is required.";
    }
    return $trimmedNeed;
}

// Function to validate select (department)
function validateSelect($department) {
    global $errors;
    if ($department === 'Select Option') {
        $errors['department'] = "Please select a department.";
    }
    return $department;
}

header("Location:../view/patientlist.php");
// Include the HTML form where errors will be displayed
// require('../view/index.html');
?>
