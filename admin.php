<?php
session_start();

// 1. ระบบรักษาความปลอดภัย: ถ้าไม่ได้ Login ให้เด้งไปหน้า login.php
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit();
}

// 2. เชื่อมต่อฐานข้อมูล
include 'connect.php'; 

// 3. ดึงข้อมูลสมาชิกทั้งหมดจากตาราง users (แก้ไขจาก members เป็น users ตามฐานข้อมูลจริง)
$sql = "SELECT * FROM users ORDER BY u_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Manga shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #f4f7f6; }
        .navbar { background-color: #1d3557; }
        .table-card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .badge-style { font-size: 0.8rem; padding: 5px 12px; border-radius: 20px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow mb-4">
    <div class="container">
      <a class="navbar-brand fw-bold fs-3 d-flex align-items-center" href="index.php">
    <img src="https://cdn.discordapp.com/attachments/1466041021946269863/1466476993536327796/1769705730658.png?ex=69817fe1&is=69802e61&hm=192bdda6c5df6ac012b78e78508fd6a8319bf3104138b8484f5d87103136aa42&" 
         alt="Logo" style="height: 40px; margin-right: 10px;">
    MANGA shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link px-3" href="admin.php">👥 จัดการสมาชิก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="admin_products.php">📦 จัดการสินค้า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="admin_orders.php">💰 รายการสั่งซื้อ</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-outline-danger btn-sm" href="logout.php">ออกจากระบบ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold">จัดการข้อมูลสมาชิก</h2>
                <p class="text-muted">ตรวจสอบรายชื่อลูกค้าที่สมัครสมาชิกผ่านหน้าเว็บไซต์</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="bg-white p-3 rounded-3 shadow-sm border-start border-4 border-primary">
                    <small class="text-muted d-block">จำนวนสมาชิกทั้งหมด</small>
                    <span class="h3 fw-bold"><?= $result->num_rows ?></span> คน
                </div>
            </div>
        </div>

        <div class="card table-card p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">ID</th>
                            <th>ชื่อที่แสดง</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>รหัสผ่าน</th>
                            <th>วันที่สมัคร</th>
                            <th width="150" class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="fw-bold"><?= $row['u_id'] ?></td>
                                <td>
                                    <div class="fw-bold text-primary"><?= $row['u_name'] ?></div>
                                </td>
                                <td>
                                    <div class="small">👤 <?= $row['username'] ?></div>
                                </td>
                                <td>
                                    <div class="small text-muted">🔑 <?= $row['password'] ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary badge-style"><?= $row['created_at'] ?></span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="edit_member.php?id=<?= $row['u_id'] ?>" class="btn btn-sm btn-outline-warning">แก้ไข</a>
                                        <a href="delete_member.php?id=<?= $row['u_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลสมาชิกรายนี้?')">ลบ</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80" class="mb-3 opacity-50">
                                    <p class="text-muted">ยังไม่พบข้อมูลผู้สมัครสมาชิกในขณะนี้</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="text-center py-4 text-muted small">
        © 2026 Manga shop Management System | Backend Version 1.0
    </footer>

</body>
</html>