
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Nhúng bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/xxxxxxx.css">
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/home.css" />
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/headerA.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>TRANG CHỦ</title>
</head>
<header style="background-image: url('<?php echo Base_URL . $backgroundImage; ?>');">
    
    <nav class="navbar navbar-expand-lg ">
        <div class="container p-3">
            <img src="<?php echo Base_URL ?>public/images/logob.png" alt="" class="navbar-logo">
            <a class="navbar-brand fw-bold text-dark" href="#">HIPPO COFFEE</a>
            <!-- Đã bỏ nút hamburger ra ngoài container này -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo Base_URL ?>index">Trang chủ</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo Base_URL ?>index/menu">Menu</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Danh mục
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                            <?php
                            if (isset($categories) && is_array($categories)) {
                                foreach ($categories as $category) {
                                    echo '<li><a class="dropdown-item" href="' . Base_URL . 'index/category/' . $category['Id_Cate'] . '">' . $category['Category'] . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo Base_URL ?>NewsController">Tin tức </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Cửa hàng</a></li>
                </ul>
                <!-- Thêm phần icon đăng nhập và giỏ hàng -->
                <div class="d-flex align-items-center">
                    <?php
                    Session::init();
                    if (Session::get('customer_login')) {
                        // Nếu đã đăng nhập, hiển thị dropdown menu
                        echo '<div class="user-dropdown">
                                <a class="nav-link">
                                    <i class="fas fa-user"></i>
                                    <span class="ms-1">' . Session::get('customer_name') . '</span>
                                </a>
                                <div class="dropdown-content">
                                    <a href="' . Base_URL . 'CustomerController">
                                        <i class="fas fa-user-circle"></i>
                                        Thông tin tài khoản
                                    </a>
                                    <a href="' . Base_URL . 'CustomerLoginController/logout">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Đăng xuất
                                    </a>
                                </div>
                            </div>';
                    } else {
                        // Nếu chưa đăng nhập
                        echo '<a href="' . Base_URL . 'LoginController/choice" class="nav-link me-3">
                                <i class="fas fa-user"></i>
                            </a>';
                    }
                    ?>
                    <a href="<?php echo Base_URL ?>CartController" class="nav-link position-relative me-3 cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-count">
                            <?php echo isset($cart_count) ? $cart_count : '0'; ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Nút hamburger cho mobile, đặt ngoài .container.p-3 -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Offcanvas menu cho mobile -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
          <div class="offcanvas-header justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link" href="<?php echo Base_URL ?>index">Trang chủ</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo Base_URL ?>index/menu">Menu</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="offcanvasPagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Danh mục</a>
                <ul class="dropdown-menu" aria-labelledby="offcanvasPagesDropdown">
                  <?php
                  if (isset($categories) && is_array($categories)) {
                      foreach ($categories as $category) {
                          echo '<li><a class="dropdown-item" href="' . Base_URL . 'index/category/' . $category['Id_Cate'] . '">' . $category['Category'] . '</a></li>';
                      }
                  }
                  ?>
                </ul>
              </li>
              <li class="nav-item"><a class="nav-link" href="<?php echo Base_URL ?>NewsController">Tin tức</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Cửa hàng</a></li>
            </ul>
          </div>
        </div>
    </nav>
</header>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle search form
    var searchIcon = document.querySelector('.search-icon');
    var searchForm = document.querySelector('.search-form');
    if(searchIcon && searchForm) {
        searchIcon.addEventListener('click', function() {
            searchForm.classList.toggle('active');
            if(searchForm.classList.contains('active')) {
                searchForm.querySelector('input').focus();
            }
        });
    }
    // Đóng offcanvas khi lên desktop
    function closeOffcanvasOnDesktop() {
        if (window.innerWidth >= 992) {
            var offcanvasEl = document.getElementById('offcanvasMenu');
            if (offcanvasEl && offcanvasEl.classList.contains('show')) {
                var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (offcanvas) offcanvas.hide();
            }
        }
    }
    window.addEventListener('resize', closeOffcanvasOnDesktop);
});
</script>