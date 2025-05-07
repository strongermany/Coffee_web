<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <title>Admin Panel</title>
    <!-- <link rel="stylesheet" href="<?php echo Base_URL ?>public/template/css/styles.css"> -->
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/template/css/menu.css">
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/template/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="admin-profile">
                <div class="admin-info">
                    <span class="admin-name">Admin</span>
                   
                </div>
                <div class="avatar-wrapper" tabindex="0">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin Avatar" class="admin-avatar">
                    <div class="avatar-dropdown">
                        <a href="<?php echo Base_URL ?>LoginController/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
            <div class="sidebar-logo">
              
            </div>
            <ul class="admin-menu">
                <li class="admin-menu-item <?php echo isset($currentPage) && $currentPage === 'dashboard' ? 'active' : ''; ?>">
                    <a href="<?php echo Base_URL ?>HeaderBackgroundController">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="admin-menu-item <?php echo isset($currentPage) && $currentPage === 'information' ? 'active' : ''; ?>">
                    <a href="#"><i class="fas fa-info-circle"></i> Information</a>
                </li>
                <li class="admin-menu-item <?php echo isset($currentPage) && $currentPage === 'slider' ? 'active' : ''; ?>">
                    <a href="<?php echo Base_URL ?>SliderController/add">
                        <i class="fas fa-sliders-h"></i> Slider
                    </a>
                </li>
                <li class="admin-menu-item <?php echo isset($currentPage) && $currentPage === 'blogs' ? 'active' : ''; ?>">
                    <a href="<?php echo Base_URL ?>PostController/add_post">
                        <i class="fas fa-blog"></i> Blogs
                    </a>
                </li>
                <li class="admin-menu-item <?php echo isset($currentPage) && $currentPage === 'category' ? 'active' : ''; ?>">
                    <a href="<?php echo Base_URL ?>ProductController">
                        <i class="fas fa-list"></i> Category
                    </a>
                </li>
                <li class="admin-menu-item <?php echo isset($currentPage) && $currentPage === 'product' ? 'active' : ''; ?>">
                    <a href="<?php echo Base_URL ?>ProductController/add_product">
                        <i class="fas fa-box"></i> Product
                    </a>
                </li>
                <li class="admin-menu-item <?php echo isset($currentPage) && $currentPage === 'orders' ? 'active' : ''; ?>">
                    <a href="#">
                        <i class="fas fa-shopping-cart"></i> Orders <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="admin-submenu">
                        <li><a href="<?php echo Base_URL ?>OrderController/addOrder">List</a></li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-bottom">
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
            </div>
        </aside>
        <div class="main-area">
            <header class="topbar">
                <div class="topbar-left">
                    <i class="fas fa-bars sidebar-toggle"></i>
                    <span class="topbar-title"><?php echo isset($pageTitle) ? $pageTitle : 'Dashboard'; ?></span>
                </div>
                <div class="topbar-right">
                    <!-- Thêm các nút thông báo, user ở đây nếu muốn -->
                </div>
            </header>
            <main class="main-content">
                <?php $load->view($viewFile, isset($data) ? $data : []); ?>
            </main>

        </div>
    </div>
    <script src="<?php echo Base_URL ?>public/template/js/admin.js"></script>
</body>

</html>