<?php
session_start();
// เช็ค Login แอดมิน (ตรวจสอบชื่อ Session ให้ตรงกับที่ใช้ในระบบ Login ของคุณ)
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit();
}
include 'connect.php'; 

// ดึงข้อมูลการสั่งซื้อล่าสุดขึ้นก่อน
$sql = "SELECT * FROM orders ORDER BY order_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายการสั่งซื้อ | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #f4f7f6; }
        .table thead { background-color: #212529; color: white; }
        .order-details { font-size: 0.9rem; line-height: 1.5; }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow mb-4">
        <div class="container">
           <a class="navbar-brand fw-bold fs-3 d-flex align-items-center" href="index.php">
    <img src="https://cdn.discordapp.com/attachments/1466041021946269863/1466476993536327796/1769705730658.png?ex=69817fe1&is=69802e61&hm=192bdda6c5df6ac012b78e78508fd6a8319bf3104138b8484f5d87103136aa42&" 
         alt="Logo" style="height: 40px; margin-right: 10px;">
    MANGA shop</a>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="admin.php">👥 จัดการสมาชิก</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="admin_products.php">📦 จัดการสินค้า</a></li>
                    <li class="nav-item"><a class="nav-link px-3 active" href="admin_orders.php">💰 รายการสั่งซื้อ</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-outline-danger btn-sm" href="logout.php">ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">📦 รายการสั่งซื้อสินค้า</h2>
            <span class="badge bg-primary fs-6">ทั้งหมด <?= $result->num_rows ?> รายการ</span>
        </div>
        
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="py-3">เลขที่ใบสั่งซื้อ</th>
                            <th class="py-3">ลูกค้า / ที่อยู่จัดส่ง</th>
                            <th class="py-3">รายการที่สั่ง</th>
                            <th class="py-3">ยอดรวมสุทธิ</th>
                            <th class="py-3">วันที่สั่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="fw-bold text-center">#<?= $row['order_id'] ?></td>
                            <td>
                                <div class="fw-bold text-primary"><?= htmlspecialchars($row['customer_name']) ?></div>
                                <div class="small text-muted mt-1" style="max-width: 250px;">
                                    <i class="fa-solid fa-location-dot me-1"></i> <?= nl2br(htmlspecialchars($row['shipping_address'])) ?>
                                </div>
                            </td>
                            <td>
                                <div class="order-details p-2 bg-light rounded shadow-sm border-start border-danger border-3">
                                    <?= nl2br(htmlspecialchars($row['order_details'])) ?>
                                </div>
                            </td>
                            <td class="text-danger fw-bold fs-5">฿<?= number_format($row['total_price'], 2) ?></td>
                            <td class="small text-muted">
                                <i class="fa-regular fa-clock me-1"></i> <?= $row['order_date'] ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        
                        <?php if ($result->num_rows == 0): ?>
                            <tr><td colspan="5" class="text-center py-5">ยังไม่มีรายการสั่งซื้อเข้ามา</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>