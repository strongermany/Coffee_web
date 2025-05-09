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
              <img src="<?php echo Base_URL . 'public/uploads/product/' . $product['Images_product']; ?>" alt="<?php echo $product['Title_product']; ?>">
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
                <a href="<?php echo Base_URL . 'NewsController/detailPost/' . $news['Id_post']; ?>" class="btn">Đọc thêm</a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.product-card').forEach(function(card) {
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
              addToCartBtn.innerHTML = '<i class="fas fa-check"></i> Đã thêm';
              addToCartBtn.disabled = true;
              setTimeout(() => {
                addToCartBtn.innerHTML = '<i class="fas fa-cart-plus"></i>';
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
      const buyNowBtn = card.querySelector('.buy-now-btn');
      if (buyNowBtn) {
        buyNowBtn.addEventListener('click', function(event) {
          event.stopPropagation();
          const productId = card.getAttribute('data-product-id');
          const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
          fetch((window.BASE_URL || '') + 'CartController/add/' + productId, {
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
              window.location.href = (window.BASE_URL || '') + 'CartController/index';
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
  });
  </script>
</body>