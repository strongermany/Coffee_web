<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo Base_URL?>public/css/login.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <h1>Đăng nhập Admin</h1>
        <form action="<?php echo Base_URL?>LoginController/authentication_login" method="POST">
            <div class="input-box">
                <input type="text" name="Username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="Password" placeholder="Password" required>
                <i class='bx bxs-lock'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password ?</a>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
