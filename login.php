<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ป้องกัน SQL Injection เบื้องต้น
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $_POST['password'];

    // เปลี่ยนไปค้นหาในตาราง users (สำหรับลูกค้า)
    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // สร้าง Session สำหรับลูกค้า
        $_SESSION['user_id'] = $row['u_id'];
        $_SESSION['user_name'] = $row['u_name'];
        
        // ล็อกอินเสร็จ ให้กลับไปหน้าแรกเพื่อเลือกซื้อของต่อ
        header("Location: index.php");
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
    <title>เข้าสู่ระบบ | Manga Muse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #1d3557 0%, #457b9d 100%); 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            font-family: 'Kanit', sans-serif; 
        }
        .login-card { 
            width: 100%; 
            max-width: 400px; 
            border-radius: 20px; 
            border: none; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.2); 
        }
        .btn-manga { 
            background-color: #e63946; 
            color: white; 
            border-radius: 10px; 
            font-weight: 600; 
        }
        .btn-manga:hover { background-color: #c1121f; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card login-card mx-auto p-4 shadow-lg">
            <h3 class="text-center fw-bold mb-4 text-dark">MEMBER LOGIN</h3>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger p-2 small text-center"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="ชื่อผู้ใช้งาน" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
                </div>
                <button type="submit" class="btn btn-manga w-100 py-2">เข้าสู่ระบบ</button>
            </form>
            
            <div class="text-center mt-3">
                <p class="small mb-1">ยังไม่มีบัญชีใช่ไหม?</p>
                <a href="register.php" class="text-danger fw-bold text-decoration-none">สมัครสมาชิกที่นี่</a>
            </div>
            <hr>
            <div class="text-center">
                <a href="index.php" class="text-muted small">กลับหน้าหลักร้านค้า</a>
            </div>
        </div>
    </div>
</body>
</html>