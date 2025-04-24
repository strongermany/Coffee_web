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
                    <h3 class="card-title">Slider List</h3>
                    <div class="card-tools">
                        <a href="<?php echo Base_URL; ?>SliderController/add" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['sliders'])): ?>
                                <?php foreach ($data['sliders'] as $slider): ?>
                                    <tr>
                                        <td><?php echo $slider['id']; ?></td>
                                        <td><?php echo $slider['title']; ?></td>
                                        <td>
                                            <img src="<?php echo Base_URL; ?>public/uploads/slider/<?php echo $slider['image']; ?>" 
                                                 alt="<?php echo $slider['title']; ?>" 
                                                 style="max-width: 100px; max-height: 100px;">
                                        </td>
                                        <td>
                                            <?php if ($slider['status'] == 1): ?>
                                                <a href="<?php echo Base_URL; ?>SliderController/status/<?php echo $slider['id']; ?>" 
                                                   class="btn btn-success btn-sm">Active</a>
                                            <?php else: ?>
                                                <a href="<?php echo Base_URL; ?>SliderController/status/<?php echo $slider['id']; ?>" 
                                                   class="btn btn-danger btn-sm">Inactive</a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo Base_URL; ?>SliderController/edit/<?php echo $slider['id']; ?>" 
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?php echo Base_URL; ?>SliderController/delete/<?php echo $slider['id']; ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Are you sure you want to delete this slider?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No sliders found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 