<?php
session_start();
if (!isset($_SESSION['admin_login'])) { exit; }
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM members WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php"); // ลบเสร็จเด้งกลับหน้าเดิม
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>