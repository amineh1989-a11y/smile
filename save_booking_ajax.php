<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "booking_db");

if ($conn->connect_error) {
    die("DB ERROR: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$appointment_date = $_POST['appointment_date'];
$message = $_POST['message'];

$stmt = $conn->prepare("INSERT INTO bookings (fullname, email, appointment_date, message) VALUES (?, ?, ?, ?)");

if (!$stmt) {
    die("Prepare ERROR: " . $conn->error);
}

$stmt->bind_param("ssss", $fullname, $email, $appointment_date, $message);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Execute ERROR: " . $stmt->error;
}

$stmt->close();
$conn->close();
