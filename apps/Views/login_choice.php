<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn loại đăng nhập</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo Base_URL?>public/css/login.css" rel="stylesheet">
    <style>
        .login-choice {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .choice-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 200px;
        }
        .choice-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.2);
        }
        .choice-card i {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .choice-card h3 {
            color: #fff;
            margin-bottom: 10px;
        }
        .choice-card p {
            color: #fff;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Chọn loại đăng nhập</h1>
        <div class="login-choice">
            <a href="<?php echo Base_URL?>CustomerLoginController" class="choice-card">
                <i class='bx bxs-user'></i>
                <h3>Khách hàng</h3>
                <p>Đăng nhập với tài khoản khách hàng</p>
            </a>
            <a href="<?php echo Base_URL?>LoginController" class="choice-card">
                <i class='bx bxs-user-badge'></i>
                <h3>Admin</h3>
                <p>Đăng nhập với tài khoản quản trị</p>
            </a>
        </div>
    </div>
</body>
</html> 