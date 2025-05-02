<?php
$message = null;
if (isset($_GET['msg'])) {
    $message = unserialize(urldecode($_GET['msg']));
}
?>

<!-- Product Management Container -->
<div class="product-container">
    <!-- Notification -->
    <div id="notification" class="notification" style="display: <?php echo isset($message['msg']) ? 'block' : 'none'; ?>">
        <div class="notification-content">
            <span id="notification-message"><?php echo isset($message['msg']) ? $message['msg'] : ''; ?></span>
            <button onclick="closeNotification()" class="notification-close">&times;</button>
        </div>
    </div>

    <!-- Header Section -->
    <div class="product-header">
        <h2 class="product-title">Product Management</h2>
        <button type="button" class="btn-add" onclick="toggleForm()">
            <i class="fas fa-plus"></i> Add New Product
        </button>
    </div>

    <!-- Add Form Section -->
    <div class="product-form" id="addForm" style="display: none;">
        <form action="<?php echo Base_URL ?>ProductController/insert_product" method="POST" enctype="multipart/form-data">
            <div class="form-container">
                <div class="form-left">
                    <div class="form-group">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="title_product" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Product Category</label>
                        <select class="form-control" name="product_category">
                            <?php foreach($category as $cate): ?>
                                <option value="<?php echo $cate['Id_Cate']?>"><?php echo $cate['Category']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-right">
                    <div class="form-group">
                        <label class="form-label">Product Image</label>
                        <div class="upload-container">
                            <label for="image" class="upload-btn">
                                <i class="fas fa-cloud-upload-alt"></i> Choose Image
                            </label>
                            <input type="file" id="image" name="image" accept="image/*" required>
                            <span class="filename">No file chosen</span>
                        </div>
                        <div id="image-preview" class="preview" style="display: none;">
                            <img src="" alt="Preview">
                            <button type="button" class="remove-image" onclick="removeImage()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Product Description</label>
                        <div id="description_editor"></div>
                        <input type="hidden" name="desc_product" id="description_content">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-plus"></i> Add Product
                </button>
                <button type="button" class="btn-cancel" onclick="toggleForm()">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>
    </div>

    <!-- Product List Section -->
    <div class="product-table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Name</th>
                    <th width="10%">Image</th>
                    <th width="10%">Category</th>
                    <th width="10%">Price</th>
                    <th width="5%">Quantity</th>
                    <th width="30%">Description</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($product as $key => $pro):
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $pro['Title_product'] ?></td>
                        <td>
                            <img src="<?php echo Base_URL?>public/uploads/product/<?php echo $pro['Images_product'] ?>" 
                                 alt="Product Image"
                                 class="product-image">
                        </td>
                        <td><?php echo $pro['Category'] ?></td>
                        <td><?php echo number_format($pro['Price_product'],0,',','.').'$'?></td>
                        <td><?php echo $pro['Quantity_product'] ?></td>
                        <td class="description-preview">
                            <?php 
                                $desc = !empty($pro['Desc_product']) ? $pro['Desc_product'] : '';
                                // Strip tags but preserve line breaks
                                $desc = strip_tags($desc, '<br><p>');
                                // Limit to 200 characters
                                echo substr($desc, 0, 200) . (strlen($desc) > 200 ? '...' : '');
                            ?>
                        </td>
                        <td class="action-cell">
                            <a href="<?php echo Base_URL ?>ProductController/edit_product/<?php echo $pro['Id_product'] ?>" 
                               class="btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button onclick="confirmDelete('<?php echo Base_URL ?>ProductController/delete_product/<?php echo $pro['Id_product'] ?>')"
                                    class="btn-delete">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>    
        </table>
    </div>
</div>

<style>
.product-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 20px;
    margin: 20px;
}

.product-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #eee;
}

.product-title {
    font-size: 24px;
    color: #333;
    font-weight: 600;
}

.form-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 20px;
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

.upload-container {
    margin-top: 8px;
}

.upload-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #4a90e2;
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.upload-btn:hover {
    background: #357abd;
}

input[type="file"] {
    display: none;
}

.filename {
    margin-left: 10px;
    color: #666;
}

.preview {
    margin-top: 15px;
    position: relative;
    max-width: 300px;
}

.preview img {
    width: 100%;
    height: auto;
    border-radius: 4px;
}

.remove-image {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #ff4444;
    color: white;
    border: none;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
}

.remove-image:hover {
    background: #cc0000;
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

/* Table Styles */
.product-table-container {
    margin-top: 20px;
    overflow-x: auto;
}

.product-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.product-table th,
.product-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.product-table th {
    background: #f8f9fa;
    font-weight: 600;
    color: #333;
}

.product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 4px;
}

.description-preview {
    max-width: 300px;
    padding: 10px;
    line-height: 1.5;
    color: #4a5568;
    font-size: 14px;
    overflow: hidden;
    position: relative;
}

.description-preview p {
    margin: 0;
    padding: 0;
}

.description-preview::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 24px;
    background: linear-gradient(transparent, white);
    pointer-events: none;
}

.action-cell {
    display: flex;
    gap: 8px;
}

.btn-edit,
.btn-delete {
    padding: 6px 12px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    color: white;
}

.btn-edit {
    background-color: #4299e1;
}

.btn-edit:hover {
    background-color: #3182ce;
}

.btn-delete {
    background-color: #e53e3e;
}

.btn-delete:hover {
    background-color: #c53030;
}

.btn-cancel {
    background: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    margin-left: 10px;
}

.btn-cancel:hover {
    background: #c82333;
}

/* Responsive styles */
@media (max-width: 1024px) {
    .form-container {
        grid-template-columns: 1fr;
    }
    
    .product-table th:nth-child(7),
    .product-table td:nth-child(7) {
        display: none;
    }
}

@media (max-width: 768px) {
    .product-table th:nth-child(4),
    .product-table td:nth-child(4),
    .product-table th:nth-child(6),
    .product-table td:nth-child(6) {
        display: none;
    }
    
    .action-cell {
        flex-direction: column;
    }
    
    .description-preview {
        max-width: 200px;
        font-size: 13px;
    }
    
    .btn-edit,
    .btn-delete {
        width: 100%;
        justify-content: center;
    }
}

.btn-add {
    background: linear-gradient(to right, #4CAF50, #45a049);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 6px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.btn-add i {
    font-size: 16px;
    transition: transform 0.3s ease;
}

.btn-add:hover {
    background: linear-gradient(to right, #45a049, #3d8b40);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transform: translateY(-1px);
}

.btn-add:hover i {
    transform: rotate(90deg);
}

.btn-add:active {
    transform: translateY(1px);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

/* Responsive styles for the button */
@media (max-width: 768px) {
    .btn-add {
        padding: 10px 16px;
        font-size: 13px;
    }
    
    .btn-add i {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .product-header {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .btn-add {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
function closeNotification() {
    document.getElementById('notification').style.display = 'none';
}

if (document.getElementById('notification')) {
    setTimeout(closeNotification, 3000);
}

// Toggle form visibility
function toggleForm() {
    const form = document.getElementById('addForm');
    const isHidden = form.style.display === 'none';
    form.style.display = isHidden ? 'block' : 'none';
    
    // Initialize editor when form is shown
    if (isHidden && !window.editor) {
        initEditor();
    }
}

// Toggle description expansion
function toggleDescription(button) {
    const cell = button.parentElement;
    const content = cell.querySelector('.description-content');
    
    // Thêm class loading trong khi xử lý
    content.classList.add('loading');
    
    // Sử dụng setTimeout để tạo animation mượt mà
    setTimeout(() => {
        const isExpanded = content.classList.contains('expanded');
        
        // Toggle classes
        content.classList.toggle('expanded');
        button.classList.toggle('expanded');
        
        // Cập nhật title
        button.title = isExpanded ? 'Show more' : 'Show less';
        
        // Xóa class loading
        content.classList.remove('loading');
    }, 50);
}

// Initialize CKEditor
ClassicEditor
    .create(document.querySelector('#description_editor'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
        language: 'en'
    })
    .then(editor => {
        // Store editor instance
        window.editor = editor;

        // Add form submit handler
        const form = document.querySelector('form');
        if (form) {
            form.onsubmit = function() {
                // Get the description content
                const description = editor.getData();
                
                // Update the hidden input
                document.getElementById('description_content').value = description;
                
                // Log for debugging
                console.log('Submitting description:', description);
                
                // Allow form submission
                return true;
            };
        }
    })
    .catch(error => {
        console.error('CKEditor error:', error);
    });

// Image preview handler
function handleImagePreview(e) {
    const file = e.target.files[0];
    const fileName = file ? file.name : 'No file chosen';
    document.querySelector('.filename').textContent = fileName;
    
    if (file) {
        const reader = new FileReader();
        const preview = document.getElementById('image-preview');
        const previewImg = preview.querySelector('img');
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    const input = document.getElementById('image');
    const preview = document.getElementById('image-preview');
    const filename = document.querySelector('.filename');
    
    input.value = '';
    preview.style.display = 'none';
    preview.querySelector('img').src = '';
    filename.textContent = 'No file chosen';
}

// Delete confirmation
function confirmDelete(deleteUrl) {
    if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
        window.location.href = deleteUrl;
    }
}

// Add event listeners when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', handleImagePreview);
    }
});
</script>                                                                                                                                                                                                                                                                           