<?php
if (!empty($categoryById)) {
    $cate = $categoryById;
}
?>

<div class="edit-category-container">
    <h2 class="edit-category-title">Update category</h2>
    <form class="edit-category-form" method="POST" action="<?php echo Base_URL; ?>CategoryItemController/update_category/<?php echo $cate['id_cate_item']; ?>">
        <div class="form-group">
            <label for="name_cate_item" class="form-label">Category</label>
            <input type="text" name="name_cate_item" id="name_cate_item" class="form-input" value="<?php echo $cate['name_cate_item']; ?>" required>
        </div>
        <div class="form-group">
            <label for="desc_cate_item" class="form-label">Description</label>
            <textarea name="desc_cate_item" id="desc_cate_item" class="form-input" required><?php echo $cate['desc_cate_item']; ?></textarea>
        </div>
        <button type="submit" class="btn-update">Update</button>
    </form>
</div>

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#desc_cate_item'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
        language: 'en'
    })
    .catch(error => {
        console.error(error);
    });
</script>

<style>
body {
    background: #f6f8fb;
}
.edit-category-container {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    padding: 40px 48px 32px 48px;
    margin: 40px auto;
    max-width: 900px;
}
.edit-category-title {
    text-align: center;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 32px;
    color: #222;
}
.edit-category-form {
    display: flex;
    flex-direction: column;
    gap: 32px;
}
.form-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.form-label {
    font-size: 1.15rem;
    font-weight: 500;
    color: #222;
}
.form-input {
    font-size: 1.15rem;
    padding: 18px 16px;
    border: 1.5px solid #e0e0e0;
    border-radius: 8px;
    background: #fafbfc;
    outline: none;
    transition: border 0.2s;
}
.form-input:focus {
    border: 1.5px solid #43b04a;
    background: #fff;
}
.ck-editor__editable {
    min-height: 120px;
    font-size: 1.1rem;
    background: #fafbfc;
    border-radius: 8px;
}
.btn-update {
    margin-top: 24px;
    background: #3498db;
    color: #fff;
    border: none;
    padding: 16px 0;
    border-radius: 8px;
    font-size: 1.2rem;
    font-weight: 600;
    width: 160px;
    cursor: pointer;
    transition: background 0.2s;
    display: block;
}
.btn-update:hover {
    background: #217dbb;
}
@media (max-width: 700px) {
    .edit-category-container {
        padding: 18px 6vw;
    }
    .edit-category-title {
        font-size: 1.3rem;
    }
    .btn-update {
        width: 100%;
        font-size: 1rem;
    }
}
</style>