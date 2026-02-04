<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ตะกร้าสินค้า | Manga Muse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body style="font-family: 'Kanit', sans-serif; background-color: #f8f9fa;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">📚 MANGA MUSE</a>
            <div class="ms-auto">
                <a href="index.php" class="btn btn-outline-light btn-sm">กลับไปเลือกของเพิ่ม</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <h2 class="fw-bold mb-4">🛒 ตะกร้าสินค้าของคุณ</h2>
        
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-3">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>สินค้า</th>
                                    <th>ชื่อเรื่อง/เล่ม</th>
                                    <th>ราคา</th>
                                    <th>จำนวน</th>
                                    <th>รวม</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $grand_total = 0;
                                if(!empty($_SESSION['cart'])): 
                                    foreach($_SESSION['cart'] as $key => $item): 
                                        // แก้ชื่อตัวแปร p_price และ qty ให้ตรงกับที่ส่งมาจาก cart-action
                                        $subtotal = $item['p_price'] * $item['qty'];
                                        $grand_total += $subtotal;
                                ?>
                                    <tr>
                                        <td><img src="<?= $item['p_img'] ?>" style="width:60px; border-radius:5px; height: 80px; object-fit: cover;"></td>
                                        <td>
                                            <div class="fw-bold"><?= $item['p_name'] ?></div>
                                            <span class="badge bg-danger">เล่มที่ <?= $item['p_volume'] ?></span>
                                        </td>
                                        <td>฿<?= number_format($item['p_price'], 2) ?></td>
                                        <td><?= $item['qty'] ?></td>
                                        <td class="fw-bold text-primary">฿<?= number_format($subtotal, 2) ?></td>
                                        <td>
                                            <a href="remove-item.php?key=<?= $key ?>" class="text-muted" onclick="return confirm('ลบรายการนี้?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php 
                                    endforeach; 
                                else: 
                                ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-cart-shopping fa-3x mb-3 opacity-25"></i><br>
                                            ยังไม่มีสินค้าในตะกร้า <br>
                                            <a href="index.php" class="btn btn-sm btn-danger mt-3 rounded-pill px-4">ไปเลือกซื้อการ์ตูน</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php if(!empty($_SESSION['cart'])): ?>
                        <div class="text-end border-top pt-3">
                            <a href="clear-cart.php" class="btn btn-sm btn-link text-danger text-decoration-none" onclick="return confirm('ล้างสินค้าทั้งหมดในตะกร้า?')">ล้างตะกร้าสินค้า</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 border-top border-danger border-4">
                    <h5 class="fw-bold mb-4 text-dark">สรุปยอดคำสั่งซื้อ</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">รวมราคาสินค้า</span>
                        <span class="fw-bold">฿<?= number_format($grand_total, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">ค่าจัดส่ง</span>
                        <span class="text-success fw-bold"><?= ($grand_total > 0) ? '฿40.00' : '฿0.00' ?></span>
                    </div>
                    <hr class="my-3">
                    <div class="d-flex justify-content-between mb-4">
                        <span class="h5 fw-bold">ยอดรวมสุทธิ</span>
                        <span class="h4 fw-bold text-danger">฿<?= number_format($grand_total + ($grand_total > 0 ? 40 : 0), 2) ?></span>
                    </div>

                    <a href="checkout.php" 
                       class="btn btn-danger btn-lg w-100 fw-bold py-3 shadow rounded-4 <?= ($grand_total == 0) ? 'disabled' : '' ?>">
                        ไปที่หน้าชำระเงิน <i class="fa-solid fa-chevron-right ms-2"></i>
                    </a>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted"><i class="fa-solid fa-shield-halved me-1"></i> สั่งซื้อปลอดภัย 100%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-4 text-muted">
        <small>© 2026 Manga Shop | อาณาจักรคนรักมังงะ</small>
    </footer>

</body>
</html>