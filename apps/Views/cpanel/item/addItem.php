<?php
$message = null;
if (isset($_GET['msg'])) {
    $message = unserialize(urldecode($_GET['msg']));
}
?>

<div class="item-container">
    <!-- Notification -->
    <div id="notification" class="notification success" style="display: <?php echo isset($message['msg']) ? 'block' : 'none'; ?>;">
        <span id="notification-message"><?php echo isset($message['msg']) ? $message['msg'] : ''; ?></span>
        <button onclick="closeNotification()" class="notification-close">&times;</button>
    </div>

    <!-- Header Section -->
    <div class="item-header">
        <h2 class="item-title">Item Management</h2>
        <a href="#" class="btn-add" onclick="openAddModal();return false;">
            <i class="fas fa-plus"></i> ADD NEW ITEM
        </a>
    </div>

    <!-- Add Form Modal -->
    <div id="addModal" class="modal-bg">
        <div class="modal-content">
            <form class="item-form" method="POST" action="<?php echo Base_URL ?>ItemController/insert_item" enctype="multipart/form-data">
                <h3 style="margin-bottom:18px;">Add New Item</h3>
                <input type="text" name="title_item" class="form-control" placeholder="Item Name" required>
                <input type="number" name="price_item" class="form-control" placeholder="Price" required>
                <input type="number" name="quantity_item" class="form-control" placeholder="Quantity" required>
                <select class="form-control" name="id_category_item" required>
                    <option value="">-- Select Category --</option>
                    <?php foreach($category as $cate): ?>
                        <option value="<?php echo $cate['id_cate_item']?>"><?php echo $cate['name_cate_item']?></option>
                    <?php endforeach; ?>
                </select>
                <input type="file" name="images_item" class="form-control" accept="image/*" required>
                <textarea name="desc_item" id="desc_item" class="form-control" placeholder="Description"></textarea>
                <div style="display:flex; gap:10px; margin-top:18px;">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Item List Section -->
    <div class="item-table-wrapper">
        <table class="item-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th style="width:160px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($item)): foreach ($item as $i => $it): ?>
                <tr>
                    <td><?php echo $it['id_item']; ?></td>
                    <td><?php echo $it['title_item']; ?></td>
                    <td>
                        <?php if (!empty($it['images_item'])): ?>
                            <img src="<?php echo Base_URL?>public/uploads/items/<?php echo $it['images_item'] ?>" alt="Item Image" class="item-image">
                        <?php endif; ?>
                    </td>
                    <td><?php echo $it['name_cate_item']; ?></td>
                    <td><?php echo number_format($it['price_item'],0,',','.'); ?></td>
                    <td><?php echo $it['quantity_item']; ?></td>
                    <td class="description-preview">
                        <?php 
                            $desc = !empty($it['desc_item']) ? $it['desc_item'] : '';
                            $desc = strip_tags($desc, '<br><p>');
                            echo substr($desc, 0, 200) . (strlen($desc) > 200 ? '...' : '');
                        ?>
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="<?php echo Base_URL ?>ItemController/edit_item/<?php echo $it['id_item'] ?>" class="btn btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?php echo Base_URL ?>ItemController/delete_item/<?php echo $it['id_item'] ?>" class="btn btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
function openAddModal() {
    document.getElementById('addModal').classList.add('active');
    setTimeout(function() {
        if (!window.itemEditor) {
            ClassicEditor.create(document.querySelector('#desc_item'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
                language: 'en'
            }).then(editor => {
                window.itemEditor = editor;
            });
        }
    }, 100);
}
function closeAddModal() {
    document.getElementById('addModal').classList.remove('active');
}
window.onclick = function(event) {
    var modal = document.getElementById('addModal');
    if (event.target === modal) {
        closeAddModal();
    }
}
function closeNotification() {
    document.getElementById('notification').style.display = 'none';
}
if (document.getElementById('notification')) {
    setTimeout(closeNotification, 3000);
}
</script>

<style>
body {
    background: #f6f8fb;
}
.item-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    padding: 32px 40px;
    margin: 32px auto;
    max-width: 1200px;
}
.item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}
.item-title {
    font-size: 2rem;
    font-weight: 700;
    color: #222;
    margin: 0;
}
.btn-add {
    background: #43b04a;
    color: #fff;
    padding: 12px 24px;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 500;
    border: none;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s;
}
.btn-add:hover {
    background: #388e3c;
}
.item-form .form-control {
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
    width: 100%;
    margin-bottom: 12px;
}
.btn {
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 1rem;
    border: none;
    cursor: pointer;
    margin-left: 0;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    text-decoration: none;
}
.btn-success {
    background: #43b04a;
    color: #fff;
}
.btn-success:hover {
    background: #388e3c;
}
.btn-secondary {
    background: #aaa;
    color: #fff;
}
.btn-edit {
    background: #3498db;
    color: #fff;
    margin-right: 6px;
}
.btn-edit:hover {
    background: #217dbb;
}
.btn-delete {
    background: #e74c3c;
    color: #fff;
}
.btn-delete:hover {
    background: #c0392b;
}
.item-table-wrapper {
    background: #f9fafb;
    border-radius: 8px;
    padding: 18px;
    margin-top: 12px;
}
.item-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
}
.item-table th, .item-table td {
    padding: 14px 12px;
    border-bottom: 1px solid #eee;
    text-align: left;
    vertical-align: middle;
}
.item-table th {
    background: #f6f8fb;
    font-weight: 600;
    color: #222;
}
.item-table tr:last-child td {
    border-bottom: none;
}
.item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    background: #f6f8fb;
    border: 1px solid #eee;
}
.description-preview {
    max-width: 320px;
    font-size: 15px;
    color: #444;
    line-height: 1.5;
    overflow: hidden;
}
.action-group {
    display: flex;
    gap: 8px;
    flex-wrap: nowrap;
    align-items: center;
}
.modal-bg {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0; top: 0; right: 0; bottom: 0;
    width: 100vw; height: 100vh;
    background: rgba(0,0,0,0.3);
    justify-content: center;
    align-items: center;
}
.modal-bg.active {
    display: flex;
}
.modal-content {
    background: #fff;
    border-radius: 10px;
    padding: 32px 32px 24px 32px;
    min-width: 350px;
    max-width: 95vw;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
    animation: fadeIn .2s;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-30px);}
    to { opacity: 1; transform: translateY(0);}
}
.notification.success {
    background-color: #43b04a;
    color: #fff;
    padding: 16px 24px;
    border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    position: fixed;
    top: 32px;
    right: 32px;
    z-index: 9999;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.1rem;
    min-width: 280px;
    animation: fadeIn 0.3s;
}
.notification-close {
    background: none;
    border: none;
    color: #fff;
    font-size: 1.2rem;
    cursor: pointer;
    margin-left: 8px;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px);}
    to { opacity: 1; transform: translateY(0);}
}
</style> 