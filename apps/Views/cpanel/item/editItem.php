<?php
$message = null;
if (isset($_GET['msg'])) {
    $message = unserialize(urldecode($_GET['msg']));
}
?>

<div class="edit-item-container">
    <div id="notification" class="notification" style="display: <?php echo isset($message['msg']) ? 'block' : 'none'; ?>;">
        <?php echo isset($message['msg']) ? $message['msg'] : ''; ?>
        <span class="notification-close" onclick="closeNotification()">&times;</span>
    </div>

    <h2 class="edit-item-title">Edit Item</h2>

    <?php if ($itemById): ?>
        <?php $it = $itemById; ?>
        <form class="edit-item-form" action="<?php echo Base_URL ?>ItemController/update_item/<?php echo $it['id_item'] ?>" 
              method="POST" enctype="multipart/form-data">
            
            <div class="edit-form-left">
                <div class="edit-form-group">
                    <label class="edit-form-label">Item Name</label>
                    <input type="text" value="<?php echo trim($it['title_item']) ?>" 
                           name="title_item" class="edit-form-control" required>
                </div>

                <div class="edit-form-group">
                    <label class="edit-form-label">Price</label>
                    <input type="number" value="<?php echo trim($it['price_item']) ?>" 
                           name="price_item" class="edit-form-control" required>
                </div>

                <div class="edit-form-group">
                    <label class="edit-form-label">Quantity</label>
                    <input type="number" value="<?php echo trim($it['quantity_item']) ?>" 
                           name="quantity_item" class="edit-form-control" required>
                </div>

                <div class="edit-form-group">
                    <label class="edit-form-label">Item Category</label>
                    <select class="edit-form-select" name="id_category_item">
                        <?php foreach ($category as $cate): ?>
                            <option value="<?php echo $cate['id_cate_item']; ?>"
                                    <?php echo ($it['id_category_item'] == $cate['id_cate_item']) ? 'selected' : ''; ?>>
                                <?php echo $cate['name_cate_item']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="edit-form-right">
                <div class="edit-form-group">
                    <label class="edit-form-label">Item Image</label>
                    <input type="file" name="images_item" class="edit-form-control">
                    <div class="edit-image-preview">
                        <img src="<?php echo Base_URL ?>public/uploads/items/<?php echo $it['images_item'] ?>" 
                             alt="Item Image">
                    </div>
                </div>

                <div class="edit-form-group">
                    <label class="edit-form-label">Description</label>
                    <div id="description_editor"></div>
                    <input type="hidden" name="desc_item" id="description_content" value="<?php echo htmlspecialchars($it['desc_item']) ?>">
                </div>
            </div>

            <div class="edit-form-actions">
                <button type="submit" class="btn-update">
                    <i class="fas fa-save"></i> Update Item
                </button>
            </div>
        </form>
    <?php endif; ?>
</div>
<!-- Copy style & script từ editProduct.php và đổi selector cho phù hợp --> 