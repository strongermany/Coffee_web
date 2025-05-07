<?php
$category_name = isset($category_info) ? $category_info['Category'] : 'Gia dụng';
?>

<link rel="stylesheet" href="<?php echo Base_URL ?>public/css/giadung.css" />
<div class="giadung-wrapper">
  <div class="container">
    <div class="giadung-title"><?php echo $category_name; ?></div>
    <div class="giadung-hr"></div>
    <div class="giadung-products">
      <?php if(isset($products) && is_array($products) && count($products) > 0): ?>
        <?php foreach($products as $product): ?>
          <?php $imgPath = Base_URL . 'public/uploads/product/' . $product['Images_product']; ?>
          <div class="giadung-card" data-product-id="<?php echo $product['Id_product']; ?>">
            <div class="giadung-card-image">
              <img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($product['Title_product']); ?>" onerror="this.style.background='#eee';this.style.objectFit='contain';this.src='<?php echo Base_URL ?>public/images/no-image.png';">
              <div class="giadung-card-overlay">
                <div class="giadung-qty-group">
                  <button class="giadung-qty-btn">-</button>
                  <input type="number" class="giadung-qty-input qty" min="1" value="1">
                  <button class="giadung-qty-btn">+</button>
                </div>
                <div class="giadung-card-actions">
                  <button class="giadung-btn">Đặt hàng</button>
                  <button class="giadung-btn add-to-cart" data-product-id="<?php echo $product['Id_product']; ?>"><i class="fas fa-cart-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="giadung-card-rating">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
            </div>
            <div class="giadung-card-title"><?php echo htmlspecialchars($product['Title_product']); ?></div>
            <div class="giadung-card-price"><?php echo number_format($product['Price_product'], 0, ',', '.'); ?>đ</div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div>Không có sản phẩm nào trong danh mục này.</div>
      <?php endif; ?>
    </div>
  </div>
</div>

<style>


.product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.product-image {
    position: relative;
    overflow: hidden;
    padding-top: 100%;
}

.product-image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.1);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.product-info {
    padding: 15px;
    text-align: center;
}

.product-title {
    font-size: 1.1rem;
    margin-bottom: 10px;
    color: #333;
    font-weight: 500;
    height: 2.4em;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.product-price {
    color: #e44d26;
    font-weight: bold;
    font-size: 1.2rem;
}

.btn-outline-light:hover {
    background: #fff;
    color: #333;
}

.add-to-cart {
    background: #e44d26;
    border-color: #e44d26;
}

.add-to-cart:hover {
    background: #c73e1d;
    border-color: #c73e1d;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate__fadeInUp {
    animation: fadeInUp 0.6s ease forwards;
}

/* Thêm animation delay cho từng sản phẩm */
.col-12:nth-child(1) .product-card { animation-delay: 0.1s; }
.col-12:nth-child(2) .product-card { animation-delay: 0.2s; }
.col-12:nth-child(3) .product-card { animation-delay: 0.3s; }
.col-12:nth-child(4) .product-card { animation-delay: 0.4s; }
</style>

<script>
var Base_URL = "<?php echo Base_URL; ?>";
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý thêm vào giỏ hàng cho nút giadung-btn (icon giỏ hàng)
    document.querySelectorAll('.giadung-card').forEach(function(card) {
        const addToCartBtn = card.querySelector('.giadung-btn i.fa-cart-plus')?.closest('.giadung-btn');
        const qtyInput = card.querySelector('.giadung-qty-input');
        if (addToCartBtn && qtyInput) {
            addToCartBtn.addEventListener('click', function() {
                const id = card.getAttribute('data-product-id');
                const quantity = parseInt(qtyInput.value) || 1;
                // Animation khi click
                addToCartBtn.innerHTML = '<i class="fas fa-check"></i> Đã thêm';
                addToCartBtn.classList.add('added');
                // Gọi API thêm vào giỏ hàng
                fetch(`${Base_URL}CartController/add/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ quantity: quantity })
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
                        showNotification('Đã thêm sản phẩm vào giỏ hàng', 'success');
                    } else {
                        showNotification(data.message || 'Có lỗi xảy ra', 'error');
                        addToCartBtn.innerHTML = '<i class="fas fa-cart-plus"></i>';
                        addToCartBtn.classList.remove('added');
                    }
                })
                .catch(() => {
                    showNotification('Có lỗi xảy ra khi thêm vào giỏ hàng', 'error');
                    addToCartBtn.innerHTML = '<i class="fas fa-cart-plus"></i>';
                    addToCartBtn.classList.remove('added');
                });
            });
        }
    });
    // Hàm hiển thị thông báo
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        document.body.appendChild(notification);
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.padding = '15px 25px';
        notification.style.borderRadius = '5px';
        notification.style.color = 'white';
        notification.style.zIndex = '1000';
        notification.style.animation = 'slideIn 0.5s ease-out';
        if (type === 'success') {
            notification.style.backgroundColor = '#4CAF50';
        } else {
            notification.style.backgroundColor = '#f44336';
        }
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.5s ease-out';
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 3000);
    }
    // Thêm keyframes cho animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
});
</script>
