<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/template/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <aside class="admin-sidebar">
        <link rel="stylesheet" href="<?php echo Base_URL ?>public/template/css/styles.css">
        <div class="admin-profile">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin Avatar" class="admin-avatar">
            <div class="admin-info">
                <span class="admin-name">Admin</span>
                <span class="admin-role">Quản trị viên</span>
            </div>
        </div>
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
                <a data-bs-toggle="collapse" href="#sliderMenu" role="button" aria-expanded="false" aria-controls="sliderMenu">
                    <i class="fas fa-sliders-h"></i> Slider <i class="fas fa-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="collapse admin-submenu" id="sliderMenu">
                    <li><a href="<?php echo Base_URL ?>SliderController/add">Add Slider</a></li>
                    <li><a href="<?php echo Base_URL ?>SliderController">List Slider</a></li>
                </ul>
            </li>
            <li class="admin-menu-item">
                <a data-bs-toggle="collapse" href="#catBlogMenu" role="button" aria-expanded="false" aria-controls="catBlogMenu">
                    <i class="fas fa-folder-open"></i> Category Blogs <i class="fas fa-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="collapse admin-submenu" id="catBlogMenu">
                    <li><a href="<?php echo Base_URL ?>PostController/">Add</a></li>
                    <li><a href="<?php echo Base_URL ?>PostController/list_category_post">List</a></li>
                </ul>
            </li>
            <li class="admin-menu-item">
                <a data-bs-toggle="collapse" href="#blogMenu" role="button" aria-expanded="false" aria-controls="blogMenu">
                    <i class="fas fa-blog"></i> Blogs <i class="fas fa-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="collapse admin-submenu" id="blogMenu">
                    <li><a href="<?php echo Base_URL ?>PostController/add_post">Add</a></li>
                    <li><a href="<?php echo Base_URL ?>PostController/list_post">List</a></li>
                </ul>
            </li>
            <li class="admin-menu-item">
                <a data-bs-toggle="collapse" href="#catMenu" role="button" aria-expanded="false" aria-controls="catMenu">
                    <i class="fas fa-list"></i> Category <i class="fas fa-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="collapse admin-submenu" id="catMenu">
                    <li><a href="<?php echo Base_URL ?>ProductController/">Add</a></li>
                    <li><a href="<?php echo Base_URL ?>ProductController/list_category">List Category</a></li>
                </ul>
            </li>
            <li class="admin-menu-item">
                <a data-bs-toggle="collapse" href="#productMenu" role="button" aria-expanded="false" aria-controls="productMenu">
                    <i class="fas fa-box"></i> Product <i class="fas fa-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="collapse admin-submenu" id="productMenu">
                    <li><a href="<?php echo Base_URL?>ProductController/add_product">Add</a></li>
                    <li><a href="<?php echo Base_URL?>ProductController/list_product">List</a></li>
                </ul>
            </li>
            <li class="admin-menu-item">
                <a data-bs-toggle="collapse" href="#orderMenu" role="button" aria-expanded="false" aria-controls="orderMenu">
                    <i class="fas fa-shopping-cart"></i> Orders <i class="fas fa-chevron-down dropdown-arrow"></i>
                </a>
                <ul class="collapse admin-submenu" id="orderMenu">
                    <li><a href="<?php echo Base_URL?>OrderController/addOrder">List</a></li>
                </ul>
            </li>
        </ul>
        <script src="<?php echo Base_URL ?>public/template/js/admin.js"></script>
    </aside>
    <div class="admin-main-content">
<?php
if (isset($_GET['msg'])) {
    $message = unserialize(urldecode($_GET['msg']));
    echo "<script>alert('".$message['msg']."')</script>";
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Slider List</h3>
                    <div class="card-tools">
                        <a href="<?php echo Base_URL; ?>SliderController/add" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['sliders'])): ?>
                                <?php foreach ($data['sliders'] as $slider): ?>
                                    <tr>
                                        <td><?php echo $slider['id']; ?></td>
                                        <td><?php echo $slider['title']; ?></td>
                                        <td>
                                            <img src="<?php echo Base_URL; ?>public/uploads/slider/<?php echo $slider['image']; ?>" 
                                                 alt="<?php echo $slider['title']; ?>" 
                                                 style="max-width: 100px; max-height: 100px;">
                                        </td>
                                        <td>
                                            <?php if ($slider['status'] == 1): ?>
                                                <a href="<?php echo Base_URL; ?>SliderController/status/<?php echo $slider['id']; ?>" 
                                                   class="btn btn-success btn-sm">Active</a>
                                            <?php else: ?>
                                                <a href="<?php echo Base_URL; ?>SliderController/status/<?php echo $slider['id']; ?>" 
                                                   class="btn btn-danger btn-sm">Inactive</a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo Base_URL; ?>SliderController/edit/<?php echo $slider['id']; ?>" 
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?php echo Base_URL; ?>SliderController/delete/<?php echo $slider['id']; ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Are you sure you want to delete this slider?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No sliders found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
    </div>
</body>
</html> 