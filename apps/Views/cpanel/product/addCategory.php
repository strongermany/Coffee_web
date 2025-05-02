<?php
$message = null;
if (isset($_GET['msg'])) {
    $message = unserialize(urldecode($_GET['msg']));
}
?>

<div class="category-container">
    <!-- Notification -->
    <div id="notification" class="notification" style="display: <?php echo isset($message['msg']) ? 'block' : 'none'; ?>">
        <?php echo isset($message['msg']) ? $message['msg'] : ''; ?>
        <span class="notification-close" onclick="closeNotification()">&times;</span>
    </div>

    <div class="category-section">
        <h3 class="category-title">Add Category</h3>

        <form class="category-form" autocomplete="off" action="<?php echo Base_URL ?>ProductController/insert_category" method="POST">
            <div class="form-group">
                <label for="category" class="form-label">Category Name</label>
                <input type="text" name="Category" id="category" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <div id="description_editor"></div>
                <input type="hidden" name="Description" id="description_content">
            </div>
            
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="status" name="status">
                <label class="form-check-label" for="status">Active Status</label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-plus"></i> Add Category
                </button>
            </div>
        </form>
    </div>

    <div class="category-section">
        <h3 class="category-title">Category List</h3>
        
        <div class="table-container">
            <table class="category-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($category as $key => $cate) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $cate['Category'] ?></td>
                            <td><?php echo $cate['Descript_Cate'] ?></td>
                            <td class="table-actions">
                                <a href="<?php echo Base_URL ?>ProductController/edit_category/<?php echo $cate['Id_Cate'] ?>" 
                                   class="btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="javascript:void(0)" 
                                   onclick="confirmDelete('<?php echo Base_URL ?>ProductController/delete_category/<?php echo $cate['Id_Cate'] ?>')"
                                   class="btn-delete">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>    
            </table>
        </div>
    </div>
</div>

<style>
.category-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 20px;
    margin: 20px;
}

.category-title {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #eee;
}

.category-form {
    max-width: 800px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 500;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-control:focus {
    outline: none;
    border-color: #4a90e2;
    box-shadow: 0 0 0 2px rgba(74,144,226,0.2);
}

.form-check {
    margin-bottom: 20px;
}

.form-check-input {
    margin-right: 8px;
}

.form-check-label {
    color: #333;
    user-select: none;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.btn-submit {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    transition: background 0.3s ease;
}

.btn-submit:hover {
    background: #388E3C;
}

.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #48bb78;
    color: white;
    padding: 16px 24px;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    z-index: 1000;
    min-width: 300px;
    animation: slideIn 0.3s ease-out;
}

.notification-close {
    cursor: pointer;
    font-size: 20px;
    font-weight: bold;
    color: white;
    opacity: 0.8;
    transition: opacity 0.2s;
}

.notification-close:hover {
    opacity: 1;
}

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

/* CKEditor Styles */
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

/* Add this to your table styles */
.category-table td {
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.category-table td:nth-child(3) { /* Description column */
    white-space: pre-line;
    line-height: 1.4;
}
</style>

<script>
function closeNotification() {
    document.getElementById('notification').style.display = 'none';
}

function confirmDelete(deleteUrl) {
    if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
        window.location.href = deleteUrl;
    }
}

// Auto hide notification after 3 seconds
if (document.getElementById('notification')) {
    setTimeout(closeNotification, 3000);
}

// Initialize CKEditor
ClassicEditor
    .create(document.querySelector('#description_editor'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
        language: 'en',
        removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload'],
    })
    .then(editor => {
        // Store editor instance
        window.editor = editor;

        // Update hidden input before form submission
        document.querySelector('.category-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default submission
            
            // Get the editor content
            const editorContent = editor.getData();
            
            // Update hidden input
            document.querySelector('#description_content').value = editorContent;
            
            // Check content length
            if (editorContent.length > 0) {
                // Submit the form
                this.submit();
            } else {
                alert('Please enter a description');
                return false;
            }
        });
    })
    .catch(error => {
        console.error(error);
    });
</script>