<?php


session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
$conn = new mysqli("localhost", "root", "", "booking_db");
if ($conn->connect_error) {
    die("Erreur connexion");
}

$result = $conn->query("SELECT * FROM bookings ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin - Rendez-vous</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #007bff; color: white; }
    </style>
</head>
<body>

<h2 style="text-align:center;">📋 Liste des rendez-vous</h2>

<div style="text-align:center; margin:20px;">
    <a href="export_excel.php">
        <button style="padding:10px 20px;">📤 Export Excel</button>
    </a>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Date</th>
        <th>Message</th>
        <th>Créé le</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['fullname'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['appointment_date'] ?></td>
        <td><?= $row['message'] ?></td>
        <td><?= $row['created_at'] ?></td>
    </tr>
    <?php } ?>

</table>

</body>
</html>

<?php $conn->close(); ?>
