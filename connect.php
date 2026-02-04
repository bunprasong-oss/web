<?php
$servername = "localhost";
$username = "root"; // ปกติคือ root
$password = "";     // ปกติจะว่างไว้ถ้าใช้ XAMPP
$dbname = "finalboss";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("ขออภัย! การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// ตั้งค่าภาษาไทย
$conn->set_charset("utf8mb4");
?>
