<section id="blog">
    <link rel="stylesheet" href="<?php echo Base_URL ?>/public/css/mainNews.css" />
    <div class="blog-heading">
        <strong>BÀI VIẾT MỚI NHẤT</strong>
        <h3>Khám phá những câu chuyện đầy cảm hứng – Nơi mà mỗi trang viết đều mang một thông điệp riêng biệt</h3>
    </div>

    <div class="blog-box-container">
        <?php
        if (!empty($posts)) {
            foreach ($posts as $post) {
        ?>
        <div class="blog-box">
            <div class="blog-box-img">
                <img src="<?php echo Base_URL ?>public/uploads/post/<?php echo $post['Image_post'] ?>"
                    alt="<?php echo $post['Title_post'] ?>" />
                <a href="<?php echo Base_URL ?>NewsController/detailPost/<?php echo $post['Id_post'] ?>"
                    class="blog-img-link">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </div>

            <div class="blog-box-text">
                <strong><?php echo $post['Name_category_post'] ?? 'Blog Post' ?></strong>
                <a
                    href="<?php echo Base_URL ?>NewsController/detailPost/<?php echo $post['Id_post'] ?>"><?php echo $post['Title_post'] ?></a>
                <p><?php echo substr(strip_tags($post['Content_post']), 0, 150) . '...' ?></p>
            </div>
        </div>
        <?php
            }
        } else {
            echo '<div class="no-posts">No blog posts found</div>';
        }
        ?>
    </div>
</section>