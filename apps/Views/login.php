<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập Khách hàng</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link href="<?php echo Base_URL?>public/css/login.css" rel="stylesheet" />
  </head>
  <body>
    <div class="wrapper">
      <h1>Đăng nhập Khách hàng</h1>
      <form action="<?php echo Base_URL?>CustomerLoginController/authentication_login" method="POST">
        <div class="input-box">
          <input type="email" name="email" placeholder="Email" required />
          <i class="bx bxs-envelope"></i>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Mật khẩu" required />
          <i class="bx bxs-lock"></i>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox"> Ghi nhớ đăng nhập</label>
          <a href="#">Quên mật khẩu?</a>
        </div>
        <button type="submit" class="btn">Đăng nhập</button>
        <div class="register-link">
          <p>Chưa có tài khoản? <a href="<?php echo Base_URL?>CustomerLoginController/register">Đăng ký</a></p>
        </div>
        <?php
        if(isset($_GET['error'])) {
          echo '<div class="error-message">Email hoặc mật khẩu không đúng</div>';
        }
        ?>
      </form>
    </div>
  </body>
</html>
