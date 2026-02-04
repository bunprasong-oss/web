<?php
session_start();
include 'connect.php';

// 1. ดึงข้อมูลเก่ามาโชว์ (แก้ไขให้ตรงกับตาราง users และ u_id)
$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE u_id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// 2. ถ้ามีการกดปุ่ม "บันทึก"
if (isset($_POST['update'])) {
    $u_name = $_POST['u_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $update_sql = "UPDATE users SET 
                   u_name='$u_name', 
                   username='$username', 
                   password='$password' 
                   WHERE u_id=$id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location.href='admin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card mx-auto shadow-sm" style="max-width: 600px;">
            <div class="card-header bg-warning fw-bold">📝 แก้ไขข้อมูลคุณ <?= $row['u_name'] ?></div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">ชื่อที่แสดง</label>
                        <input type="text" name="u_name" class="form-control" value="<?= $row['u_name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ชื่อผู้ใช้ (Username)</label>
                        <input type="text" name="username" class="form-control" value="<?= $row['username'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">รหัสผ่าน (Password)</label>
                        <input type="text" name="password" class="form-control" value="<?= $row['password'] ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary w-100">บันทึกการแก้ไข</button>
                    <a href="admin.php" class="btn btn-secondary w-100 mt-2">ยกเลิก</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>