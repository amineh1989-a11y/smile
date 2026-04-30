<?php
$conn = new mysqli("localhost", "root", "", "booking_db");
if ($conn->connect_error) {
    die("Erreur connexion");
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=bookings.xls");

echo "ID\tNom\tEmail\tDate\tMessage\tCréé le\n";

$result = $conn->query("SELECT * FROM bookings ORDER BY created_at DESC");

while ($row = $result->fetch_assoc()) {
    echo $row['id'] . "\t" .
         $row['fullname'] . "\t" .
         $row['email'] . "\t" .
         $row['appointment_date'] . "\t" .
         $row['message'] . "\t" .
         $row['created_at'] . "\n";
}

$conn->close();
?>
