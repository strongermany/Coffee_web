<?php
if (!empty($_GET['msg'])) {
    $msg = unserialize(urldecode($_GET['msg']));
    foreach ($msg as $key => $value) {
        echo '<span style= "color: blue;
                            font-weight: bold">' . $value . '</span>';
    }
}
?>

<h3 style="text-align: center;">Update category</h3>

<div class="col-md-6">
    <?php
    foreach ($categoryById as $key => $cate) {

    ?>

        <form autocomplete="off" action="<?php echo Base_URL ?>ProductController/update_category/<?php echo $cate['Id_Cate'] ?>" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Category</label>
                <input type="text"  value="<?php echo $cate['Category'] ?>"  name="Category" class="form-control" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="Description" id="description" class="form-control" required><?php echo $cate['Descript_Cate'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    <?php
    }
    ?>


</div>

<script>
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
            language: 'en'
        })
        .catch(error => {
            console.error(error);
        });

    // Existing JavaScript code
</script>