<?php
session_start();
include 'connect.php';

// ดึงข้อมูลสินค้าทั้งหมด
$sql = "SELECT * FROM products ORDER BY p_id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการสินค้า | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Kanit', sans-serif; background-color: #f4f7f6;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <img src="https://cdn.discordapp.com/attachments/1466041021946269863/1466476993536327796/1769705730658.png?ex=69817fe1&is=69802e61&hm=192bdda6c5df6ac012b78e78508fd6a8319bf3104138b8484f5d87103136aa42&" 
         alt="Logo" style="height: 40px; margin-right: 10px;">
    MANGA shop
</a>
            <div class="ms-auto">
                <a href="add_product.php" class="btn btn-success btn-sm">+ เพิ่มสินค้าใหม่</a>
                <a href="admin.php" class="btn btn-outline-light btn-sm">จัดการสมาชิก</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="fw-bold mb-4">📦 รายการสินค้าทั้งหมด</h2>
        <div class="card border-0 shadow-sm p-4">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>รูป</th>
                        <th>ชื่อสินค้า</th>
                        <th>หมวดหมู่</th>
                        <th>ราคา</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><img src="<?= $row['p_img'] ?>" style="width: 50px; height: 70px; object-fit: cover; border-radius: 5px;"></td>
                        <td class="fw-bold"><?= $row['p_name'] ?></td>
                        <td><?= $row['p_category'] ?></td>
                        <td class="text-danger">฿<?= number_format($row['p_price'], 2) ?></td>
                        <td>
                            <a href="delete_product.php?id=<?= $row['p_id'] ?>" 
                               class="btn btn-outline-danger btn-sm" 
                               onclick="return confirm('ยืนยันการลบสินค้าชิ้นนี้?')">ลบ</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>