<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký Khách hàng</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link href="<?php echo Base_URL?>public/css/login.css" rel="stylesheet" />
  </head>
  <body>
    <div class="wrapper">
      <h1>Đăng ký Khách hàng</h1>
      <form action="<?php echo Base_URL?>CustomerController/register_process" method="POST">
        <div class="input-box">
          <input type="text" name="name" placeholder="Họ và tên" required />
          <i class="bx bxs-user"></i>
        </div>
        <div class="input-box">
          <input type="email" name="email" placeholder="Email" required />
          <i class="bx bxs-envelope"></i>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Mật khẩu" required />
          <i class="bx bxs-lock"></i>
        </div>
        <div class="input-box">
          <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" required />
          <i class="bx bxs-lock"></i>
        </div>
        <div class="input-box">
          <input type="text" name="phone" placeholder="Số điện thoại" required />
          <i class="bx bxs-phone"></i>
        </div>
        <button type="submit" class="btn">Đăng ký</button>
        <div class="register-link">
          <p>Đã có tài khoản? <a href="<?php echo Base_URL?>CustomerLoginController/login">Đăng nhập</a></p>
        </div>
        <?php
        if(isset($_GET['error'])) {
          echo '<div class="error-message">' . $_GET['error'] . '</div>';
        }
        ?>
      </form>
    </div>
  </body>
</html>
