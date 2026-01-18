<?php
// 1. ربط مع قاعدة البيانات
$conn = new mysqli("localhost", "root", "", "booking_test");

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات");
}

// 2. استقبال البيانات من الفورم
$fullname = $_POST['fullname'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$date     = $_POST['date'];
$message  = $_POST['message'];

// 3. إدخال البيانات لقاعدة البيانات
$sql = "INSERT INTO bookings
(fullname, email, phone, appointment_date, message)
VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss",
    $fullname,
    $email,
    $phone,
    $date,
    $message
);

$stmt->execute();

// 4. إغلاق الاتصال
$stmt->close();
$conn->close();

// 5. رسالة نجاح
echo "تم تسجيل الحجز بنجاح";
?>
