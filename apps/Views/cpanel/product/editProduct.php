<?php
$message = null;
if (isset($_GET['msg'])) {
    $message = unserialize(urldecode($_GET['msg']));
}
?>

<div class="edit-product-container">
    <!-- Notification -->
    <div id="notification" class="notification" style="display: <?php echo isset($message['msg']) ? 'block' : 'none'; ?>">
        <?php echo isset($message['msg']) ? $message['msg'] : ''; ?>
        <span class="notification-close" onclick="closeNotification()">&times;</span>
    </div>

    <h2 class="edit-product-title">Edit Product</h2>

    <?php foreach ($productById as $key => $pro): ?>
    <form class="edit-product-form" action="<?php echo Base_URL ?>ProductController/update_product/<?php echo $pro['Id_product'] ?>" 
          method="POST" enctype="multipart/form-data">
        
        <div class="edit-form-left">
            <div class="edit-form-group">
                <label class="edit-form-label">Product Name</label>
                <input type="text" value="<?php echo trim($pro['Title_product']) ?>" 
                       name="title_product" class="edit-form-control" required>
            </div>

            <div class="edit-form-group">
                <label class="edit-form-label">Price</label>
                <input type="number" value="<?php echo trim($pro['Price_product']) ?>" 
                       name="price_product" class="edit-form-control" required>
            </div>

            <div class="edit-form-group">
                <label class="edit-form-label">Quantity</label>
                <input type="number" value="<?php echo trim($pro['Quantity_product']) ?>" 
                       name="quantity_product" class="edit-form-control" required>
            </div>

            <div class="edit-form-group">
                <label class="edit-form-label">Product Category</label>
                <select class="edit-form-select" name="category_product">
                    <?php foreach ($category as $key => $cate): ?>
                        <option value="<?php echo $cate['Id_Cate']; ?>"
                                <?php echo ($pro['Id_category_product'] == $cate['Id_Cate']) ? 'selected' : ''; ?>>
                            <?php echo $cate['Category']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="edit-form-right">
            <div class="edit-form-group">
                <label class="edit-form-label">Product Image</label>
                <input type="file" name="image" class="edit-form-control">
                <div class="edit-image-preview">
                    <img src="<?php echo Base_URL ?>public/uploads/product/<?php echo $pro['Images_product'] ?>" 
                         alt="Product Image">
                </div>
            </div>

            <div class="edit-form-group">
                <label class="edit-form-label">Description</label>
                <div id="description_editor"></div>
                <input type="hidden" name="desc_product" id="description_content" value="<?php echo htmlspecialchars($pro['Desc_product']) ?>">
            </div>
        </div>

        <div class="edit-form-actions">
            <button type="submit" class="btn-update">
                <i class="fas fa-save"></i> Update Product
            </button>
        </div>
    </form>
    <?php endforeach; ?>
</div>

<style>
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
</style>

<script>
function closeNotification() {
    document.getElementById('notification').style.display = 'none';
}

// Auto hide notification after 3 seconds
if (document.getElementById('notification')) {
    setTimeout(closeNotification, 3000);
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

        // Set initial content from the hidden input
        const initialContent = document.getElementById('description_content').value;
        editor.setData(initialContent);

        // Add form submit handler
        const form = document.querySelector('.edit-product-form');
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
</script>