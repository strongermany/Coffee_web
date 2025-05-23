<body>
    <div class="home-main-bg">

        <!-- Sản phẩm nổi bật -->
        <section class="section-products">
            <h2 class="section-title">GIAN HÀNG SẢN PHẨM VỀ CAFE</h2>
            <hr class="section-divider" />
            <div class="product-grid">
                <?php if (!empty($products)): ?>
                <?php 
          $count = 0;
          foreach ($products as $product):
            if ($count >= 6) break;
          ?>
                <div class="product-card" data-product-id="<?php echo $product['Id_product']; ?>">
                    <span class="best-seller-badge">Best Seller</span>
                    <img src="<?php echo Base_URL . 'public/uploads/product/' . $product['Images_product']; ?>"
                        alt="<?php echo $product['Title_product']; ?>">
                    <h3><?php echo $product['Title_product']; ?></h3>
                    <div class="price"><?php echo number_format($product['Price_product'], 0, ',', '.'); ?>đ</div>
                    <div class="product-hover-card">
                        <div class="card-content">
                            <div class="qty-group">
                                <button class="qty-btn minus">-</button>
                                <input type="number" class="qty-input" min="1" value="1">
                                <button class="qty-btn plus">+</button>
                            </div>
                            <div class="card-actions">
                                <button class="buy-now-btn">Đặt hàng</button>
                                <button class="add-to-cart-btn"><i class="fas fa-cart-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            $count++;
          endforeach;
          ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- Timeline Section Title -->

        <!-- End Timeline Section Title -->
        <div class="timeline-section" style="background: transparent; text-align: left; padding-left: 0;">
            <div class="history-title" style="justify-content: flex-start; margin-bottom: 10px; margin-left: 30px;">
                <span class="why-choose-diamond"></span>
                <span class="why-choose-text history-words" style="font-size: 1.3rem;">
                    <span>Câu</span> <span>Chuyện</span>
                </span>
                <span class="why-choose-diamond"></span>
            </div>
            <div class="timeline-title"
                style="font-family: 'Cinzel', serif; font-size: 3.2rem; margin-bottom: 30px; margin-left: 30px; text-align: left;">
                CÂU CHUYỆN CỦA CHÚNG TÔI</div>
        </div>
        <!-- Timeline Row Section -->
        <div class="timeline-row">

            <div class="timeline-line"></div>
            <!-- 2000: dưới đường kẻ -->
            <div class="timeline-col bottom">
                <div class="timeline-dot"></div>
                <div class="timeline-img">
                    <img src="https://images.unsplash.com/photo-1629814558612-6e6a38b79f98?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fGNhZmUlMjBzaG9wfGVufDB8fDB8fHww"
                        alt="">
                </div>
                <div class="timeline-content">
                    <div class="timeline-year">2000</div>
                    <div class="timeline-heading">KHỞI ĐẦU</div>
                    <div class="timeline-desc">Trong thời đại hiện đại ngày nay, quán cafe không chỉ đơn thuần là nơi
                        phục vụ đồ uống mà còn là không gian đa dạng cho mọi người.</div>
                </div>
            </div>
            <!-- 2005: trên đường kẻ -->
            <div class="timeline-col top">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="timeline-year">2005</div>
                    <div class="timeline-heading">PHÁT TRIỂN</div>
                    <div class="timeline-desc">Bước tiếp theo, chúng tôi đã mở rộng quy mô và nâng cao chất lượng phục
                        vụ.</div>
                </div>
                <div class="timeline-img">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80"
                        alt="">
                </div>
            </div>
            <!-- 2016: dưới đường kẻ -->
            <div class="timeline-col bottom">
                <div class="timeline-dot"></div>
                <div class="timeline-img">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=400&q=80"
                        alt="">
                </div>
                <div class="timeline-content">
                    <div class="timeline-year">2016</div>
                    <div class="timeline-heading">NỔI TIẾNG</div>
                    <div class="timeline-desc">Ngày nay, chúng tôi tự hào là một trong những quán cafe được yêu thích
                        nhất trong khu vực.</div>
                </div>
            </div>
            <!-- 2020: trên đường kẻ -->
            <div class="timeline-col top">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <div class="timeline-year">2020</div>
                    <div class="timeline-heading">MỞ RỘNG</div>
                    <div class="timeline-desc">Chúng tôi tiếp tục phát triển và mang đến những trải nghiệm cafe tuyệt
                        vời cho khách hàng.</div>
                </div>
                <div class="timeline-img">
                    <img src="https://images.unsplash.com/photo-1726678640183-2b64ed27ffdf?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8Y2FmZSUyMHNob3B8ZW58MHx8MHx8fDA%3D"
                        alt="">
                </div>
            </div>
        </div>
        <!-- End Timeline Row Section -->

        <!-- Tin tức mới nhất -->
        <section class="section-news">
            <h2 class="section-title">TIN TỨC MỚI NHẤT</h2>
            <hr class="section-divider" />
            <div class="news-grid">
                <?php if (!empty($latestNews)): ?>
                <?php foreach ($latestNews as $news): ?>
                <div class="news-card">
                    <img src="<?php echo Base_URL . 'public/uploads/post/' . $news['Image_post']; ?>">
                    <div class="news-content">
                        <h3><?php echo $news['Title_post']; ?></h3>
                        <a href="<?php echo Base_URL . 'NewsController/detailPost/' . $news['Id_post']; ?>"
                            class="btn">Đọc thêm</a>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
        <div class="diamond-divider">
            <span class="diamond-line"></span>
            <span class="diamond-shape"></span>
            <span class="diamond-line"></span>
        </div>
        <div class="why-choose-us">
            <div class="why-choose-title">
                <span class="why-choose-diamond"></span>
                <span class="why-choose-text">Tại Sao Chọn Chúng Tôi</span>
                <span class="why-choose-diamond"></span>
            </div>

            <div class="why-choose-main">THỰC ĐƠN PHONG PHÚ & HƯƠNG VỊ ĐẶC BIỆT</div>
            <div class="why-choose-desc">
                Chúng tôi tự hào mang đến cho quý khách những trải nghiệm cafe tuyệt vời nhất với hương vị đặc trưng,
                không gian thoáng đãng và dịch vụ chuyên nghiệp. Mỗi tách cafe của chúng tôi đều được pha chế tỉ mỉ từ
                những hạt cafe chất lượng cao, mang đến hương vị đậm đà khó quên.
            </div>
        </div>
        <div class="stats-section" id="statsSection">
            <div class="stat-box">
                <span class="stat-number" data-target="20">0</span>
                <span class="stat-label">Năm kinh nghiệm</span>
            </div>
            <div class="stat-box">
                <span class="stat-number" data-target="150">0</span>
                <span class="stat-label">Khách hàng mỗi ngày</span>
            </div>
            <div class="stat-box">
                <span class="stat-number" data-target="96">0</span>
                <span class="stat-label">Dự án đã thực hiện</span>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.product-card').forEach(function(card) {
            // Thêm sự kiện click vào card để chuyển đến trang chi tiết
            card.addEventListener('click', function() {
                const productId = card.getAttribute('data-product-id');
                window.location.href = (window.BASE_URL || '') + 'index/detailsProduct/' +
                    productId;
            });

            const minusBtn = card.querySelector('.qty-btn.minus');
            const plusBtn = card.querySelector('.qty-btn.plus');
            const qtyInput = card.querySelector('.qty-input');
            if (minusBtn && plusBtn && qtyInput) {
                minusBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    let val = parseInt(qtyInput.value) || 1;
                    if (val > 1) qtyInput.value = val - 1;
                });
                plusBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    let val = parseInt(qtyInput.value) || 1;
                    qtyInput.value = val + 1;
                });
            }
            const addToCartBtn = card.querySelector('.add-to-cart-btn');
            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const productId = card.getAttribute('data-product-id');
                    const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
                    fetch((window.BASE_URL || '') + 'CartController/add/' + productId, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                quantity: quantity
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                                return;
                            }
                            if (data.success) {
                                const cartCount = document.querySelector('.cart-count');
                                if (cartCount) cartCount.textContent = data.cart_count;
                                addToCartBtn.innerHTML =
                                    '<i class="fas fa-check"></i> Đã thêm';
                                addToCartBtn.disabled = true;
                                setTimeout(() => {
                                    addToCartBtn.innerHTML =
                                        '<i class="fas fa-cart-plus"></i>';
                                    addToCartBtn.disabled = false;
                                }, 1500);
                            } else {
                                alert(data.message ||
                                    'Có lỗi xảy ra khi thêm vào giỏ hàng');
                            }
                        })
                        .catch(() => {
                            alert('Có lỗi xảy ra khi thêm vào giỏ hàng');
                        });
                });
            }
            const buyNowBtn = card.querySelector('.buy-now-btn');
            if (buyNowBtn) {
                buyNowBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const productId = card.getAttribute('data-product-id');
                    const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
                    fetch((window.BASE_URL || '') + 'CartController/add/' + productId, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                quantity: quantity
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                                return;
                            }
                            if (data.success) {
                                window.location.href = (window.BASE_URL || '') +
                                    'CartController/index';
                            } else {
                                alert(data.message || 'Có lỗi xảy ra khi đặt hàng');
                            }
                        })
                        .catch(() => {
                            alert('Có lỗi xảy ra khi đặt hàng');
                        });
                });
            }
        });

        function revealOnScroll() {
            var divider = document.querySelector('.diamond-divider');
            if (!divider) return;
            var rect = divider.getBoundingClientRect();
            var windowHeight = window.innerHeight || document.documentElement.clientHeight;
            if (rect.top < windowHeight - 80) {
                divider.classList.add('visible');
                window.removeEventListener('scroll', revealOnScroll);
            }
        }
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll();

        function revealWhyChoose() {
            var title = document.querySelector('.why-choose-title');
            var main = document.querySelector('.why-choose-main');
            var desc = document.querySelector('.why-choose-desc');
            var windowHeight = window.innerHeight || document.documentElement.clientHeight;
            if (title && main) {
                var rectTitle = title.getBoundingClientRect();
                var rectMain = main.getBoundingClientRect();
                if (rectTitle.top < windowHeight - 80) title.classList.add('visible');
                if (rectMain.top < windowHeight - 80) main.classList.add('visible');
            }
            if (desc) {
                var rectDesc = desc.getBoundingClientRect();
                if (rectDesc.top < windowHeight - 80 && rectDesc.bottom > 0) {
                    desc.classList.add('visible', 'fadeInUp');
                    window.removeEventListener('scroll', revealWhyChoose);
                }
            }
        }
        window.addEventListener('scroll', revealWhyChoose);

        function revealHistoryTitle() {
            var historyTitle = document.querySelector('.history-title');
            var timelineTitle = document.querySelector('.timeline-title');
            var windowHeight = window.innerHeight || document.documentElement.clientHeight;
            if (historyTitle) {
                var rect = historyTitle.getBoundingClientRect();
                if (rect.top < windowHeight - 80 && rect.bottom > 0) {
                    historyTitle.classList.add('visible', 'fadeInLeft');
                }
            }
            if (timelineTitle) {
                var rect2 = timelineTitle.getBoundingClientRect();
                if (rect2.top < windowHeight - 80 && rect2.bottom > 0) {
                    timelineTitle.classList.add('visible', 'fadeInLeft');
                }
            }
        }
        window.addEventListener('scroll', revealHistoryTitle);
        revealHistoryTitle();
    });

    function animateCounter(element, target, duration = 1500) {
        let start = 0;
        let startTime = null;

        function updateCounter(timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = Math.min((timestamp - startTime) / duration, 1);
            const value = Math.floor(progress * (target - start) + start);
            element.textContent = value;
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
            }
        }
        requestAnimationFrame(updateCounter);
    }

    function handleStatsAnimation() {
        const statsSection = document.getElementById('statsSection');
        if (!statsSection) return;
        const rect = statsSection.getBoundingClientRect();
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;
        if (rect.top < windowHeight - 80 && rect.bottom > 0) {
            statsSection.querySelectorAll('.stat-number').forEach(el => {
                el.textContent = '0';
                animateCounter(el, parseInt(el.getAttribute('data-target')));
            });
            // Remove scroll event listener after animation starts
            window.removeEventListener('scroll', handleStatsAnimation);
        }
    }
    window.addEventListener('scroll', handleStatsAnimation);
    window.addEventListener('load', handleStatsAnimation);
    </script>
</body>