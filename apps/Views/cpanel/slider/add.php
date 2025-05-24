<?php
$message = null;
if (isset($_GET['msg'])) {
    $message = unserialize(urldecode($_GET['msg']));
}
?>
<div class="slider-container">
    <!-- Notification -->
    <div id="notification" class="notification" style="display: none;">
        <div class="notification-content">
            <span id="notification-message"></span>
            <button onclick="closeNotification()" class="notification-close">&times;</button>
        </div>
    </div>

    <!-- Header Section -->
    <div class="slider-header">
        <h2 class="slider-title">Slider Management</h2>
        <button class="slider-add-btn" onclick="toggleForm()">
            <i class="fas fa-plus"></i> Add New
        </button>
    </div>

    <!-- Add Form Section -->
    <div class="slider-form" id="addForm">
        <form action="<?php echo Base_URL; ?>SliderController/insert" method="POST" enctype="multipart/form-data">
            <div class="slider-upload-container">
                <label for="image" class="slider-upload-btn">
                    <i class="fas fa-cloud-upload-alt"></i> Choose Image
                </label>
                <input type="file" id="image" name="image" required style="display: none;">
                <span class="slider-filename">No file chosen</span>
                <div id="image-preview" class="slider-preview" style="display: none;">
                    <img src="" alt="Preview">
                </div>
            </div>
            <div class="slider-actions" style="margin-top: 24px;">
                <button type="submit" class="slider-submit">
                    <i class="fas fa-plus"></i> Add Slider
                </button>
                <button type="button" class="slider-cancel" onclick="toggleForm()">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>
    </div>

    <!-- List Section -->
    <div class="slider-table-container">
        <table class="slider-table">
            <thead>
                <tr>
                    <th>ID</th>
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
                            <td>
                                <img src="<?php echo Base_URL; ?>public/uploads/slider/<?php echo $slider['image']; ?>" 
                                     alt="Slider Image"
                                     class="slider-image">
                            </td>
                            <td>
                                <a href="<?php echo Base_URL; ?>SliderController/status/<?php echo $slider['id']; ?>" 
                                   class="slider-status <?php echo $slider['status'] == 1 ? 'active' : 'inactive'; ?>">
                                    <?php echo $slider['status'] == 1 ? 'Active' : 'Inactive'; ?>
                                </a>
                            </td>
                            <td class="slider-actions">
                                <a href="<?php echo Base_URL; ?>SliderController/delete/<?php echo $slider['id']; ?>" 
                                   class="slider-btn slider-btn-delete"
                                   onclick="return confirm('Are you sure you want to delete this slider?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No sliders found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleForm() {
    const form = document.getElementById('addForm');
    form.classList.toggle('active');
}

// Show file name and preview when chosen
document.getElementById('image').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || 'No file chosen';
    document.querySelector('.slider-filename').textContent = fileName;
    
    // Show image preview
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        const preview = document.getElementById('image-preview');
        const previewImg = preview.querySelector('img');
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(e.target.files[0]);
    }
});

// Validate file before upload
document.querySelector('form').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('image');
    const file = fileInput.files[0];
    
    if (file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            e.preventDefault();
            alert('Please select a valid image file (JPG, JPEG, PNG, GIF)');
            return false;
        }
    }
});

// Add these new functions for notification
function showNotification(message) {
    const notification = document.getElementById('notification');
    const messageElement = document.getElementById('notification-message');
    messageElement.textContent = message;
    notification.style.display = 'block';
    
    // Auto hide after 3 seconds
    setTimeout(() => {
        closeNotification();
    }, 3000);
}

function closeNotification() {
    const notification = document.getElementById('notification');
    notification.style.display = 'none';
}

// Show notification if message exists
<?php if ($message): ?>
showNotification('<?php echo addslashes($message['msg']); ?>');
<?php endif; ?>
</script>

<style>
.slider-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 24px 32px;
    margin: 0;
    width: 100%;
}

/* Add these styles for the notification */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    background: #48bb78;
    color: white;
    padding: 15px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    max-width: 300px;
}

.notification-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.notification-close {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    padding: 0 5px;
}

.notification-close:hover {
    opacity: 0.8;
}

/* Add animation */
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.notification {
    animation: slideIn 0.3s ease;
}

.slider-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    margin-top: 20px;
}

.slider-submit, .slider-cancel {
    padding: 8px 20px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
}

.slider-submit {
    background: #4299e1;
    color: #fff;
}

.slider-cancel {
    background: #e53e3e;
    color: #fff;
    /* Xóa mọi thuộc tính position nếu có */
    position: static;
}
</style> 