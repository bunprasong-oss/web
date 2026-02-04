<?php
session_start();
include 'connect.php';

if (isset($_GET['id'])) {
    $p_id = $_GET['id'];
    $sql = "DELETE FROM products WHERE p_id = $p_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('ลบสินค้าเรียบร้อย'); window.location.href='admin_products.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>