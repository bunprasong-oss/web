<?php
session_start(); // เริ่มต้น Session เพื่อจำค่าล็อกอิน
include 'connect.php'; // ไฟล์เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม register.php
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $style = $_POST['manga_style'];
    $address = $_POST['address'];

    // คำสั่ง SQL สำหรับเพิ่มข้อมูล
    $sql = "INSERT INTO members (firstname, lastname, phone, email, manga_style, address) 
            VALUES ('$fname', '$lname', '$phone', '$email', '$style', '$address')";

    if ($conn->query($sql) === TRUE) {
        // --- ส่วนสำคัญ: เมื่อสมัครเสร็จ ให้ระบบจำชื่อไว้ทันที ---
        $_SESSION['user_id'] = $conn->insert_id; // เก็บ ID ล่าสุด
        $_SESSION['user_name'] = $fname; // เก็บชื่อไว้แสดงที่ Navbar หน้าแรก

        // แจ้งเตือนและดีดกลับไปหน้า index.php (แก้จาก .html เป็น .php เรียบร้อย)
        echo "<script>
                alert('สมัครสมาชิกเรียบร้อยแล้ว! ยินดีต้อนรับคุณ $fname');
                window.location.href = 'index.php';
              </script>";
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
} else {
    // ถ้าไม่ได้มาจากการ Post ให้กลับไปหน้าสมัครสมาชิก
    header("Location: register.php");
    exit();
}
?>