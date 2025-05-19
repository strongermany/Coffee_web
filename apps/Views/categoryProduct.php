<?php
$category_name = isset($category_info) ? ($category_info['name_cate_item'] ?? 'Danh mục') : 'Danh mục';
?>

<link rel="stylesheet" href="<?php echo Base_URL ?>public/css/giadung.css" />

<div class="giadung-wrapper">
  <div class="container">
    <!-- Dropdown chọn danh mục -->
    <?php if (isset($all_categories) && is_array($all_categories) && count($all_categories) > 0): ?>
      <div class="category-dropdown-wrapper" style="margin-bottom: 24px; text-align:center;">
        <select id="categoryDropdown" class="category-dropdown">
          <?php foreach ($all_categories as $cate): ?>
            <option value="<?php echo $cate['id_cate_item']; ?>" <?php if (isset($category_info) && $category_info['id_cate_item'] == $cate['id_cate_item']) echo 'selected'; ?>>
              <?php echo htmlspecialchars($cate['name_cate_item']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <script>
        document.getElementById('categoryDropdown').addEventListener('change', function() {
          window.location.href = '<?php echo Base_URL; ?>index/category/' + this.value;
        });
      </script>
    <?php endif; ?>
    <div class="giadung-title"><?php echo $category_name; ?></div>
    <div class="giadung-hr"></div>
    <div class="giadung-products">
      <?php if(isset($items) && is_array($items) && count($items) > 0): ?>
        <?php foreach($items as $item): ?>
          <?php $imgPath = Base_URL . 'public/uploads/items/' . $item['images_item']; ?>
          <div class="giadung-card" data-item-id="<?php echo $item['id_item']; ?>">
            <div class="giadung-card-image">
              <img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($item['title_item']); ?>" onerror="this.style.background='#eee';this.style.objectFit='contain';this.src='<?php echo Base_URL ?>public/images/no-image.png';">
              <div class="giadung-card-overlay">
                <div class="giadung-qty-group">
                  <button class="giadung-qty-btn">-</button>
                  <input type="number" class="giadung-qty-input qty" min="1" value="1">
                  <button class="giadung-qty-btn">+</button>
                </div>
                <div class="giadung-card-actions">
                  <button class="giadung-btn">Đặt hàng</button>
                  <button class="giadung-btn add-to-cart" data-item-id="<?php echo $item['id_item']; ?>"><i class="fas fa-cart-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="giadung-card-rating">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
            </div>
            <div class="giadung-card-title"><?php echo htmlspecialchars($item['title_item']); ?></div>
            <div class="giadung-card-price"><?php echo number_format($item['price_item'], 0, ',', '.'); ?>đ</div>
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

/* Dropdown style giống menu1.css */
.category-dropdown {
  padding: 10px 18px;
  border-radius: 8px;
  border: 1.5px solid #bcaaa4;
  background: #fff8f0;
  color: #4e342e;
  font-size: 1.1em;
  font-family: 'Playfair Display', serif;
  box-shadow: 0 2px 8px rgba(74, 52, 40, 0.07);
  transition: border 0.2s, box-shadow 0.2s;
  outline: none;
  margin-bottom: 10px;
}
.category-dropdown:focus, .category-dropdown:hover {
  border: 2px solid #a1887f;
  box-shadow: 0 4px 16px rgba(74, 52, 40, 0.13);
}
</style>

<script>
var Base_URL = "<?php echo Base_URL; ?>";
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý thêm vào giỏ hàng cho nút giadung-btn (icon giỏ hàng)
    document.querySelectorAll('.giadung-card').forEach(function(card) {
        const addToCartBtn = card.querySelector('.giadung-btn i.fa-cart-plus')?.closest('.giadung-btn');
        const buyNowBtn = card.querySelector('.giadung-btn:not(.add-to-cart)');
        const qtyInput = card.querySelector('.giadung-qty-input');
        
        if (addToCartBtn && qtyInput) {
            addToCartBtn.addEventListener('click', function() {
                const id = card.getAttribute('data-item-id');
                const quantity = parseInt(qtyInput.value) || 1;
                // Animation khi click
                addToCartBtn.innerHTML = '<i class="fas fa-check"></i> Đã thêm';
                addToCartBtn.classList.add('added');
                // Gọi API thêm vào giỏ hàng
                fetch(`${Base_URL}CartController/add/${id}?type=item`, {
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

        // Thêm xử lý cho nút Đặt hàng
        if (buyNowBtn && qtyInput) {
            buyNowBtn.addEventListener('click', function() {
                const id = card.getAttribute('data-item-id');
                const quantity = parseInt(qtyInput.value) || 1;
                
                fetch(`${Base_URL}CartController/add/${id}?type=item`, {
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
                        window.location.href = `${Base_URL}CartController/index`;
                    } else {
                        showNotification(data.message || 'Có lỗi xảy ra khi đặt hàng', 'error');
                    }
                })
                .catch(() => {
                    showNotification('Có lỗi xảy ra khi đặt hàng', 'error');
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

    // Thêm sự kiện click vào card để vào trang chi tiết sản phẩm
    document.querySelectorAll('.giadung-card').forEach(function(card) {
        card.addEventListener('click', function(e) {
            if (
                e.target.closest('.giadung-qty-btn') ||
                e.target.closest('.giadung-btn') ||
                e.target.closest('.giadung-qty-input')
            ) {
                return;
            }
            const id = card.getAttribute('data-item-id');
            window.location.href = Base_URL + 'index/detailsItem/' + id;
        });
    });
});
</script>
