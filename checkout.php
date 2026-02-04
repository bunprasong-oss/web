<?php
session_start();
include 'connect.php';

// 1. ดักจับคนไม่สมัครสมาชิก/ไม่ Login
// ตรวจสอบ user_id (หรือชื่อ session ที่คุณใช้เก็บ id สมาชิก)
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('กรุณาเข้าสู่ระบบสมาชิกก่อนดำเนินการสั่งซื้อครับ');
        window.location.href='login.php'; 
    </script>";
    exit();
}

// 2. ถ้าตะกร้าว่าง ให้เด้งกลับไปหน้าแรก
if (empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit();
}

$grand_total = 0;
foreach ($_SESSION['cart'] as $item) {
    $grand_total += $item['p_price'] * $item['qty'];
}
$final_total = $grand_total + 40;

// 3. เมื่อมีการกดปุ่ม "ยืนยันการสั่งซื้อ"
if (isset($_POST['confirm_order'])) {
    $items_text = "";
    foreach ($_SESSION['cart'] as $item) {
        $items_text .= $item['p_name'] . " (เล่ม " . $item['p_volume'] . ") x " . $item['qty'] . "\n";
    }

    $customer = $_POST['customer_name'];
    $address = $_POST['shipping_address'];
    $phone = $_POST['phone'];
    $user_id = $_SESSION['user_id']; // เก็บ ID สมาชิกไว้ด้วย (ถ้าในตาราง orders มี column นี้)
    
    $full_address = "เบอร์โทร: $phone \nที่อยู่: $address";

    // บันทึกลงฐานข้อมูล (เพิ่ม user_id เข้าไปด้วยเพื่อให้ Admin รู้ว่าเป็นสมาชิกคนไหน)
    $sql = "INSERT INTO orders (customer_name, order_details, total_price, shipping_address) 
            VALUES ('$customer', '$items_text', '$final_total', '$full_address')";

    if ($conn->query($sql) === TRUE) {
        unset($_SESSION['cart']); 
        echo "<script>alert('สั่งซื้อสำเร็จ! ขอบคุณที่เป็นสมาชิกกับเรา'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ชำระเงิน | Manga shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body style="font-family: 'Kanit', sans-serif; background-color: #f4f7f6;">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-dark text-white py-3 rounded-top-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 mx-auto"><i class="fa-solid fa-address-card me-2"></i>ที่อยู่จัดส่งสมาชิก</h5>
                </div>
                <div class="card-body p-4">
                    
                    <div class="alert alert-info py-2 small">
                        <i class="fa-solid fa-user-check me-2"></i> สั่งซื้อในนามสมาชิก: <strong><?= $_SESSION['user_name'] ?? 'Member' ?></strong>
                    </div>

                    <form method="POST">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">ชื่อ-นามสกุล ผู้รับ</label>
                                <input type="text" name="customer_name" class="form-control" 
                                       value="<?= $_SESSION['user_name'] ?? '' ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">เบอร์โทรศัพท์</label>
                                <input type="tel" name="phone" class="form-control" 
                                       placeholder="08x-xxxxxxx" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">ที่อยู่จัดส่งสินค้า</label>
                            <textarea name="shipping_address" class="form-control" rows="3" 
                                      placeholder="บ้านเลขที่ ถนน แขวง/ตำบล เขต/อำเภอ จังหวัด รหัสไปรษณีย์" required></textarea>
                        </div>

                        <div class="bg-light p-3 rounded-3 mb-4 border shadow-sm">
                            <h6 class="fw-bold mb-3 border-bottom pb-2">รายการสินค้าของคุณ</h6>
                            <?php foreach ($_SESSION['cart'] as $item): ?>
                                <div class="d-flex justify-content-between mb-2">
                                    <span><?= $item['p_name'] ?> (เล่ม <?= $item['p_volume'] ?>) x <?= $item['qty'] ?></span>
                                    <span class="fw-bold">฿<?= number_format($item['p_price'] * $item['qty'], 2) ?></span>
                                </div>
                            <?php endforeach; ?>
                            <hr>
                            <div class="d-flex justify-content-between text-danger fw-bold fs-5">
                                <span>ยอดรวมสุทธิ (+ส่ง 40฿)</span>
                                <span>฿<?= number_format($final_total, 2) ?></span>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="confirm_order" class="btn btn-success btn-lg py-3 rounded-pill fw-bold shadow">
                                <i class="fa-solid fa-circle-check me-2"></i> ยืนยันการสั่งซื้อ
                            </button>
                            <a href="cart.php" class="btn btn-outline-secondary btn-sm border-0 mt-2">
                                <i class="fa-solid fa-arrow-left me-1"></i> กลับไปแก้ไขตะกร้า
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>