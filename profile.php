<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Team | Manga shop</title>
    <meta charset="UTF-8">
    <title>Manga shop | อาณาจักรคนรักมังงะ</title>
    
    <link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/1466041021946269863/1466476993536327796/1769705730658.png?ex=69817fe1&is=69802e61&hm=192bdda6c5df6ac012b78e78508fd6a8319bf3104138b8484f5d87103136aa42&">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-red: #e63946;
            --dark-navy: #0d1b2a;
            --accent-blue: #457b9d;
        }

        body { 
            font-family: 'Kanit', sans-serif; 
            background: var(--dark-navy);
            background-image: radial-gradient(circle at 50% -20%, #1d3557, #0d1b2a);
            color: white; 
            min-height: 100vh;
            overflow-x: hidden;
        }

        .main-title {
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 60px;
            background: linear-gradient(to right, #fff, var(--primary-red));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .profile-card { 
            background: rgba(255, 255, 255, 0.03); 
            backdrop-filter: blur(20px); 
            border-radius: 40px; 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            padding: 40px 30px;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.320, 1);
            height: 100%;
        }

        .profile-card:hover { 
            transform: translateY(-15px);
            border-color: var(--primary-red);
            box-shadow: 0 25px 50px rgba(0,0,0,0.5), 0 0 20px rgba(230, 57, 70, 0.2);
        }

        .avatar-box {
            position: relative;
            width: 180px;
            height: 180px;
            margin: 0 auto 25px;
        }

        .avatar { 
            width: 100%; height: 100%; object-fit: cover; 
            border-radius: 35% 65% 70% 30% / 30% 40% 60% 70%; 
            border: 3px solid var(--primary-red);
            transition: 0.5s;
            background: white;
        }

        .profile-card:hover .avatar { border-radius: 50%; }

        .info-box {
            background: rgba(13, 27, 42, 0.6);
            border-radius: 20px;
            padding: 20px;
            margin-top: 20px;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .label-tag {
            font-size: 0.75rem;
            color: var(--primary-red);
            text-transform: uppercase;
            font-weight: 600;
            display: block;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 0.95rem;
            color: #e0e1dd;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .btn-back {
            background: transparent;
            border: 2px solid var(--primary-red);
            color: white;
            padding: 12px 40px;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
            margin-top: 50px;
        }

        .btn-back:hover {
            background: var(--primary-red);
            box-shadow: 0 0 20px rgba(230, 57, 70, 0.4);
        }

        .fade-in { animation: fadeInUp 0.8s ease backwards; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="container py-5 text-center">
        <h1 class="main-title mb-5 fade-in">คณะผู้จัดทำ</h1>

        <div class="row g-5 justify-content-center">
            
            <div class="col-lg-5 fade-in" style="animation-delay: 0.2s;">
                <div class="profile-card shadow">
                    <div class="avatar-box">
                        <img src="https://cdn.discordapp.com/attachments/1040157070068023336/1467915278175310038/image_20260202_224748_0000.png?ex=69821e22&is=6980cca2&hm=a5f4f7b0967d9da2e830e055117e3398eb1a907504456bb9ce0f073deb89968c&" class="avatar" alt="Developer 1" onerror="this.src='https://api.dicebear.com/7.x/avataaars/svg?seed=Felix'">
                    </div>
                    <h2 class="fw-bold mb-1">นายนวพล ศิริรัตน์</h2>
                    <p class="text-danger small fw-bold mb-3">Backend Developer</p>
                    
                    <div class="info-box text-start">
                        <span class="label-tag"><i class="fa-solid fa-id-card me-1"></i> รหัสนักศึกษา</span>
                        <p class="info-value">68319090026</p>

                        <span class="label-tag"><i class="fa-solid fa-school me-1"></i> วิทยาลัย</span>
                        <p class="info-value">วิทยาลัยเทคนิคนครราชสีมา</p>
                        
                        <span class="label-tag"><i class="fa-solid fa-layer-group me-1"></i> แผนก</span>
                        <p class="info-value">อิเล็กทรอนิกส์</p>
                        
                        <span class="label-tag"><i class="fa-solid fa-microchip me-1"></i> สาขาวิชา</span>
                        <p class="info-value">เทคโนโลยีคอมพิวเตอร์</p>
                        
                        <div class="mt-3 border-top pt-3 border-secondary d-flex justify-content-between">
                            <span class="small"><i class="fa-solid fa-envelope me-2 text-danger"></i>Email</span>
                            <span class="small opacity-75">peetxd8@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 fade-in" style="animation-delay: 0.4s;">
                <div class="profile-card shadow">
                    <div class="avatar-box">
                        <img src="https://cdn.discordapp.com/attachments/1040157070068023336/1467915838794240123/Student_1.jpg?ex=69821ea8&is=6980cd28&hm=e5107fa3eea8bcfba941e2af0a44625b8ab0871ebf6661ecfd3694ff7335d17f&" class="avatar" alt="Developer 2" onerror="this.src='https://api.dicebear.com/7.x/avataaars/svg?seed=Aneka'">
                    </div>
                    <h2 class="fw-bold mb-1">นายบุญประสงค์ บุตรสอน</h2>
                    <p class="text-danger small fw-bold mb-3">Frontend Developer</p>
                    
                    <div class="info-box text-start">
                        <span class="label-tag"><i class="fa-solid fa-id-card me-1"></i> รหัสนักศึกษา</span>
                        <p class="info-value">68319090027</p>

                        <span class="label-tag"><i class="fa-solid fa-school me-1"></i> วิทยาลัย</span>
                        <p class="info-value">วิทยาลัยเทคนิคนครราชสีมา</p>
                        
                        <span class="label-tag"><i class="fa-solid fa-layer-group me-1"></i> แผนก</span>
                        <p class="info-value">อิเล็กทรอนิกส์</p>
                        
                        <span class="label-tag"><i class="fa-solid fa-microchip me-1"></i> สาขาวิชา</span>
                        <p class="info-value">เทคโนโลยีคอมพิวเตอร์</p>
                        
                        <div class="mt-3 border-top pt-3 border-secondary d-flex justify-content-between">
                            <span class="small"><i class="fa-solid fa-envelope me-2 text-danger"></i>Email</span>
                            <span class="small opacity-75">mayvdh123456@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <a href="index.php" class="btn btn-back fade-in" style="animation-delay: 0.6s;">
            <i class="fa-solid fa-house-chimney me-2"></i> กลับหน้าหลักร้านค้า
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>