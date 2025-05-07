<?php
$message = null;
if (isset($_GET['msg'])) {
    $message = unserialize(urldecode($_GET['msg']));
}
?>

<div class="post-container">
    <!-- Notification -->
    <div id="notification" class="notification" style="display: <?php echo isset($message['msg']) ? 'block' : 'none'; ?>">
        <div class="notification-content">
            <span id="notification-message"><?php echo isset($message['msg']) ? $message['msg'] : ''; ?></span>
            <button onclick="closeNotification()" class="notification-close">&times;</button>
        </div>
    </div>

    <!-- Header Section -->
    <div class="post-header">
        <h2 class="post-title">Edit Blog</h2>
        <a href="<?php echo Base_URL ?>PostController/add_post" class="post-add-btn">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <!-- Edit Form Section -->
    <?php foreach ($data['postById'] as $key => $pos): ?>
    <div class="post-form active">
        <form action="<?php echo Base_URL ?>PostController/update_post/<?php echo $pos['Id_post']?>" method="POST" enctype="multipart/form-data">
            <div class="form-container">
                <div class="form-left">
                    <div class="post-form-group">
                        <label class="post-label">Blog Title</label>
                        <input type="text" value="<?php echo $pos['Title_post'] ?>" name="title_post" class="post-input" required>
                    </div>

                    <div class="post-form-group">
                        <label class="post-label">Featured Image</label>
                        <div class="post-upload-container">
                            <label for="image_post" class="post-upload-btn">
                                <i class="fas fa-cloud-upload-alt"></i> Choose New Image
                            </label>
                            <input type="file" id="image_post" name="image_post">
                            <span class="post-filename">Current: <?php echo $pos['Image_post'] ?></span>
                        </div>
                        <div id="image-preview" class="post-preview" style="display: block;">
                            <img src="<?php echo Base_URL ?>public/uploads/post/<?php echo $pos['Image_post'] ?>" alt="Current Image">
                        </div>
                    </div>
                </div>

                <div class="form-right">
                    <div class="post-form-group">
                        <label class="post-label">Blog Content</label>
                        <textarea name="content_post" id="content_post" class="post-textarea" required><?php echo $pos['Content_post'] ?></textarea>
                    </div>
                </div>
            </div>

            <div class="post-actions">
                <button type="submit" class="post-submit">
                    <i class="fas fa-save"></i> Update Blog
                </button>
                <a href="<?php echo Base_URL ?>PostController/add_post" class="post-cancel">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
    <?php endforeach; ?>
</div>

<style>
/* Post Management Styles */
.post-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 24px 32px;
    margin: 0;
    width: 100%;
}

.post-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e2e8f0;
}

.post-title {
    font-size: 24px;
    color: #2c5282;
    font-weight: 600;
}

.post-add-btn {
    background: #4299e1;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background 0.3s ease;
    text-decoration: none;
}

.post-add-btn:hover {
    background: #2b6cb0;
    color: white;
}

.post-form {
    background: white;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #e2e8f0;
}

.form-container {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.form-left {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-right {
    flex: 1.5;
}

.post-form-group {
    margin-bottom: 15px;
}

.post-label {
    display: block;
    margin-bottom: 8px;
    color: #4a5568;
    font-weight: 500;
}

.post-input,
.post-textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.post-input:focus,
.post-textarea:focus {
    outline: none;
    border-color: #4299e1;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
}

.post-textarea {
    resize: vertical;
    min-height: 200px;
}

.post-upload-container {
    margin-top: 8px;
}

.post-upload-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #4299e1;
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.post-upload-btn:hover {
    background: #2b6cb0;
}

.post-filename {
    margin-left: 10px;
    color: #718096;
    font-size: 0.875rem;
}

.post-preview {
    margin-top: 15px;
    max-width: 300px;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
}

.post-preview img {
    width: 100%;
    height: auto;
    display: block;
}

.post-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    padding-top: 20px;
    border-top: 1px solid #e2e8f0;
}

.post-submit,
.post-cancel {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.post-submit {
    background: #48bb78;
    color: white;
}

.post-submit:hover {
    background: #38a169;
}

.post-cancel {
    background: #e53e3e;
    color: white;
}

.post-cancel:hover {
    background: #c53030;
    color: white;
}

/* Notification Styles */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    background: #48bb78;
    color: white;
    padding: 15px 20px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
    padding: 0;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.notification-close:hover {
    opacity: 1;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .form-container {
        flex-direction: column;
    }
    
    .form-left,
    .form-right {
        flex: none;
    }
    
    .post-actions {
        flex-direction: column;
    }
}
</style>

<script>
document.getElementById('image_post').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || 'No file chosen';
    document.querySelector('.post-filename').textContent = fileName;
    
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

function closeNotification() {
    document.getElementById('notification').style.display = 'none';
}

// Auto hide notification after 3 seconds
if (document.getElementById('notification')) {
    setTimeout(closeNotification, 3000);
}

// Initialize CKEditor
ClassicEditor
    .create(document.querySelector('#content_post'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
        language: 'en'
    })
    .catch(error => {
        console.error(error);
    });
</script>