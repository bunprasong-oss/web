<?php
session_start();
include 'connect.php';

if (isset($_POST['submit'])) {
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_category = $_POST['p_category'];
    $p_detail = $_POST['p_detail']; // <--- เพิ่มการรับค่านี้
    $p_img = $_POST['p_img'];

    // เพิ่ม p_detail เข้าไปในคำสั่ง SQL
    $sql = "INSERT INTO products (p_name, p_price, p_category, p_detail, p_img) 
            VALUES ('$p_name', '$p_price', '$p_category', '$p_detail', '$p_img')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('เพิ่มสินค้าสำเร็จ!'); window.location.href='admin_products.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มสินค้าใหม่</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card mx-auto shadow-sm" style="max-width: 500px;">
            <div class="card-header bg-success text-white fw-bold">➕ เพิ่มมังงะใหม่</div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">ชื่อเรื่อง</label>
                        <input type="text" name="p_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ราคา (บาท)</label>
                        <input type="number" name="p_price" class="form-control" required>
                    </div>
                    <div class="mb-3">
    <label class="form-label">หมวดหมู่</label>
    <select name="p_category" class="form-select">
        <option value="Action">Action</option>
        <option value="Romance">Romance</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Sport">Sport</option> 
        <option value="Drama">Drama</option>
        <option value="Comedy">Comedy</option> </select>
</div>
                    
                    <div class="mb-3">
                        <label class="form-label">รายละเอียดสินค้า (เรื่องย่อ)</label>
                        <textarea name="p_detail" class="form-control" rows="4" placeholder="กรอกรายละเอียดสินค้า..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">URL รูปภาพสินค้า</label>
                        <input type="text" name="p_img" class="form-control" placeholder="https://..." required>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-success w-100">บันทึกสินค้า</button>
                    <a href="admin_products.php" class="btn btn-secondary w-100 mt-2">กลับ</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>