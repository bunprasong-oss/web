<?php
session_start();
include 'connect.php';

// 1. รับ ID สินค้าจาก URL
if (isset($_GET['id'])) {
    $p_id = $_GET['id'];
    
    // 2. ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT * FROM products WHERE p_id = $p_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $p = $result->fetch_assoc();
    } else {
        echo "<script>alert('ไม่พบข้อมูลสินค้า'); window.location.href='index.php';</script>";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title><?= $p['p_name'] ?> | Manga shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #f8f9fa; }
        .img-container {
            background: white;
            padding: 15px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            position: sticky;
            top: 20px;
        }
        .manga-img {
            width: 100%;
            max-height: 550px;
            object-fit: contain;
            border-radius: 10px;
        }
        .detail-box {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .description-text {
            white-space: pre-line;
            color: #6c757d;
            line-height: 1.8;
        }
        /* ตกแต่งปุ่มเลือกเล่ม */
        .btn-check:checked + .btn-outline-danger {
            background-color: #dc3545;
            color: white;
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        }
        .vol-btn {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px !important;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row g-4">
            
            <div class="col-md-5">
                <div class="img-container text-center">
                    <img src="<?= $p['p_img'] ?>" class="manga-img" alt="<?= $p['p_name'] ?>">
                </div>
            </div>

            <div class="col-md-7">
                <div class="detail-box">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">หน้าหลัก</a></li>
                            <li class="breadcrumb-item active"><?= $p['p_category'] ?></li>
                        </ol>
                    </nav>

                    <h1 class="fw-bold text-dark mb-2"><?= $p['p_name'] ?></h1>
                    <p class="text-muted mb-4 small">หมวดหมู่: <span class="badge bg-secondary"><?= $p['p_category'] ?></span></p>
                    
                    <h2 class="text-danger fw-bold mb-4">฿ <?= number_format($p['p_price'], 2) ?></h2>
                    
                    <hr class="my-4 opacity-25">

                    <form action="cart-action.php" method="POST">
                        <div class="mb-4">
                            <label class="fw-bold text-dark mb-3"><i class="fa-solid fa-book-open text-danger me-2"></i>เลือกเล่มที่ต้องการ:</label>
                            <div class="d-flex flex-wrap gap-2">
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <input type="radio" class="btn-check" name="p_volume" id="vol<?= $i ?>" value="<?= $i ?>" <?= ($i == 1) ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-danger vol-btn" for="vol<?= $i ?>">
                                        <?= $i ?>
                                    </label>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h5 class="fw-bold text-dark mb-3">รายละเอียดสินค้า</h5>
                            <div class="description-text">
                                <?php echo !empty($p['p_detail']) ? $p['p_detail'] : "ไม่มีข้อมูลรายละเอียดสินค้า"; ?>
                            </div>
                        </div>

                        <input type="hidden" name="p_id" value="<?= $p['p_id'] ?>">
                        <input type="hidden" name="p_name" value="<?= $p['p_name'] ?>">
                        <input type="hidden" name="p_price" value="<?= $p['p_price'] ?>">
                        <input type="hidden" name="p_img" value="<?= $p['p_img'] ?>">
                        
                        <div class="row align-items-center g-3 mb-4">
                            <div class="col-auto">
                                <span class="fw-bold text-dark">จำนวน:</span>
                            </div>
                            <div class="col-auto">
                                <div class="input-group" style="width: 130px;">
                                    <input type="number" name="qty" class="form-control text-center fw-bold" value="1" min="1">
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex mt-4">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <button type="submit" name="add_to_cart" class="btn btn-danger btn-lg px-5 rounded-pill shadow-sm">
                                    <i class="fa-solid fa-cart-plus me-2"></i> เพิ่มลงตะกร้า
                                </button>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-warning btn-lg px-5 rounded-pill shadow-sm fw-bold">
                                    <i class="fa-solid fa-lock me-2"></i> เข้าสู่ระบบเพื่อสั่งซื้อ
                                </a>
                            <?php endif; ?>

                            <a href="index.php" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">
                                กลับหน้าหลัก
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>