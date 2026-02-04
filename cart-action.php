<?php
session_start();
include 'connect.php'; // เผื่อต้องใช้ตรวจสอบข้อมูลจาก DB

if (isset($_POST['add_to_cart'])) {
    // 1. รับค่าจากฟอร์ม (ให้ตรงกับ name ในหน้า product-detail.php)
    $p_id     = $_POST['p_id'];
    $p_name   = $_POST['p_name'];
    $p_price  = $_POST['p_price'];
    $p_img    = $_POST['p_img'];
    $p_volume = $_POST['p_volume']; // รับหมายเลขเล่มที่เลือก
    $qty      = (int)$_POST['qty'];

    // 2. สร้าง Key พิเศษสำหรับเช็คสินค้า (ID + เล่ม) 
    // เพื่อให้สั่งเรื่องเดียวกันแต่คนละเล่มได้ เช่น Naruto เล่ม 1 และ Naruto เล่ม 2
    $cart_key = $p_id . "_v" . $p_volume;

    // 3. ตรวจสอบว่ามีตะกร้าหรือยัง
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // 4. ถ้ามีสินค้านี้ (เล่มนี้) อยู่ในตะกร้าแล้ว ให้เพิ่มแค่จำนวน (Qty)
    if (isset($_SESSION['cart'][$cart_key])) {
        $_SESSION['cart'][$cart_key]['qty'] += $qty;
    } else {
        // ถ้ายังไม่มี ให้เพิ่มเข้าไปใหม่
        $_SESSION['cart'][$cart_key] = [
            'p_id'     => $p_id,
            'p_name'   => $p_name,
            'p_volume' => $p_volume,
            'p_price'  => $p_price,
            'p_img'    => $p_img,
            'qty'      => $qty
        ];
    }

    // 5. ส่งไปหน้า cart.php
    header("Location: cart.php");
    exit();
} else {
    // ถ้าไม่ได้มาจากการกดปุ่ม Add to Cart ให้ส่งกลับหน้าแรก
    header("Location: index.php");
    exit();
}