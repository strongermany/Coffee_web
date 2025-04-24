<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Nhúng bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/xxxxxxx.css">
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/style.css" />
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/navbar.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>TRANG CHỦ</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container p-3">
            <img src="<?php echo Base_URL ?>public/images/logob.png" alt="" class="navbar-logo">
            <a class="navbar-brand fw-bold text-dark" href="#">HIPPO<br>COFFEE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo Base_URL ?>index">Trang chủ</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo Base_URL ?>index/category">Menu</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Danh mục
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                            <li><a class="dropdown-item" href="#">Coffee</a></li>
                            <li><a class="dropdown-item" href="#">Trà</a></li>
                            <li><a class="dropdown-item" href="#">Dụng cụ </a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="<?php echo Base_URL?>NewsController">Tin tức </a>
                    </li>

                    

                    <li class="nav-item"><a class="nav-link" href="<?php echo Base_URL?>cartController">Đặt hàng </a></li>

                    <li class="nav-item"><a class="nav-link" href="#">Cửa hàng</a></li>

                </ul>


            </div>
        </div>
    </nav>
</header>