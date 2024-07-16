<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$config = require('../config.php');

class Database {
    private $host = 'localhost';
    private $dbname = 'finalphp';
    private $username = 'dckap';
    private $password = 'Dckap2023Ecommerce';
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function insertBooking($data) {
        try {
            // Check if the booking already exists for the same date and time
            $checkQuery = "SELECT COUNT(*) FROM BookingAppointment WHERE date = :date AND time = :time";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([
                ':date' => $data['date'],
                ':time' => $data['time']
            ]);
            $count = $checkStmt->fetchColumn();

            if ($count > 0) {
                echo "Booking already exists for this date and time. Please choose a different time.";
            } else {
                // Insert the booking
                $insertQuery = "INSERT INTO BookingAppointment (patient_name, contact, email, date, time, address, need, which_department) 
                                VALUES (:patient_name, :contact, :email, :date, :time, :address, :need, :which_department)";
                $stmt = $this->pdo->prepare($insertQuery);
                $stmt->execute([
                    ':patient_name' => $data['patient_name'],
                    ':contact' => $data['contact'],
                    ':email' => $data['email'],
                    ':date' => $data['date'],
                    ':time' => $data['time'],
                    ':address' => $data['address'],
                    ':need' => $data['need'],
                    ':which_department' => $data['which_department']
                ]);
                echo "Booking appointment successful!";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateBooking($data) {
        try {
            // Check if the booking exists
            $checkQuery = "SELECT COUNT(*) FROM BookingAppointment WHERE id = :id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':id' => $data['id']]);
            $count = $checkStmt->fetchColumn();

            if ($count > 0) {
                // Update the booking
                $updateQuery = "UPDATE BookingAppointment SET 
                                patient_name = :patient_name,
                                contact = :contact,
                                email = :email,
                                date = :date,
                                time = :time,
                                address = :address,
                                need = :need,
                                which_department = :which_department
                                WHERE id = :id";

                $stmt = $this->pdo->prepare($updateQuery);
                $stmt->execute([
                    ':id' => $data['id'],
                    ':patient_name' => $data['patient_name'],
                    ':contact' => $data['contact'],
                    ':email' => $data['email'],
                    ':date' => $data['date'],
                    ':time' => $data['time'],
                    ':address' => $data['address'],
                    ':need' => $data['need'],
                    ':which_department' => $data['which_department']
                ]);

                echo "Booking updated successfully!";
            } else {
                echo "Booking with ID {$data['id']} does not exist.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteBooking($id) {
        try {
            // Check if the booking exists
            $checkQuery = "SELECT COUNT(*) FROM BookingAppointment WHERE id = :id";
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':id' => $id]);
            $count = $checkStmt->fetchColumn();

            if ($count > 0) {
                // Delete the booking
                $deleteQuery = "DELETE FROM BookingAppointment WHERE id = :id";
                $stmt = $this->pdo->prepare($deleteQuery);
                $stmt->execute([':id' => $id]);

                echo "Booking deleted successfully!";
            } else {
                echo "Booking with ID {$id} does not exist.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
