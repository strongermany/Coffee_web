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

    <!-- Add Category Button -->
    <div class="category-header">
        <h3 class="category-title">Category Management</h3>
        <button class="btn-add" onclick="openAddModal()">
            <i class="fas fa-plus"></i> Add New Category
        </button>
    </div>

    <!-- Modal Form -->
    <div id="addCategoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Category</h3>
                <span class="close" onclick="closeAddModal()">&times;</span>
            </div>
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
                    <button type="button" class="btn-cancel" onclick="closeAddModal()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Category List -->
    <div class="category-section">
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
    padding: 24px 32px;
    margin: 0;
    width: 100%;
}

.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.category-title {
    font-size: 24px;
    color: #333;
    margin: 0;
}

.btn-add {
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

.btn-add:hover {
    background: #388E3C;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    z-index: 1000;
}

.modal-content {
    position: relative;
    background-color: #fff;
    margin: 50px auto;
    padding: 20px;
    width: 90%;
    max-width: 600px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    animation: modalSlideIn 0.3s ease-out;
    box-sizing: border-box;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.modal-header h3 {
    margin: 0;
    color: #333;
}

.close {
    font-size: 24px;
    font-weight: bold;
    color: #666;
    cursor: pointer;
    transition: color 0.2s;
}

.close:hover {
    color: #333;
}

@keyframes modalSlideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Existing styles remain unchanged */
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
    gap: 10px;
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

.btn-cancel {
    background: #f44336;
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

.btn-cancel:hover {
    background: #d32f2f;
}

/* Table styles */
.category-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.category-table th,
.category-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.category-table th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #333;
}

.category-table td {
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.category-table td:nth-child(3) {
    white-space: pre-line;
    line-height: 1.4;
}

.table-actions {
    display: flex;
    gap: 8px;
}

.btn-edit,
.btn-delete {
    padding: 6px 12px;
    border-radius: 4px;
    color: white;
    text-decoration: none;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.btn-edit {
    background: #2196F3;
}

.btn-delete {
    background: #f44336;
}

.btn-edit:hover {
    background: #1976D2;
}

.btn-delete:hover {
    background: #d32f2f;
}

/* Notification styles */
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
.ck.ck-editor {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
}
.ck-editor__editable {
    min-height: 200px;
    box-sizing: border-box;
}
#description_editor {
    width: 100% !important;
}
</style>

<script>
// Modal functions
function openAddModal() {
    document.getElementById('addCategoryModal').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
    
    // Initialize CKEditor when modal opens
    if (!window.editor) {
        ClassicEditor
            .create(document.querySelector('#description_editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
                language: 'en',
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload'],
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }
}

function closeAddModal() {
    document.getElementById('addCategoryModal').style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling
    
    // Destroy CKEditor instance when modal closes
    if (window.editor) {
        window.editor.destroy()
            .then(() => {
                window.editor = null;
            })
            .catch(error => {
                console.error(error);
            });
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('addCategoryModal');
    if (event.target == modal) {
        closeAddModal();
    }
}

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

// Update form submission handler
document.querySelector('.category-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default submission
    
    if (window.editor) {
        // Get the editor content
        const editorContent = window.editor.getData();
        
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
    } else {
        alert('Editor not initialized');
        return false;
    }
});
</script>