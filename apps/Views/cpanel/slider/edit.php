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
                    <h3 class="card-title">Edit Slider</h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo Base_URL; ?>slider/update/<?php echo $data['sliderbyid'][0]['id']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="<?php echo $data['sliderbyid'][0]['title']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Current Image</label><br>
                            <img src="<?php echo Base_URL; ?>public/uploads/slider/<?php echo $data['sliderbyid'][0]['image']; ?>" 
                                 alt="<?php echo $data['sliderbyid'][0]['title']; ?>" 
                                 style="max-width: 300px; max-height: 200px;">
                        </div>
                        <div class="form-group">
                            <label for="image">New Image (Leave empty to keep current image)</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            <small class="form-text text-muted">Recommended size: 1920x800 pixels</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Slider</button>
                            <a href="<?php echo Base_URL; ?>slider" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 