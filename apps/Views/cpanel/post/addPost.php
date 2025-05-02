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
        <h2 class="post-title">Blog Management</h2>
        <button type="button" class="post-add-btn" onclick="toggleForm()">
            <i class="fas fa-plus"></i> Add New Blog
        </button>
    </div>

    <!-- Add Form Section -->
    <div class="post-form" id="addForm" style="display: none;">
        <form action="<?php echo Base_URL ?>PostController/insert_post" method="POST" enctype="multipart/form-data" id="blogForm">
            <div class="form-container">
                <div class="form-left">
                    <div class="post-form-group">
                        <label for="title_post" class="post-label">Blog Title</label>
                        <input type="text" name="title_post" id="title_post" class="post-input" required>
                    </div>

                    <div class="post-form-group">
                        <label class="post-label">Featured Image</label>
                        <div class="post-upload-container">
                            <label for="image_post" class="post-upload-btn">
                                <i class="fas fa-cloud-upload-alt"></i> Choose Image
                            </label>
                            <input type="file" id="image_post" name="image_post" accept="image/*" required>
                            <span class="post-filename">No file chosen</span>
                        </div>
                        <div id="image-preview" class="post-preview" style="display: none;">
                            <img src="" alt="Preview">
                        </div>
                    </div>
                </div>

                <div class="form-right">
                    <div class="post-form-group">
                        <label for="content_post" class="post-label">Blog Content</label>
                        <div id="editor-container">
                            <div id="editor"></div>
                            <input type="hidden" name="content_post" id="content_post">
                        </div>
                    </div>
                </div>
            </div>

            <div class="post-actions">
                <button type="submit" class="post-submit" id="submitBtn">
                    <i class="fas fa-plus"></i> Add Blog
                </button>
                <button type="button" class="post-cancel" onclick="toggleForm()">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>
    </div>

    <!-- List Section -->
    <div class="post-table-container">
        <table class="post-table">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">Title</th>
                    <th width="15%">Image</th>
                    <th width="30%">Content Preview</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($post) && !empty($post)): ?>
                    <?php foreach ($post as $key => $pos): ?>
                        <tr>
                            <td><?php echo $pos['Id_post'] ?></td>
                            <td><?php echo $pos['Title_post'] ?></td>
                            <td>
                                <img src="<?php echo Base_URL?>public/uploads/post/<?php echo $pos['Image_post'] ?>" 
                                     alt="Post Image"
                                     class="post-image">
                            </td>
                            <td class="post-content-preview">
                                <?php 
                                    // Strip tags but preserve line breaks
                                    $content = strip_tags($pos['Content_post'], '<br><p>');
                                    // Limit to 200 characters
                                    echo substr($content, 0, 200) . (strlen($content) > 200 ? '...' : '');
                                ?>
                            </td>
                            <td class="post-actions">
                                <a href="<?php echo Base_URL ?>PostController/edit_post/<?php echo $pos['Id_post'] ?>" 
                                   class="post-btn post-btn-edit"
                                   title="Edit Blog">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="javascript:void(0)" 
                                   onclick="confirmDelete('<?php echo Base_URL ?>PostController/delete_post/<?php echo $pos['Id_post'] ?>')"
                                   class="post-btn post-btn-delete"
                                   title="Delete Blog">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No posts found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
/* Post Management Styles */
.post-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px;
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
    font-size: 14px;
    font-weight: 500;
}

.post-add-btn:hover {
    background: #2b6cb0;
}

.post-form {
    display: none;
    background: white;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #e2e8f0;
}

.post-form.active {
    display: block;
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
    width: 100%;
    min-height: 300px;
    padding: 15px;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    font-size: 14px;
    line-height: 1.6;
}

.post-textarea:focus {
    outline: none;
    border-color: #4299e1;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
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
}

/* Table Styles */
.post-table-container {
    margin-top: 30px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    overflow: hidden;
}

.post-table {
    width: 100%;
    border-collapse: collapse;
}

.post-table th,
.post-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
}

.post-table th {
    background: #f7fafc;
    color: #4a5568;
    font-weight: 600;
    white-space: nowrap;
}

.post-table tr:hover {
    background: #f8fafc;
}

.post-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 4px;
}

td.post-actions {
    display: flex;
    gap: 8px;
}

.post-btn {
    padding: 6px 12px;
    border-radius: 4px;
    color: white;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.post-btn-edit {
    background: #4299e1;
}

.post-btn-edit:hover {
    background: #2b6cb0;
}

.post-btn-delete {
    background: #e53e3e;
}

.post-btn-delete:hover {
    background: #c53030;
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
    
    .post-table {
        display: block;
        overflow-x: auto;
    }
    
    td.post-actions {
        flex-direction: column;
    }
    
    .post-btn {
        width: 100%;
        justify-content: center;
    }
}

.ck-editor__editable {
    min-height: 300px !important;
    max-height: 500px !important;
}

.ck.ck-editor__main > .ck-editor__editable {
    background-color: #ffffff;
}

.ck.ck-editor {
    width: 100% !important;
}

#editor-container {
    margin-bottom: 20px;
}

/* Hide the original textarea */
#content_post {
    display: none;
}

/* Add this to your CSS section */
.post-content-preview {
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: pre-line;
    line-height: 1.4;
    font-size: 14px;
    color: #4a5568;
}

.post-content-preview p {
    margin: 0;
}
</style>

<!-- Include CKEditor from CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<script>
// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    let editor = null;

    // Function to initialize CKEditor
    function initEditor() {
        if (editor) {
            return; // Editor already initialized
        }

        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'blockQuote',
                        'undo',
                        'redo'
                    ]
                },
                placeholder: 'Write your blog content here...',
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload']
            })
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });
    }

    // Form submission handling
    const form = document.getElementById('blogForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (editor) {
                // Get content from CKEditor and update hidden input
                const content = editor.getData();
                document.getElementById('content_post').value = content;

                // Basic validation
                if (!content.trim()) {
                    e.preventDefault();
                    alert('Please enter blog content');
                    return false;
                }
            }

            // File validation
            const fileInput = document.getElementById('image_post');
            if (fileInput && fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    e.preventDefault();
                    alert('Please select a valid image file (JPG, JPEG, PNG, GIF)');
                    return false;
                }
            }
        });
    }

    // File preview handling
    const imageInput = document.getElementById('image_post');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'No file chosen';
            const filenameElement = document.querySelector('.post-filename');
            if (filenameElement) {
                filenameElement.textContent = fileName;
            }
            
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                const preview = document.getElementById('image-preview');
                if (preview) {
                    const previewImg = preview.querySelector('img');
                    
                    reader.onload = function(e) {
                        if (previewImg) {
                            previewImg.src = e.target.result;
                            preview.style.display = 'block';
                        }
                    }
                    
                    reader.readAsDataURL(e.target.files[0]);
                }
            }
        });
    }

    // Initialize editor when form is shown
    window.toggleForm = function() {
        const form = document.getElementById('addForm');
        if (form) {
            const isHidden = form.style.display === 'none';
            form.style.display = isHidden ? 'block' : 'none';
            
            // Initialize editor when form is shown
            if (isHidden && !editor) {
                initEditor();
            }
        }
    };
});

function closeNotification() {
    document.getElementById('notification').style.display = 'none';
}

function confirmDelete(deleteUrl) {
    if (confirm('Are you sure you want to delete this blog post? This action cannot be undone.')) {
        window.location.href = deleteUrl;
    }
}

// Auto hide notification after 3 seconds
if (document.getElementById('notification')) {
    setTimeout(function() {
        document.getElementById('notification').style.display = 'none';
    }, 3000);
}
</script>