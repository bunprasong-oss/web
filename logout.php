<?php
session_start();
session_destroy(); // ล้างข้อมูลการเข้าสู่ระบบทั้งหมด
header("Location: login.php"); // เด้งกลับไปหน้าล็อกอินแอดมิน
exit();
?>