<link rel="stylesheet" href="<?php echo Base_URL ?>public/css/menu1.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<div class="product-detail-container-dark">
    <div class="product-detail-card-dark reveal-on-scroll">
        <div class="product-detail-image-dark reveal-on-scroll">
            <img src="<?php echo Base_URL; ?>public/uploads/items/<?php echo $item['images_item']; ?>"
                alt="<?php echo htmlspecialchars($item['title_item']); ?>">
        </div>
        <div class="product-detail-info-dark reveal-on-scroll">
            <h2 class="product-detail-title-dark"><?php echo htmlspecialchars($item['title_item']); ?></h2>
            <div class="product-detail-price-dark">
                <span><i class="fas fa-tag"></i></span>
                <?php echo number_format($item['price_item'], 0, ',', '.'); ?>đ
            </div>
            <div class="product-detail-desc-dark"><?php echo $item['desc_item'] ?? ''; ?></div>            <div class="product-detail-actions-dark">
                <button class="buy-now-btn-dark animated-btn-dark"><i class="fas fa-bolt"></i> Đặt hàng</button>
                <button class="add-to-cart-btn-dark animated-btn-dark"><i class="fas fa-cart-plus"></i> Thêm vào giỏ</button>
            </div>
        </div>
        <aside class="product-detail-aside-dark reveal-on-scroll">
            <div class="aside-title">Sản phẩm khác</div>
            <?php if (!empty($related_items)): ?>
            <?php foreach ($related_items as $rel): ?>
            <a class="aside-product-link"
                href="<?php echo Base_URL; ?>index/detailsItem/<?php echo $rel['id_item']; ?>">
                <div class="aside-product-item">
                    <img src="<?php echo Base_URL; ?>public/uploads/items/<?php echo $rel['images_item']; ?>"
                        alt="<?php echo $rel['title_item']; ?>">
                    <div>
                        <div class="aside-product-title"><?php echo $rel['title_item']; ?></div>
                        <div class="aside-product-price">
                            <?php echo number_format($rel['price_item'], 0, ',', '.'); ?>đ</div>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="aside-empty">Không có sản phẩm liên quan</div>
            <?php endif; ?>
        </aside>
    </div>
</div>
<style>
.product-detail-container-dark {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 90vh;
    background: #111;
    padding: 0;
}

.product-detail-card-dark {
    display: flex;
    background: #111;
    border-radius: 0;
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.18), 0 2px 12px rgba(0, 0, 0, 0.18);
    overflow: hidden;
    max-width: 1500px;
    width: 100%;
    min-height: 600px;
    animation: fadeInUp 1s cubic-bezier(.23, 1.01, .32, 1);
}

.product-detail-image-dark {
    flex: 1.1;
    min-width: 520px;
    background: #111;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 64px 0;
    transition: box-shadow 0.3s;
}

.product-detail-image-dark img {
    width: 100%;
    max-width: 700px;
    border-radius: 24px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
    transition: transform 0.4s cubic-bezier(.23, 1.01, .32, 1);
    background: #111;
}

.product-detail-image-dark img:hover {
    transform: scale(1.04) rotate(-2deg);
}

.product-detail-info-dark {
    flex: 2;
    padding: 48px 32px 32px 32px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: #ffe082;
    font-family: 'Playfair Display', serif;
    animation: fadeInUp 1.2s cubic-bezier(.23, 1.01, .32, 1);
}

.product-detail-title-dark {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 24px;
    color: #ffe082;
    letter-spacing: 2px;
    text-shadow: 0 4px 16px rgba(191, 167, 106, 0.18), 0 2px 8px rgba(0, 0, 0, 0.18);
    animation: fadeInUp 1.3s cubic-bezier(.23, 1.01, .32, 1);
}

.product-detail-price-dark {
    font-size: 1.3rem;
    color: #bfa76a;
    font-weight: 600;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: fadeInUp 1.4s cubic-bezier(.23, 1.01, .32, 1);
}

.product-detail-price-dark i {
    color: #ffe082;
    font-size: 1.1em;
}

.product-detail-desc-dark {
    font-size: 1.05rem;
    color: #e2e2e2;
    margin-bottom: 28px;
    line-height: 1.7;
    animation: fadeInUp 1.5s cubic-bezier(.23, 1.01, .32, 1);
}

.product-detail-actions-dark {
    display: flex;
    gap: 18px;
    animation: fadeInUp 1.6s cubic-bezier(.23, 1.01, .32, 1);
}

.animated-btn-dark {
    background: linear-gradient(90deg, #bfa76a 60%, #ffe082 100%);
    color: #181818;
    border: 2px solid transparent;
    padding: 10px 24px;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 16px rgba(191, 167, 106, 0.18);
    transition: background 0.2s, color 0.2s, transform 0.2s, box-shadow 0.2s, border 0.2s;
    outline: none;
    position: relative;
    overflow: hidden;
    font-family: 'Playfair Display', serif;
    letter-spacing: 1px;
}

.animated-btn-dark i {
    margin-right: 6px;
    font-size: 0.95em;
}

.animated-btn-dark:hover {
    background: linear-gradient(90deg, #ffe082 0%, #fff7d6 100%);
    color: #bfa76a;
    border: 2.5px solid #ffe082;
    transform: translateY(-4px) scale(1.08);
    box-shadow: 0 16px 48px 0 rgba(255, 224, 130, 0.22), 0 2px 12px rgba(191, 167, 106, 0.22);
    font-weight: 800;
    letter-spacing: 2px;
}

.product-detail-aside-dark {
    flex: 0.7;
    background: #111;
    padding: 36px 18px 36px 18px;
    display: flex;
    flex-direction: column;
    min-width: 260px;
    max-width: 320px;
    border-left: 2px solid #222;
    box-shadow: 0 2px 12px rgba(191, 167, 106, 0.08);
    align-items: flex-start;
    justify-content: flex-start;
}

.aside-title {
    color: #ffe082;
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 18px;
    letter-spacing: 1px;
}

.aside-product-link {
    text-decoration: none;
    color: inherit;
    width: 100%;
}

.aside-product-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
    background: #181818;
    border-radius: 8px;
    padding: 10px 10px;
    box-shadow: 0 2px 8px rgba(191, 167, 106, 0.08);
    transition: background 0.2s, box-shadow 0.2s;
}

.aside-product-item:hover {
    background: #2d2d2d;
    box-shadow: 0 4px 16px rgba(191, 167, 106, 0.18);
}

.aside-product-item img {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 6px;
    background: #fffbe6;
}

.aside-product-title {
    color: #ffe082;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 2px;
}

.aside-product-price {
    color: #bfa76a;
    font-size: 0.98rem;
}

.aside-empty {
    color: #bfa76a;
    font-size: 1rem;
    margin-top: 18px;
}

@media (max-width: 1200px) {
    .product-detail-card-dark {
        flex-direction: column;
        min-height: unset;
    }

    .product-detail-image-dark,
    .product-detail-info-dark,
    .product-detail-aside-dark {
        width: 100%;
    }

    .product-detail-info-dark {
        padding: 32px 12px;
    }

    .product-detail-title-dark {
        font-size: 1.5rem;
    }

    .product-detail-price-dark {
        font-size: 1rem;
    }

    .product-detail-aside-dark {
        max-width: 100%;
        min-width: 0;
        border-left: none;
        box-shadow: none;
        margin-top: 24px;
    }
}

@media (max-width: 700px) {
    .product-detail-info-dark {
        padding: 16px 4px;
    }

    .product-detail-title-dark {
        font-size: 1.1rem;
    }

    .product-detail-aside-dark {
        padding: 16px 4px;
    }
}

/* Hiệu ứng xuất hiện */
.reveal-on-scroll {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 0.6s, transform 0.6s;
}

.reveal-on-scroll.visible {
    opacity: 1;
    transform: translateY(0);
    animation: fadeInUp 0.8s cubic-bezier(.23, 1.01, .32, 1) forwards;
}

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
</style>
<script>
// Hiệu ứng xuất hiện khi lướt đến
function revealOnScroll() {
    var reveals = document.querySelectorAll('.reveal-on-scroll');
    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementBottom = reveals[i].getBoundingClientRect().bottom;
        var elementVisible = 80;
        if (elementTop < windowHeight - elementVisible && elementBottom > elementVisible) {
            reveals[i].classList.add('visible');
        } else {
            reveals[i].classList.remove('visible');
        }
    }
}
window.addEventListener('scroll', revealOnScroll);
window.addEventListener('DOMContentLoaded', revealOnScroll);

// Xử lý thêm vào giỏ hàng và đặt hàng
const BASE_URL = '<?php echo Base_URL ?>';
const itemId = '<?php echo $item['id_item']; ?>';
const addToCartBtn = document.querySelector('.add-to-cart-btn-dark');
if (addToCartBtn) {
    addToCartBtn.addEventListener('click', function() {
        fetch(`${BASE_URL}CartController/add/${itemId}?type=item`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ quantity: 1 })
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
                addToCartBtn.innerHTML = '<i class=\"fas fa-check\"></i> Đã thêm';
                addToCartBtn.disabled = true;
                setTimeout(() => {
                    addToCartBtn.innerHTML = '<i class=\"fas fa-cart-plus\"></i> Thêm vào giỏ';
                    addToCartBtn.disabled = false;
                }, 1500);
            } else {
                alert(data.message || 'Có lỗi xảy ra khi thêm vào giỏ hàng');
            }
        })
        .catch(() => {
            alert('Có lỗi xảy ra khi thêm vào giỏ hàng');
        });
    });
}
const buyNowBtn = document.querySelector('.buy-now-btn-dark');
if (buyNowBtn) {
    buyNowBtn.addEventListener('click', function() {
        fetch(`${BASE_URL}CartController/add/${itemId}?type=item`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ quantity: 1 })
        })
        .then(res => res.json())
        .then(data => {
            if (data.redirect) {
                window.location.href = data.redirect;
                return;
            }
            if (data.success) {
                window.location.href = `${BASE_URL}CartController/index`;
            } else {
                alert(data.message || 'Có lỗi xảy ra khi đặt hàng');
            }
        })
        .catch(() => {
            alert('Có lỗi xảy ra khi đặt hàng');
        });
    });
}
</script>