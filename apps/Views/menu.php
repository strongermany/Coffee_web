<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/menu1.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
 
</head>

<body>

<?php
$category_id = isset($_GET['category']) ? $_GET['category'] : null;
// Xác định nếu chỉ hiển thị Gia dụng (ví dụ: category_id == 16)
$is_giadung_only = ($category_id == 16);
?>

  <div class="content-wrapper menu-products">
    <div class="container">
      <?php if (!empty($categories)): ?>
        <?php if ($category_id): ?>
          <?php
            $selected_category = null;
            foreach ($categories as $category) {
              if ($category['Id_Cate'] == $category_id) {
                $selected_category = $category;
                break;
              }
            }
          ?>
          <?php if ($selected_category): ?>
            <h3 class="title-1" data-aos="fade-down"><?php echo $selected_category['Category']; ?></h3>
            <div class="hr-container" data-aos="fade-up"><hr></div>
            <div class="products-container">
              <?php foreach ($products as $product): ?>
                <?php if ($product['Id_category_product'] == $selected_category['Id_Cate']): ?>
                  <div class="product" data-product-id="<?php echo $product['Id_product']; ?>">
                    <div class="product-image">
                      <img src="<?php echo Base_URL; ?>public/uploads/product/<?php echo $product['Images_product']; ?>" alt="<?php echo htmlspecialchars($product['Title_product']); ?>">
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
                    <div class="card-rating">
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3><?php echo htmlspecialchars($product['Title_product']); ?></h3>
                    <div class="price"><?php echo number_format($product['Price_product'], 0, ',', '.'); ?>đ</div>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div>Không tìm thấy danh mục.</div>
          <?php endif; ?>
        <?php else: ?>
          <?php if (!$is_giadung_only): // Ẩn dropdown khi chỉ hiển thị Gia dụng ?>
            <?php foreach ($categories as $category): ?>
              <h3 class="title-1" data-aos="fade-down"><?php echo $category['Category']; ?></h3>
              <div class="hr-container" data-aos="fade-up"><hr></div>
              <div class="products-container">
                <?php foreach ($products as $product): ?>
                  <?php if ($product['Id_category_product'] == $category['Id_Cate']): ?>
                    <div class="product" data-product-id="<?php echo $product['Id_product']; ?>">
                      <div class="product-image">
                        <img src="<?php echo Base_URL; ?>public/uploads/product/<?php echo $product['Images_product']; ?>" alt="<?php echo htmlspecialchars($product['Title_product']); ?>">
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
                      <div class="card-rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                      </div>
                      <h3><?php echo htmlspecialchars($product['Title_product']); ?></h3>
                      <div class="price"><?php echo number_format($product['Price_product'], 0, ',', '.'); ?>đ</div>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        <?php endif; ?>
      <?php else: ?>
        <div>Không có danh mục nào.</div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
      offset: 150
    });
  </script>
  <script src="<?php echo Base_URL ?>public/js/menu.js" defer></script>
  <script src="<?php echo Base_URL ?>public/js/cart.js"></script>
  <script>
    const BASE_URL = '<?php echo Base_URL ?>';
  </script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add click event for products
      document.querySelectorAll('.product').forEach(function(product) {
        product.addEventListener('click', function() {
          const productId = product.getAttribute('data-product-id');
          window.location.href = BASE_URL + 'index/detailsProduct/' + productId;
        });

        // Hover: chỉ hiện card khi hover vào product
        const hoverCard = product.querySelector('.product-hover-card');
        product.addEventListener('mouseenter', function() {
          if (hoverCard) hoverCard.style.display = 'block';
        });
        product.addEventListener('mouseleave', function() {
          if (hoverCard) hoverCard.style.display = 'none';
        });
        // Tăng giảm số lượng
        const minusBtn = product.querySelector('.qty-btn.minus');
        const plusBtn = product.querySelector('.qty-btn.plus');
        const qtyInput = product.querySelector('.qty-input');
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
        // Thêm vào giỏ hàng
        const addToCartBtn = product.querySelector('.add-to-cart-btn');
        if (addToCartBtn) {
          addToCartBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            const productId = product.getAttribute('data-product-id');
            const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
            fetch(`${BASE_URL}CartController/add/${productId}`, {
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
        // Đặt hàng (nếu muốn xử lý riêng)
        const buyNowBtn = product.querySelector('.buy-now-btn');
        if (buyNowBtn) {
          buyNowBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            const productId = product.getAttribute('data-product-id');
            const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
            fetch(`${BASE_URL}CartController/add/${productId}`, {
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
      });
    });
  </script>
</body>


</html>
