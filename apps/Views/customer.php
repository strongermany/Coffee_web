<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="<?php echo Base_URL?>public/css/profileCustomer.css?v=123">
</head>
<body>
    

    <div class="profile-page">
        <div class="profile-container">
            <div class="profile-header">
                <h1>Thông tin tài khoản của bạn</h1>
            </div>

            <div class="profile-content">
                <!-- Sidebar Navigation -->
                <div class="profile-sidebar">
                    <div class="profile-nav">
                        <div class="nav-item active">
                            <i class="fas fa-user"></i>
                            <span>Thông tin cá nhân</span>
                        </div>
                        <div class="nav-item">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Đơn hàng của tôi</span>
                        </div>
                        <div class="nav-item">
                            <i class="fas fa-heart"></i>
                            <span>Sản phẩm yêu thích</span>
                        </div>
                        <div class="nav-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Địa chỉ giao hàng</span>
                        </div>
                        <div class="nav-item">
                            <i class="fas fa-lock"></i>
                            <span>Đổi mật khẩu</span>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="profile-main">
                    <div class="profile-section">
                        <h2>Thông tin cá nhân</h2>
                        <div class="profile-info">
                            <div class="info-group">
                                <label>Họ và tên</label>
                                <p><?php echo isset($customerInfo['customer_name']) ? $customerInfo['customer_name'] : ''; ?></p>
                            </div>
                            <div class="info-group">
                                <label>Email</label>
                                <p><?php echo isset($customerInfo['email']) ? $customerInfo['email'] : ''; ?></p>
                            </div>
                            <div class="info-group">
                                <label>Số điện thoại</label>
                                <p><?php echo isset($customerInfo['phone']) ? $customerInfo['phone'] : ''; ?></p>
                            </div>
                            <div class="info-group">
                                <label>Địa chỉ</label>
                                <p><?php echo isset($customerInfo['address']) ? $customerInfo['address'] : ''; ?></p>
                            </div>
                            <button class="edit-profile-btn" id="openEditProfileModal">Chỉnh sửa thông tin</button>
                        </div>
                    </div>

                    <div class="profile-section">
                        <h2>Đơn hàng gần đây</h2>
                        <div class="recent-orders">
                            <!-- Sẽ hiển thị danh sách đơn hàng gần đây ở đây -->
                            <p class="no-orders">Chưa có đơn hàng nào</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa thông tin -->
    <div id="editProfileModal" class="edit-profile-modal">
        <div class="edit-profile-modal-overlay"></div>
        <div class="edit-profile-modal-content">
            <h2>Chỉnh sửa thông tin</h2>
            <form id="editProfileForm" class="edit-form">
                <div class="form-group">
                    <label>Họ và tên</label>
                    <input type="text" name="customer_name" value="<?php echo $customerInfo['customer_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $customerInfo['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="tel" name="phone" value="<?php echo $customerInfo['phone']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea name="address" rows="3"><?php echo $customerInfo['address']; ?></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="save-btn">Lưu thay đổi</button>
                    <button type="button" class="cancel-btn" id="closeEditProfileModal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
    <div id="changePasswordModal" class="edit-profile-modal">
        <div class="edit-profile-modal-overlay"></div>
        <div class="edit-profile-modal-content">
            <h2>Đổi mật khẩu</h2>
            <form id="changePasswordForm" class="edit-form">
                <div class="form-group">
                    <label>Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label>Xác nhận mật khẩu mới</label>
                    <input type="password" name="confirm_password" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="save-btn">Đổi mật khẩu</button>
                    <button type="button" class="cancel-btn" id="closeChangePasswordModal">Hủy</button>
                </div>
            </form>
        </div>
    </div>

    <style>
    .edit-profile-modal {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    .edit-profile-modal.active {
        display: flex;
    }
    .edit-profile-modal-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.25);
        z-index: 1;
    }
    .edit-profile-modal-content {
        position: relative;
        z-index: 2;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(108, 56, 39, 0.18);
        padding: 32px 28px;
        min-width: 340px;
        max-width: 95vw;
        width: 400px;
        animation: modalFadeIn 0.2s;
    }
    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: none; }
    }
    .profile-blur {
        filter: blur(4px) brightness(0.8);
        pointer-events: none;
        user-select: none;
        transition: filter 0.2s;
    }
    .edit-form .form-group { margin-bottom: 18px; }
    .edit-form label { display: block; font-weight: 500; color: #a9744f; margin-bottom: 6px; }
    .edit-form input, .edit-form textarea {
        width: 100%; padding: 10px 14px; border: 1px solid #e1bc91; border-radius: 6px;
        background: #f7f3ef; color: #6c3827; font-size: 1rem; margin-bottom: 0;
    }
    .edit-form input:focus, .edit-form textarea:focus { border-color: #a9744f; outline: none; }
    .form-actions { display: flex; gap: 16px; margin-top: 18px; }
    .save-btn {
        background: linear-gradient(90deg, #a9744f 0%, #e1bc91 100%);
        color: #fff; border: none; padding: 10px 28px; border-radius: 6px;
        font-size: 1rem; font-weight: 600; cursor: pointer;
        box-shadow: 0 2px 8px rgba(108, 56, 39, 0.08);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .save-btn:hover {
        background: linear-gradient(90deg, #e1bc91 0%, #a9744f 100%);
        box-shadow: 0 4px 16px rgba(108, 56, 39, 0.13);
    }
    .cancel-btn {
        background: #fff; color: #a9744f; border: 1px solid #a9744f;
        padding: 10px 22px; border-radius: 6px; font-size: 1rem; font-weight: 600;
        transition: background 0.2s, color 0.2s;
    }
    .cancel-btn:hover { background: #f5eee6; color: #6c3827; }
    @media (max-width: 600px) {
        .edit-profile-modal-content { padding: 16px 6px; min-width: 0; width: 98vw; }
    }
    </style>

    <script>
    // Hiện modal
    document.getElementById('openEditProfileModal').onclick = function() {
        document.querySelector('.profile-page').classList.add('profile-blur');
        var header = document.querySelector('.main-header');
        if(header) header.classList.add('profile-blur');
        var footer = document.querySelector('.main-footer');
        if(footer) footer.classList.add('profile-blur');
        document.getElementById('editProfileModal').classList.add('active');
    };
    // Đóng modal
    document.getElementById('closeEditProfileModal').onclick = function() {
        document.querySelector('.profile-page').classList.remove('profile-blur');
        var header = document.querySelector('.main-header');
        if(header) header.classList.remove('profile-blur');
        var footer = document.querySelector('.main-footer');
        if(footer) footer.classList.remove('profile-blur');
        document.getElementById('editProfileModal').classList.remove('active');
    };
    // Gửi form AJAX
    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('<?php echo Base_URL?>CustomerController/updateProfile', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                window.location.href = '<?php echo Base_URL?>CustomerController';
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra, vui lòng thử lại');
        });
    });
    </script>
     <script>
    // ... existing code ...
    // Mở modal đổi mật khẩu khi click nav-item "Đổi mật khẩu"
    document.querySelectorAll('.nav-item').forEach(function(item) {
        if(item.textContent.includes('Đổi mật khẩu')) {
            item.onclick = function() {
                document.querySelector('.profile-page').classList.add('profile-blur');
                document.getElementById('changePasswordModal').classList.add('active');
            };
        }
    });
    // Đóng modal đổi mật khẩu
    document.getElementById('closeChangePasswordModal').onclick = function() {
        document.querySelector('.profile-page').classList.remove('profile-blur');
        document.getElementById('changePasswordModal').classList.remove('active');
    };
    // Gửi form đổi mật khẩu AJAX
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('<?php echo Base_URL?>CustomerController/changePassword', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                document.querySelector('.profile-page').classList.remove('profile-blur');
                document.getElementById('changePasswordModal').classList.remove('active');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra, vui lòng thử lại');
        });
    });
    // ... existing code ...
    </script>

</body>
</html>
