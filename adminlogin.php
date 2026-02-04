<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // ค้นหา username ในฐานข้อมูล
    $sql = "SELECT * FROM admin_users WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // ถ้าเจอข้อมูล ให้สร้าง Session และส่งไปหน้า admin.php
        $_SESSION['admin_login'] = $user;
        header("Location: admin.php");
        exit();
    } else {
        $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Login | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #1d3557; height: 100vh; display: flex; align-items: center; font-family: 'Kanit', sans-serif; }
        .login-card { width: 100%; max-width: 400px; border-radius: 15px; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card login-card mx-auto p-4 shadow-lg">
            <h3 class="text-center fw-bold mb-4">ADMIN LOGIN</h3>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger p-2 small text-center"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-danger w-100 py-2">เข้าสู่หลังบ้าน</button>
            </form>
            <div class="text-center mt-3">
                <a href="index.php" class="text-muted small">กลับหน้าหลักร้านค้า</a>
            </div>
        </div>
    </div>
</body>
</html>