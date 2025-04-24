<?php
if (isset($_GET['msg'])) {
    $message = unserialize(urldecode($_GET['msg']));
    echo "<script>alert('".$message['msg']."')</script>";
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Slider</h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo Base_URL; ?>SliderController/insert" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                            <small class="form-text text-muted">Allowed formats: JPG, JPEG, PNG, GIF</small>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Add Slider</button>
                            <a href="<?php echo Base_URL; ?>SliderController" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('image');
    const file = fileInput.files[0];
    
    if (file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            e.preventDefault();
            alert('Please select a valid image file (JPG, JPEG, PNG, GIF)');
            return false;
        }
    }
});
</script> 