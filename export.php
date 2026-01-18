<?php
$conn = new mysqli("localhost", "root", "", "booking_db");

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="bookings.csv"');

$output = fopen("php://output", "w");
fputcsv($output, ['ID','Nom','Email','Date','Message']);

$result = $conn->query("SELECT * FROM bookings");

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
$conn->close();
?>
