<?php
$message = null;
if (isset($_GET['msg'])) {
    $message = unserialize(urldecode($_GET['msg']));
}
?>

<div class="category-container">
    <div class="category-header">
        <h2 class="category-title">Item Category Management</h2>
        <a href="#" class="btn-add" onclick="openAddModal();return false;">
            <i class="fas fa-plus"></i> Add New Category
        </a>
    </div>

    <!-- Add Form Modal -->
    <div id="addModal" class="modal-bg">
        <div class="modal-content">
            <form class="category-form" method="POST" action="<?php echo Base_URL; ?>CategoryItemController/insert_category">
                <h3 style="margin-bottom:18px;">Add New Category</h3>
                <input type="text" name="name_cate_item" class="form-control" placeholder="Category Name" required>
                <input type="text" name="desc_cate_item" class="form-control" placeholder="Description" required>
                <div style="display:flex; gap:10px; margin-top:18px;">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="category-table-wrapper">
        <table class="category-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th style="width:160px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($category)): foreach ($category as $i => $cate): ?>
                <tr>
                    <td><?php echo $cate['id_cate_item']; ?></td>
                    <td><?php echo $cate['name_cate_item']; ?></td>
                    <td><?php echo $cate['desc_cate_item']; ?></td>
                    <td>
                        <div class="action-group">
                            <a href="<?php echo Base_URL; ?>CategoryItemController/edit_category/<?php echo $cate['id_cate_item']; ?>" class="btn btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?php echo Base_URL; ?>CategoryItemController/delete_category/<?php echo $cate['id_cate_item']; ?>" class="btn btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
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

<style>
body {
    background: #f6f8fb;
}
.category-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    padding: 32px 40px;
    margin: 32px auto;
    max-width: 900px;
}
.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}
.category-title {
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
.category-form .form-control {
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
.category-table-wrapper {
    background: #f9fafb;
    border-radius: 8px;
    padding: 18px;
    margin-top: 12px;
}
.category-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
}
.category-table th, .category-table td {
    padding: 14px 12px;
    border-bottom: 1px solid #eee;
    text-align: left;
}
.category-table th {
    background: #f6f8fb;
    font-weight: 600;
    color: #222;
}
.category-table tr:last-child td {
    border-bottom: none;
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
</style>
<script>
function openAddModal() {
    document.getElementById('addModal').classList.add('active');
}
function closeAddModal() {
    document.getElementById('addModal').classList.remove('active');
}
// Đóng modal khi click ra ngoài
window.onclick = function(event) {
    var modal = document.getElementById('addModal');
    if (event.target === modal) {
        closeAddModal();
    }
}
</script> 