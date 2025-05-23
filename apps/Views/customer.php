<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
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
                            <div class="profile-info-row">
                                <div class="info-group">
                                    <label>Họ và tên</label>
                                    <p><?php echo isset($customerInfo['customer_name']) ? $customerInfo['customer_name'] : ''; ?></p>
                                </div>
                                <div class="info-group">
                                    <label>Email</label>
                                    <p><?php echo isset($customerInfo['email']) ? $customerInfo['email'] : ''; ?></p>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="info-group">
                                    <label>Số điện thoại</label>
                                    <p><?php echo isset($customerInfo['phone']) ? $customerInfo['phone'] : ''; ?></p>
                                </div>
                                <div class="info-group">
                                    <label>Địa chỉ</label>
                                    <p><?php echo isset($customerInfo['address']) ? $customerInfo['address'] : ''; ?></p>
                                </div>
                            </div>
                            <button class="edit-profile-btn" id="openEditProfileModal">Chỉnh sửa thông tin</button>
                        </div>
                    </div>

                    <div class="profile-section">
                        <h2>Đơn hàng gần đây</h2>
                        <div class="recent-orders">
                            <?php if (!empty($orders)): ?>
                                <div class="orders-list">
                                    <?php foreach ($orders as $order): ?>
                                        <div class="order-card">
                                            <div class="order-header">
                                                <span class="order-id">Mã đơn: #<?php echo $order['order_id']; ?></span>
                                                <span class="order-date"><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></span>
                                            </div>
                                            <div class="order-details">
                                                <div class="order-info">
                                                    <p><strong>Tổng tiền:</strong> <?php echo number_format($order['total_amount'], 0, ',', '.'); ?> đ</p>
                                                    <p><strong>Trạng thái:</strong> 
                                                        <span class="status-badge <?php echo strtolower($order['status']); ?>">
                                                            <?php echo ucfirst($order['status']); ?>
                                                        </span>
                                                    </p>
                                                    <p><strong>Phương thức thanh toán:</strong> <?php echo ucfirst($order['payment_method']); ?></p>
                                                    <button class="toggle-order-items-btn" onclick="toggleOrderItems(this)">Chi tiết đơn hàng</button>
                                                </div>
                                                <?php if (!empty($order['items'])): ?>
                                                <div class="order-items" style="display:none;">
                                                    <?php foreach ($order['items'] as $item): ?>
                                                        <?php
                                                        $imgFolder = (isset($item['type']) && $item['type'] === 'item') ? 'items' : 'product';
                                                        ?>
                                                        <div class="order-item">
                                                            <img src="<?php echo Base_URL . 'public/uploads/' . $imgFolder . '/' . $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="item-image">
                                                            <div class="item-details">
                                                                <h4><?php echo $item['name']; ?></h4>
                                                                <p>Số lượng: <?php echo $item['quantity']; ?></p>
                                                                <p>Giá: <?php echo number_format($item['price'], 0, ',', '.'); ?> đ</p>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="no-orders">Chưa có đơn hàng nào</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa thông tin -->
    <div id="editProfileModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-container">
            <div class="modal-header">
                <h2>Chỉnh sửa thông tin</h2>
                <button class="modal-close" id="closeEditProfileModal">&times;</button>
            </div>
            <div class="modal-content">
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
                        <button type="button" class="cancel-btn" id="closeEditProfileModalBtn">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal đổi mật khẩu -->
    <div id="changePasswordModal" class="modal password-modal">
        <div class="modal-overlay"></div>
        <div class="modal-container">
            <div class="modal-header">
                <h2><i class="fas fa-lock"></i> Đổi mật khẩu</h2>
                <button class="modal-close" id="closeChangePasswordModal">&times;</button>
            </div>
            <div class="modal-content">
                <form id="changePasswordForm" class="edit-form">
                    <div class="form-group password-group">
                        <label>Mật khẩu hiện tại</label>
                        <div class="password-input-group">
                            <input type="password" name="current_password" required>
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group password-group">
                        <label>Mật khẩu mới</label>
                        <div class="password-input-group">
                            <input type="password" name="new_password" required>
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group password-group">
                        <label>Xác nhận mật khẩu mới</label>
                        <div class="password-input-group">
                            <input type="password" name="confirm_password" required>
                            <button type="button" class="toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="save-btn">
                            <i class="fas fa-key"></i> Đổi mật khẩu
                        </button>
                        <button type="button" class="cancel-btn" id="closeChangePasswordModalBtn">
                            <i class="fas fa-times"></i> Hủy
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
    /* Common Modal Animation Styles */
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes modalOverlayFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Base Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
        font-family: 'Oswald', sans-serif;
    }

    .modal.active {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(108, 56, 39, 0.3);
        backdrop-filter: blur(5px);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal.active .modal-overlay {
        opacity: 1;
        animation: modalOverlayFadeIn 0.3s ease forwards;
    }

    .modal-container {
        position: relative;
        width: 90%;
        max-width: 500px;
        margin: 20px;
        background: #f7f3ef;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(108, 56, 39, 0.15);
        opacity: 0;
        transform: scale(0.95) translateY(-20px);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .modal.active .modal-container {
        opacity: 1;
        transform: scale(1) translateY(0);
        animation: modalFadeIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px 32px;
        border-bottom: 2px solid rgba(169, 116, 79, 0.1);
        background: #fff;
        border-radius: 16px 16px 0 0;
    }

    .modal-header h2 {
        margin: 0;
        color: #6c3827;
        font-size: 1.8rem;
        font-weight: 500;
        font-family: 'Oswald', sans-serif;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .modal-header h2 i {
        color: #a9744f;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 28px;
        color: #a9744f;
        cursor: pointer;
        transition: all 0.3s;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        padding: 0;
        margin: -8px;
    }

    .modal-close:hover {
        background: #f8e8dd;
        color: #6c3827;
        transform: rotate(90deg);
    }

    .modal-content {
        padding: 32px;
        background: #f7f3ef;
        border-radius: 0 0 16px 16px;
    }

    /* Form Styles */
    .edit-form .form-group {
        margin-bottom: 24px;
        transition: all 0.3s ease;
    }

    .edit-form .form-group:hover {
        transform: translateX(5px);
    }

    .edit-form label {
        display: block;
        margin-bottom: 10px;
        color: #6c3827;
        font-weight: 500;
        font-size: 1.1rem;
        letter-spacing: 0.3px;
        transition: color 0.3s ease;
    }

    .edit-form .form-group:hover label {
        color: #a9744f;
    }

    .edit-form input,
    .edit-form textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e1bc91;
        border-radius: 10px;
        font-size: 1rem;
        background: #fff;
        color: #6c3827;
        transition: all 0.3s ease;
        font-family: 'Roboto', sans-serif;
    }

    .edit-form input:focus,
    .edit-form textarea:focus {
        border-color: #a9744f;
        box-shadow: 0 0 0 3px rgba(169, 116, 79, 0.15);
        transform: translateY(-2px);
    }

    .form-actions {
        display: flex;
        gap: 16px;
        justify-content: flex-end;
        margin-top: 32px;
    }

    .save-btn,
    .cancel-btn {
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        font-size: 1rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-family: 'Oswald', sans-serif;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .save-btn {
        background: linear-gradient(135deg, #a9744f 0%, #6c3827 100%);
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(169, 116, 79, 0.2);
    }

    .save-btn:hover {
        background: linear-gradient(135deg, #8c5e3d 0%, #522a1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(169, 116, 79, 0.3);
    }

    .save-btn:active {
        transform: translateY(0);
    }

    .cancel-btn {
        background: transparent;
        color: #a9744f;
        border: 2px solid #a9744f;
    }

    .cancel-btn:hover {
        background: #f8e8dd;
        color: #6c3827;
        border-color: #6c3827;
        transform: translateY(-2px);
    }

    .cancel-btn:active {
        transform: translateY(0);
    }

    /* Blur effect */
    .blur-background {
        filter: blur(5px) brightness(0.95);
        transition: filter 0.3s ease;
    }

    /* Responsive styles */
    @media (max-width: 600px) {
        .modal-container {
            width: 95%;
            margin: 10px;
        }
        
        .modal-header {
            padding: 20px;
        }
        
        .modal-content {
            padding: 20px;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .save-btn,
        .cancel-btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* Password Modal Specific Styles */
    .password-modal .password-input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .password-input-group input {
        padding-right: 45px;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        background: none;
        border: none;
        color: #a9744f;
        cursor: pointer;
        padding: 5px;
        font-size: 1.1rem;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }

    .toggle-password:hover {
        background: #f8e8dd;
        color: #6c3827;
        transform: rotate(180deg);
    }

    .password-group {
        position: relative;
    }

    .password-group::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(to right, #e1bc91 0%, transparent 100%);
        opacity: 0.3;
        transition: opacity 0.3s ease;
    }

    .password-group:hover::after {
        opacity: 0.6;
    }

    .password-group:last-of-type::after {
        display: none;
    }

    .orders-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .order-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .order-header {
        background: #f8f9fa;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
    }

    .order-id {
        font-weight: 600;
        color: #6c3827;
    }

    .order-date {
        color: #666;
    }

    .order-details {
        padding: 20px;
    }

    .order-info {
        margin-bottom: 20px;
    }

    .order-info p {
        margin: 8px 0;
        color: #333;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: 500;
    }

    .status-badge.pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-badge.paid {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .order-items {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .order-item {
        display: flex;
        gap: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .item-details {
        flex: 1;
    }

    .item-details h4 {
        margin: 0 0 8px 0;
        color: #333;
    }

    .item-details p {
        margin: 4px 0;
        color: #666;
    }

    .no-orders {
        text-align: center;
        color: #666;
        padding: 30px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const editProfileModal = document.getElementById('editProfileModal');
        const changePasswordModal = document.getElementById('changePasswordModal');
        const mainContent = document.querySelector('.profile-page');
        const changePasswordNavItem = document.querySelector('.nav-item:has(.fa-lock)');

        // Modal functions
        function closeModal(modal) {
            modal.classList.remove('active');
            mainContent.classList.remove('blur-background');
        }

        function togglePasswordVisibility(button) {
            const input = button.parentElement.querySelector('input');
            const icon = button.querySelector('i');
            const isPassword = input.type === 'password';
            
            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

        // Event Listeners
        document.getElementById('openEditProfileModal').addEventListener('click', () => {
            editProfileModal.classList.add('active');
            mainContent.classList.add('blur-background');
        });

        changePasswordNavItem.addEventListener('click', (e) => {
            e.preventDefault();
            changePasswordModal.classList.add('active');
            mainContent.classList.add('blur-background');
        });

        // Close buttons
        ['closeEditProfileModal', 'closeEditProfileModalBtn'].forEach(id => {
            document.getElementById(id)?.addEventListener('click', () => closeModal(editProfileModal));
        });

        ['closeChangePasswordModal', 'closeChangePasswordModalBtn'].forEach(id => {
            document.getElementById(id)?.addEventListener('click', () => closeModal(changePasswordModal));
        });

        // Close on overlay click and Escape key
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) closeModal(e.target.parentElement);
            });
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal(editProfileModal);
                closeModal(changePasswordModal);
            }
        });

        // Password visibility toggles
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', () => togglePasswordVisibility(button));
        });

        // Form submissions
        document.getElementById('editProfileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            fetch('<?php echo Base_URL ?>CustomerController/updateProfile', {
                method: 'POST',
                body: new FormData(this)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') location.reload();
            });
        });

        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            if (formData.get('new_password') !== formData.get('confirm_password')) {
                alert('Mật khẩu mới không khớp!');
                return;
            }
            
            if (formData.get('new_password').length < 8) {
                alert('Mật khẩu phải có ít nhất 8 ký tự!');
                return;
            }
            
            fetch('<?php echo Base_URL ?>CustomerController/changePassword', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') location.reload();
            });
        });
    });

    function toggleOrderItems(btn) {
        var itemsDiv = btn.parentElement.parentElement.querySelector('.order-items');
        if (itemsDiv) {
            if (itemsDiv.style.display === 'none' || itemsDiv.style.display === '') {
                itemsDiv.style.display = 'block';
                btn.textContent = 'Ẩn chi tiết đơn hàng';
            } else {
                itemsDiv.style.display = 'none';
                btn.textContent = 'Chi tiết đơn hàng';
            }
        }
    }
    </script>

</body>
</html>
