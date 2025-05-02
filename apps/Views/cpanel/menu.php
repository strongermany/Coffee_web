<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <!-- <link rel="stylesheet" href="<?php echo Base_URL ?>public/template/css/styles.css"> -->
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/template/css/menu.css">
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/template/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <nav class="admin-navbar">
        <ul class="admin-menu">
            <li class="admin-menu-item active">
                <a href="<?php echo Base_URL ?>LoginController/Dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="admin-menu-item">
                <a href="#"><i class="fas fa-info-circle"></i> Information</a>
            </li>
            <li class="admin-menu-item">
                <a href="<?php echo Base_URL?>SliderController/add">
                    <i class="fas fa-sliders-h"></i> Slider <i ></i>
                </a>
                
            </li>
            
            <li class="admin-menu-item">
                <a href="<?php echo Base_URL ?>PostController/add_post">
                    <i class="fas fa-blog"></i> Blogs <i ></i>
                </a>
              
            </li>
            <li class="admin-menu-item">
                <a href="<?php echo Base_URL ?>ProductController"">
                    <i class="fas fa-list"></i> Category <i ></i>
                </a>
               
            </li>
            <li class="admin-menu-item">
                <a href="<?php echo Base_URL?>ProductController/add_product">
                    <i class="fas fa-box"></i> Product <i ></i>
                </a>
                
            </li>
            <li class="admin-menu-item">
                <a href="#">
                    <i class="fas fa-shopping-cart"></i> Orders <i class="fas fa-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="admin-submenu">
                    <li><a href="<?php echo Base_URL?>OrderController/addOrder">List</a></li>
                </ul>
            </li>
        </ul>
        <div class="admin-right">
            <div class="admin-tools">
                <div class="admin-tool-item">
                    <a href="#" class="tool-link">
                        <i class="far fa-envelope"></i>
                        <span class="tool-badge">3</span>
                    </a>
                </div>
                <div class="admin-tool-item">
                    <a href="#" class="tool-link">
                        <i class="far fa-bell"></i>
                        <span class="tool-badge">5</span>
                    </a>
                </div>
            </div>
            <div class="admin-profile">
                <div class="admin-info">
                    <span class="admin-name">Admin</span>
                    <span class="admin-role">Quản trị viên</span>
                </div>
                <div class="avatar-wrapper">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin Avatar" class="admin-avatar">
                    <div class="avatar-dropdown">
                        <a href="<?php echo Base_URL?>LoginController/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="admin-main-content">
        <?php
        if (isset($_GET['msg'])) {
            $message = unserialize(urldecode($_GET['msg']));
            echo "<script>
                if (!sessionStorage.getItem('message_shown')) {
                    alert('".$message['msg']."');
                    sessionStorage.setItem('message_shown', 'true');
                    // Remove msg from URL without refreshing
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            </script>";
        }
        ?>
    </main>
    <script src="<?php echo Base_URL ?>public/template/js/admin.js"></script>
</body>
</html> 