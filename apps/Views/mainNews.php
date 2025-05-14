<section id="main-news-dark">
    <link rel="stylesheet" href="<?php echo Base_URL ?>/public/css/mainNews.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <div class="main-news-hero reveal-on-scroll">
        <div class="main-news-hero-content">
            <h1><span class="main-news-hero-white">YOUR</span> <span class="main-news-hero-gold">DAILY</span><br><span
                    class="main-news-hero-white">HAPPINESS.</span></h1>
        </div>
        <div class="main-news-hero-img">
            <img src="<?php echo Base_URL ?>public/images/banner.png" alt="Coffee Cup" />
        </div>
    </div>
    <div class="main-news-feature-list">
        <div class="main-news-feature reveal-on-scroll">
            <i class="fas fa-mug-hot"></i>
            <div>
                <div class="feature-title">TYPES OF COFFEE</div>
                <div class="feature-desc">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                    aliquip ex ea commodo aute.</div>
            </div>
        </div>
        <div class="main-news-feature reveal-on-scroll">
            <i class="fas fa-seedling"></i>
            <div>
                <div class="feature-title">BEAN VARIETIES</div>
                <div class="feature-desc">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                    aliquip ex ea commodo aute.</div>
            </div>
        </div>
        <div class="main-news-feature reveal-on-scroll">
            <i class="fas fa-cookie"></i>
            <div>
                <div class="feature-title">COFFEE & PASTRY</div>
                <div class="feature-desc">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                    aliquip ex ea commodo aute.</div>
            </div>
        </div>
        <div class="main-news-feature reveal-on-scroll">
            <i class="fas fa-coffee"></i>
            <div>
                <div class="feature-title">COFFEE TO GO</div>
                <div class="feature-desc">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                    aliquip ex ea commodo aute.</div>
            </div>
        </div>
    </div>
    <div class="main-news-list-title reveal-on-scroll">LATEST STORIES</div>
    <div class="main-news-list-container">
        <?php
        if (!empty($posts)) {
            foreach ($posts as $post) {
        ?>
        <div class="main-news-card reveal-on-scroll">
            <div class="main-news-card-img">
                <img src="<?php echo Base_URL ?>public/uploads/post/<?php echo $post['Image_post'] ?>"
                    alt="<?php echo $post['Title_post'] ?>" />
            </div>
            <div class="main-news-card-content">
                <div class="main-news-card-category">
                    <i class="fas fa-folder"></i> <?php echo $post['Name_category_post'] ?? 'Blog Post' ?>
                </div>
                <a class="main-news-card-title"
                    href="<?php echo Base_URL ?>NewsController/detailPost/<?php echo $post['Id_post'] ?>"><?php echo $post['Title_post'] ?></a>
                <div class="main-news-card-desc"><?php echo substr(strip_tags($post['Content_post']), 0, 120) . '...' ?>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo '<div class="no-posts reveal-on-scroll">No blog posts found</div>';
        }
        ?>
    </div>
</section>

<script>
// Hiệu ứng xuất hiện cho mọi thành phần có class reveal-on-scroll
function revealOnScroll() {
    var reveals = document.querySelectorAll('.reveal-on-scroll');
    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementBottom = reveals[i].getBoundingClientRect().bottom;
        var elementVisible = 80;
        // Nếu phần tử trong viewport thì thêm visible, nếu ra khỏi thì bỏ visible
        if (elementTop < windowHeight - elementVisible && elementBottom > elementVisible) {
            reveals[i].classList.add('visible');
        } else {
            reveals[i].classList.remove('visible');
        }
    }
}
window.addEventListener('scroll', revealOnScroll);
window.addEventListener('DOMContentLoaded', revealOnScroll);
</script>