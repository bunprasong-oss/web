<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_name   = $conn->real_escape_string($_POST['u_name']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // ในระบบจริงควรใช้ password_hash($password, PASSWORD_DEFAULT)

    // 1. เช็คก่อนว่าชื่อผู้ใช้นี้มีคนใช้หรือยัง
    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $error = "ขออภัย! ชื่อผู้ใช้นี้มีคนใช้แล้ว";
    } else {
        // 2. บันทึกข้อมูลลงตาราง users
        $sql = "INSERT INTO users (u_name, username, password) VALUES ('$u_name', '$username', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('สมัครสมาชิกสำเร็จ! กรุณาเข้าสู่ระบบ'); window.location.href='login.php';</script>";
        } else {
            $error = "เกิดข้อผิดพลาด: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิก | Manga Muse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #457b9d 0%, #1d3557 100%); height: 100vh; display: flex; align-items: center; font-family: 'Kanit', sans-serif; }
        .reg-card { width: 100%; max-width: 450px; border-radius: 20px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.2); }
    </style>
</head>
<body>
    <div class="container">
        <div class="card reg-card mx-auto p-4">
            <h3 class="text-center fw-bold mb-2">📝 สมัครสมาชิก</h3>
            <p class="text-center text-muted small mb-4">เข้าร่วมเป็นส่วนหนึ่งของ Manga Shop</p>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger py-2 small text-center"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold">ชื่อ-นามสกุล</label>
                    <input type="text" name="u_name" class="form-control" placeholder="เช่น นายสมชาย ใจดี" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">ชื่อผู้ใช้งาน (Username)</label>
                    <input type="text" name="username" class="form-control" placeholder="สำหรับใช้ Login" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">รหัสผ่าน (Password)</label>
                    <input type="password" name="password" class="form-control" placeholder="อย่างน้อย 6 ตัวอักษร" required>
                </div>
                <button type="submit" class="btn btn-danger w-100 py-2 fw-bold mt-2 shadow-sm" style="border-radius: 10px;">ยืนยันการสมัคร</button>
            </form>
            
            <div class="text-center mt-3">
                <span class="small text-muted">เป็นสมาชิกอยู่แล้ว?</span> 
                <a href="login.php" class="text-primary fw-bold text-decoration-none small">เข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
</body>
</html>