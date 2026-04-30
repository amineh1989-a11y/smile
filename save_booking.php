<?php
session_start();
if(empty($_SESSION['token'])){
    $_SESSION['token'] = bin2hex(random_bytes(32));
}




$conn = new mysqli("localhost", "root", "", "booking_db");
if ($conn->connect_error) {
    die("Erreur connexion");
}

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$date = $_POST['appointment_date'];
$message = $_POST['message'];

$sql = "INSERT INTO bookings (fullname, email, appointment_date, message)
        VALUES ('$fullname', '$email', '$date', '$message')";

if ($conn->query($sql) === TRUE) {

    // ✉️ Email
    $to = $email;
    $subject = "Confirmation de votre rendez-vous";
    $body = "Bonjour $fullname,\n\nVotre rendez-vous est bien enregistré pour le $date.\n\nMerci.";
    $headers = "From: contact@samismile.com";

    mail($to, $subject, $body, $headers);

    header("Location: index.php?success=1");
    exit();
} else {
    echo "Erreur";
}

$conn->close();
?>
