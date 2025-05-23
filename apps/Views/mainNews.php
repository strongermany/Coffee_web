<?php
// Remove direct model loading since categories are passed from controller
?>
<section id="main-news-dark">
    <link rel="stylesheet" href="<?php echo Base_URL ?>/public/css/mainNews.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <div class="main-news-hero reveal-on-scroll">
        <div class="main-news-hero-content">
            <h1><span class="main-news-hero-white">NIỀM</span> <span class="main-news-hero-gold">VUI</span><br><span
                    class="main-news-hero-white">MỖI NGÀY.</span></h1>
        </div>
        <div class="main-news-hero-img">
            <img src="<?php echo Base_URL ?>public/images/login.png" alt="Coffee Cup" />
        </div>
    </div>
    <div class="main-news-feature-list">
        <div class="main-news-feature reveal-on-scroll">
            <i class="fas fa-mug-hot"></i>
            <div>
                <div class="feature-title">CÁC LOẠI CÀ PHÊ</div>
                <div class="feature-desc">Khám phá thế giới cà phê đa dạng với nhiều hương vị độc đáo, từ cà phê truyền
                    thống đến những phong cách hiện đại.</div>
            </div>
        </div>
        <div class="main-news-feature reveal-on-scroll">
            <i class="fas fa-seedling"></i>
            <div>
                <div class="feature-title">GIỐNG CÀ PHÊ</div>
                <div class="feature-desc">Tìm hiểu về các loại hạt cà phê chất lượng cao, được chọn lọc kỹ lưỡng từ
                    những vùng trồng nổi tiếng trên thế giới.</div>
            </div>
        </div>
        <div class="main-news-feature reveal-on-scroll">
            <i class="fas fa-cookie"></i>
            <div>
                <div class="feature-title">CÀ PHÊ & BÁNH</div>
                <div class="feature-desc">Thưởng thức những món bánh ngọt thơm ngon, được làm mới mỗi ngày để kết hợp
                    hoàn hảo với tách cà phê của bạn.</div>
            </div>
        </div>
        <div class="main-news-feature reveal-on-scroll">
            <i class="fas fa-coffee"></i>
            <div>
                <div class="feature-title">CÀ PHÊ MANG ĐI</div>
                <div class="feature-desc">Dịch vụ cà phê mang đi tiện lợi, giúp bạn thưởng thức hương vị cà phê thơm
                    ngon mọi lúc, mọi nơi.</div>
            </div>
        </div>
    </div>
    <div class="main-news-list-title reveal-on-scroll">TIN TỨC MỚI NHẤT</div>
    <div class="main-news-list-container">
        <?php
        if (!empty($posts)) {
            foreach ($posts as $post) {
                // Lấy tên danh mục cho bài viết
                $categoryName = 'Bài Viết';
                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        if ($category['Id_category_post'] == $post['Id_category_post']) {
                            $categoryName = $category['Title_category_post'];
                            break;
                        }
                    }
                }
        ?>
        <div class="main-news-card reveal-on-scroll">
            <div class="main-news-card-img">
                <img src="<?php echo Base_URL ?>public/uploads/post/<?php echo $post['Image_post'] ?>"
                    alt="<?php echo $post['Title_post'] ?>" />
            </div>
            <div class="main-news-card-content">
                <div class="main-news-card-category">
                    <i class="fas fa-folder"></i> <?php echo $categoryName ?>
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
            echo '<div class="no-posts reveal-on-scroll">Không tìm thấy bài viết nào</div>';
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