<section class="blog-detail-dark">
    <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/detailNews.css" />
    <div class="blog-detail-wrapper">
        <!-- Main Content -->
        <div class="blog-main-content animated fadeInUp">
            <!-- Featured Image -->
            <div class="blog-featured-img">
                <img src="<?php echo Base_URL ?>public/uploads/post/<?php echo $post['Image_post'] ?>"
                    alt="<?php echo $post['Title_post'] ?>">
            </div>
            <!-- Meta -->
            <div class="blog-meta-dark">
                <span class="meta-category"><i class="fas fa-folder"></i>
                    <?php echo $post['Title_category_post'] ?? 'Uncategorized'; ?>
                    <?php if (!empty($post['Date_post'])): ?>
                    <span style="color:#bfa76a; font-size:0.98em; margin-left:10px;">
                        <?php 
                                $dt = new DateTime($post['Date_post']);
                                echo $dt->format('H:i d/m/Y');
                            ?>
                    </span>
                    <?php endif; ?>
                </span>

            </div>
            <!-- Title -->
            <h1 class="blog-title-dark"><?php echo $post['Title_post'] ?></h1>
            <!-- Content -->
            <div class="blog-content-dark">
                <?php echo $post['Content_post'] ?>
            </div>
            <!-- Quote Box (Sample) -->
            <div class="blog-quote-box animated fadeInUp">
                <span class="quote-icon">&#10077;</span>
                <div class="quote-text">“Cà phê không chỉ là thức uống, mà là một phần của cuộc sống, nơi ta tìm thấy
                    những khoảnh khắc bình yên giữa nhịp sống hối hả.”</div>
                <div class="quote-author">Nguyễn Nhật Ánh<span>- Nhà văn</span></div>
            </div>
        </div>
        <!-- Sidebar -->
        <aside class="blog-sidebar-dark animated fadeInRight">
            <!-- Author Card -->

            <!-- Categories (Dynamic) -->
            <div class="sidebar-card sidebar-categories">
                <div class="sidebar-title">DANH MỤC BÀI VIẾT</div>
                <ul>
                    <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                    <li>
                        <a
                            href="<?php echo Base_URL; ?>NewsController/category/<?php echo $cat['Id_category_post']; ?>">
                            <?php echo $cat['Title_category_post']; ?>
                        </a>
                        <span>(<?php echo $cat['post_count'] ?? 0; ?>)</span>
                    </li>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <li>No categories</li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- Recent Posts (Dynamic) -->
            <div class="sidebar-card sidebar-recent">
                <div class="sidebar-title">BÀI VIẾT GẦN ĐÂY</div>
                <ul>
                    <?php if (!empty($recentPosts)): ?>
                    <?php foreach ($recentPosts as $recent): ?>
                    <li>
                        <img src="<?php echo Base_URL ?>public/uploads/post/<?php echo $recent['Image_post'] ?>" alt="">
                        <div>
                            <a class="recent-title"
                                href="<?php echo Base_URL; ?>NewsController/detailPost/<?php echo $recent['Id_post']; ?>">
                                <?php echo $recent['Title_post']; ?>
                            </a>
                            <div style="color:#fff; font-size:0.95em; margin-top:2px;">
                                <?php
                                    $words = preg_split('/\s+/', strip_tags($recent['Content_post']));
                                    $preview = implode(' ', array_slice($words, 0, 10));
                                    echo $preview . '...';
                                ?>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <li>No recent posts</li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- Tags -->
            <div class="sidebar-card sidebar-tags">
                <div class="sidebar-title">TAGS</div>
                <div class="tags-list">
                    <span>Coffee</span><span>Shop</span><span>Arabica</span><span>Life</span><span>Tips</span><span>Filter</span>
                </div>
            </div>
        </aside>
    </div>
</section>

<style>
.blog-detail-dark {
    background: #0a0a0a;
    color: #e2e2e2;
    min-height: 100vh;
    padding: 40px 0;
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
}

.blog-detail-wrapper {
    display: flex;
    max-width: 1300px;
    margin: 0 auto;
    gap: 40px;
    padding: 0 20px;
}

.blog-main-content {
    flex: 2;
    background: rgba(20, 20, 20, 0.8);
    border-radius: 8px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
    padding: 40px;
    margin-bottom: 40px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.blog-featured-img img {
    width: 100%;
    border-radius: 8px;
    margin-bottom: 30px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
}

.blog-featured-img img:hover {
    transform: scale(1.02);
}

.blog-meta-dark {
    display: flex;
    gap: 20px;
    font-size: 14px;
    color: #bfa76a;
    margin-bottom: 18px;
    align-items: center;
}

.blog-meta-dark i {
    margin-right: 6px;
    opacity: 0.8;
}

.blog-title-dark {
    font-size: 2.2rem;
    color: #ffe082;
    margin-bottom: 30px;
    font-weight: 600;
    letter-spacing: 1px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.blog-content-dark {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #e2e2e2;
    margin-bottom: 40px;
}

.blog-content-dark p {
    margin-bottom: 1.5rem;
}

.blog-quote-box {
    background: rgba(20, 20, 20, 0.6);
    border-left: 4px solid #bfa76a;
    margin: 40px 0;
    padding: 30px;
    border-radius: 8px;
    color: #ffe082;
    font-size: 1.2rem;
    position: relative;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(5px);
}

.blog-quote-box .quote-icon {
    font-size: 2.5rem;
    position: absolute;
    left: 10px;
    top: 10px;
    color: #bfa76a;
    opacity: 0.3;
}

.blog-quote-box .quote-text {
    margin-left: 30px;
    font-style: italic;
    margin-bottom: 10px;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

.blog-quote-box .quote-author {
    margin-left: 30px;
    font-size: 1rem;
    color: #bfa76a;
    font-weight: 500;
}

.blog-quote-box .quote-author span {
    color: #888;
    font-weight: 400;
}

.blog-sidebar-dark {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.sidebar-card {
    background: rgba(20, 20, 20, 0.8);
    border-radius: 8px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
    padding: 30px;
    margin-bottom: 10px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.sidebar-author {
    text-align: center;
}

.author-avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 18px;
    border: 2px solid #bfa76a;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.author-name {
    color: #ffe082;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 8px;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

.author-desc {
    font-size: 0.95rem;
    color: #bdbdbd;
    margin-bottom: 14px;
    line-height: 1.6;
}

.author-social a {
    color: #bfa76a;
    margin: 0 8px;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.author-social a:hover {
    color: #ffe082;
    transform: translateY(-2px);
}

.sidebar-search form {
    display: flex;
    background: rgba(20, 20, 20, 0.6);
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.sidebar-search input {
    flex: 1;
    padding: 12px 15px;
    border: none;
    background: transparent;
    color: #ffe082;
    font-size: 1rem;
}

.sidebar-search button {
    background: #bfa76a;
    border: none;
    color: #0a0a0a;
    padding: 0 20px;
    cursor: pointer;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.sidebar-search button:hover {
    background: #ffe082;
}

.sidebar-title {
    color: #ffe082;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 20px;
    letter-spacing: 1px;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

.sidebar-categories ul,
.sidebar-recent ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-categories li {
    color: #bfa76a;
    font-size: 1rem;
    margin-bottom: 12px;
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    padding-bottom: 8px;
    transition: all 0.3s ease;
}

.sidebar-categories li:hover {
    color: #ffe082;
    transform: translateX(5px);
}

.sidebar-categories li a {
    color: inherit;
    text-decoration: none;
}

.sidebar-categories li span {
    color: #ffe082;
    font-size: 0.95rem;
    opacity: 0.8;
}

.sidebar-recent li {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
    transition: all 0.3s ease;
}

.sidebar-recent li:hover {
    transform: translateX(5px);
}

.sidebar-recent img {
    width: 48px;
    height: 48px;
    border-radius: 6px;
    object-fit: cover;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.recent-title {
    color: #ffe082;
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s ease;
}

.recent-title:hover {
    color: #bfa76a;
}

.sidebar-tags .tags-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.sidebar-tags span {
    background: rgba(20, 20, 20, 0.6);
    color: #bfa76a;
    border-radius: 4px;
    padding: 6px 12px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    cursor: pointer;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.sidebar-tags span:hover {
    background: #bfa76a;
    color: #0a0a0a;
    transform: translateY(-2px);
}

@media (max-width: 1024px) {
    .blog-detail-wrapper {
        flex-direction: column;
        gap: 0;
    }

    .blog-main-content,
    .blog-sidebar-dark {
        margin-bottom: 30px;
    }
}

/* Animation Keyframes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-40px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(40px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animated {
    opacity: 0;
    transition: opacity 0.5s, transform 0.5s;
}

.animated.visible {
    opacity: 1;
}

.fadeInUp {
    animation: fadeInUp 0.8s cubic-bezier(.23, 1.01, .32, 1) forwards;
}

.fadeInLeft {
    animation: fadeInLeft 0.8s cubic-bezier(.23, 1.01, .32, 1) forwards;
}

.fadeInRight {
    animation: fadeInRight 0.8s cubic-bezier(.23, 1.01, .32, 1) forwards;
}

/* Hover Effects */
.blog-main-content,
.sidebar-card,
.blog-quote-box {
    transition: box-shadow 0.3s, transform 0.3s;
}

.blog-main-content:hover,
.sidebar-card:hover,
.blog-quote-box:hover {
    box-shadow: 0 8px 32px rgba(191, 167, 106, 0.15);
    transform: translateY(-4px);
}

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(20, 20, 20, 0.8);
}

::-webkit-scrollbar-thumb {
    background: #bfa76a;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #ffe082;
}
</style>

<script>
// Add smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Add lazy loading for images
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.setAttribute('loading', 'lazy');
    });
});

// Animation on scroll
function revealOnScroll() {
    var reveals = document.querySelectorAll('.animated');
    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 80;
        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add('visible');
        }
    }
}
window.addEventListener('scroll', revealOnScroll);
window.addEventListener('DOMContentLoaded', revealOnScroll);

// Sticky sidebar shadow
window.addEventListener('scroll', function() {
    var sidebar = document.querySelector('.blog-sidebar-dark');
    if (!sidebar) return;
    if (window.scrollY > 60) {
        sidebar.classList.add('scrolled');
    } else {
        sidebar.classList.remove('scrolled');
    }
});
</script>