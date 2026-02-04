<?php 
session_start(); 
include 'connect.php'; // ดึงการเชื่อมต่อฐานข้อมูลมาไว้ด้านบนสุด
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga shop | อาณาจักรคนรักมังงะ</title>
    <meta charset="UTF-8">
    <title>Manga shop | อาณาจักรคนรักมังงะ</title>
    
    <link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/1466041021946269863/1466476993536327796/1769705730658.png?ex=69817fe1&is=69802e61&hm=192bdda6c5df6ac012b78e78508fd6a8319bf3104138b8484f5d87103136aa42&">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { --main-red: #e63946; --dark-blue: #000205; }
        body { font-family: 'Kanit', sans-serif; background-color: #f8f9fa; color: #333; scroll-behavior: smooth; }
        
        /* Navigation */
        .navbar { background-color: var(--dark-blue); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .nav-link { font-weight: 300; transition: 0.3s; color: rgba(255,255,255,0.8) !important; }
        .nav-link:hover { color: var(--main-red) !important; }
        .nav-link.active { color: white !important; font-weight: 600; }

        /* ✨ Banner Section แก้ไขที่นี่ */
        .hero-section { 
    /* 1. ใส่ลิงก์รูปใหม่ (แนะนำให้ใช้ลิงก์ที่เสถียร หรือไฟล์ในเครื่อง) */
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.6)), 
                url('https://cdn.discordapp.com/attachments/1466041021946269863/1468465666335183001/20260204_113721_0001.png?ex=69841eb9&is=6982cd39&hm=dcd995eb02372c99df01784e6faf346803d4d336cd81845e7e9a082788f028a3&');
    
    /* 2. ตั้งค่าให้รูปเต็มพื้นที่และไม่เบี้ยว */
    background-size: cover;      /* ขยายรูปให้เต็มพื้นที่เสมอ */
    background-position: center;  /* จัดให้กึ่งกลางรูปอยู่ตรงกลางเสมอ */
    background-repeat: no-repeat; /* ป้องกันรูปแสดงซ้ำ */
    
    /* 3. ปรับความสูงของแบนเนอร์ */
    padding: 30px 0;             /* เพิ่มตัวเลขนี้ถ้าอยากให้แบนเนอร์ดูใหญ่ขึ้น */
    color: white; 
    margin-bottom: 0;
}
        .hero-section h1 { font-size: 4.5rem; text-shadow: 2px 4px 15px rgba(0,0,0,0.5); }

        /* Manga Cards */
        .manga-card { 
            border: none; border-radius: 15px; overflow: hidden; 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); 
            background: white;
        }
        .manga-card:hover { transform: translateY(-12px); box-shadow: 0 15px 35px rgba(230,57,70,0.2); }
        .manga-img { height: 280px; object-fit: cover; transition: 0.5s; }
        .manga-card:hover .manga-img { transform: scale(1.05); }
        
        .category-header { 
            border-left: 6px solid var(--main-red); 
            padding-left: 15px; 
            margin: 60px 0 30px; 
            font-weight: 600; 
            color: var(--dark-blue);
            display: flex;
            align-items: center;
        }

        /* Footer */
        footer { background: #111; color: #aaa; padding: 60px 0 30px; margin-top: 100px; }
        .footer-link { color: #888; text-decoration: none; transition: 0.3s; font-size: 0.95rem; }
        .footer-link:hover { color: var(--main-red); padding-left: 8px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 d-flex align-items-center" href="index.php">
    <img src="https://cdn.discordapp.com/attachments/1466041021946269863/1466476993536327796/1769705730658.png?ex=69817fe1&is=69802e61&hm=192bdda6c5df6ac012b78e78508fd6a8319bf3104138b8484f5d87103136aa42&" 
         alt="Logo" style="height: 40px; margin-right: 10px;">
    MANGA shop
</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fa-solid fa-house me-1"></i> หน้าแรก</a></li>
                    <li class="nav-item">
                        <a class="nav-link position-relative px-3" href="cart.php">
                            <i class="fa-solid fa-cart-shopping me-1"></i> ตะกร้าสินค้า
                            <?php if(!empty($_SESSION['cart'])): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?= count($_SESSION['cart']) ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="profile.php">ผู้จัดทำ</a></li>

                    <?php if(isset($_SESSION['user_name'])): ?>
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle text-white fw-bold border border-secondary rounded-pill px-3" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fa-regular fa-circle-user me-1"></i> <?= $_SESSION['user_name'] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li><a class="dropdown-item text-danger" href="user_logout.php"><i class="fa-solid fa-power-off me-2"></i>ออกจากระบบ</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-danger px-4 rounded-pill fw-bold shadow-sm" href="login.php">เข้าสู่ระบบ</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-2 fw-bold mb-3">Manga shop</h1>
            <p class="lead mb-4 fs-4 opacity-90">อาณาจักรคนรักมังงะ ลิขสิทธิ์แท้ แปลไทย 100%</p>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="#gallery" class="btn btn-danger btn-lg px-5 py-3 rounded-pill shadow-lg fw-bold">เลือกซื้อสินค้าเลย</a>
                <?php if(!isset($_SESSION['user_name'])): ?>
                    <a href="register.php" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold">สมัครสมาชิกใหม่</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main id="gallery" class="container py-4">
        <?php
        $cat_sql = "SELECT DISTINCT p_category FROM products";
        $cat_query = $conn->query($cat_sql);

        if ($cat_query->num_rows > 0):
            while($cat_row = $cat_query->fetch_assoc()):
                $current_cat = $cat_row['p_category'];
        ?>
            <div class="category-header">
                <h3 class="mb-0 text-uppercase letter-spacing-1">🔥 หมวดหมู่: <?= $current_cat ?></h3>
            </div>
            
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 mb-5">
                <?php 
                $prod_sql = "SELECT * FROM products WHERE p_category = '$current_cat'";
                $prod_query = $conn->query($prod_sql);
                while($p = $prod_query->fetch_assoc()): 
                ?>
                <div class="col">
                    <div class="card manga-card h-100">
                        <img src="<?= $p['p_img'] ?>" class="card-img-top manga-img" alt="<?= $p['p_name'] ?>" onerror="this.src='https://via.placeholder.com/300x450'">
                        <div class="card-body p-3 d-flex flex-column text-center">
                            <h6 class="fw-bold mb-2 text-truncate"><?= $p['p_name'] ?></h6>
                            <p class="text-danger fw-bold fs-5 mb-3">฿<?= number_format($p['p_price'], 0) ?></p>
                            <div class="mt-auto">
                                <a href="product-detail.php?id=<?= $p['p_id'] ?>" class="btn btn-outline-dark btn-sm rounded-pill w-100 py-2 fw-bold">
                                    รายละเอียดสินค้า
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        <?php 
            endwhile; 
        else:
            echo "<div class='text-center py-5'><img src='https://cdn-icons-png.flaticon.com/512/7486/7486744.png' width='100' class='opacity-25 mb-3'><p class='text-muted'>ขออภัย ยังไม่มีสินค้าในขณะนี้</p></div>";
        endif; 
        ?>
    </main>

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-md-5">
                    <h5 class="text-white mb-4 fw-bold">📚 MANGA SHOP</h5>
                    <p class="small pe-md-5">เราคือตัวแทนจำหน่ายมังงะและไลท์โนเวล ลิขสิทธิ์ถูกต้องจากสำนักพิมพ์ชั้นนำ คัดสรรหนังสือสภาพดีเพื่อนักสะสมทุกคน</p>
                    <div class="mt-4">
                    </div>
                </div>
                <div class="col-md-3">
                    <h5 class="text-white mb-4 fw-bold">เมนูแนะนำ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php" class="footer-link">หน้าแรก</a></li>
                        <li class="mb-2"><a href="#gallery" class="footer-link">สินค้าทั้งหมด</a></li>
                        <li class="mb-2"><a href="about.php" class="footer-link">About Me</a></li>
                        <li class="mb-2"><a href="profile.php" class="footer-link">ทีมผู้จัดทำ</a></li>
                        <li class="mb-2"><a href="login.php" class="footer-link opacity-50">Login</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-white mb-4 fw-bold">ติดต่อเรา</h5>
                    <p class="small mb-2"><i class="fa-solid fa-location-dot me-2 text-danger"></i> วิทยาลัยเทคนิคเทคนิครราชสีมา</p>
                    <p class="small mb-2"><i class="fa-solid fa-phone me-2 text-danger"></i> 062-161-3894</p>
                    <p class="small"><i class="fa-solid fa-envelope me-2 text-danger"></i> Bunprasong@ntc.ac.th</p>
                </div>
            </div>
            <hr class="my-5 border-secondary opacity-25">
            <div class="text-center small opacity-50">
                © 2026 Manga shop. Designed for Web Project.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>