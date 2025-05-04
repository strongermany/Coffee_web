<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/menu1.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/headerA.css" />
  <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/footer.css" />
</head>

<body>

  
  <div class="content-wrapper menu-products">
    <div class="container">
      <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $category): ?>
          <h3 class="title-1" data-aos="fade-down"><?php echo $category['Category']; ?></h3>
          <div class="hr-container" data-aos="fade-up"><hr></div>
          <div class="products-container">
            <?php foreach ($products as $product): ?>
              <?php if ($product['Id_category_product'] == $category['Id_Cate']): ?>
                <div class="product" data-name="p-<?php echo $product['Id_product']; ?>" data-product-id="<?php echo $product['Id_product']; ?>">
                  <div class="product-image">
                    <img src="<?php echo Base_URL; ?>public/uploads/product/<?php echo $product['Images_product']; ?>" alt="<?php echo htmlspecialchars($product['Title_product']); ?>">
                    <div class="product-hover-card">
                      <div class="card-content">
                        <!-- <div class="card-desc"><?php echo $product['Desc_product']; ?></div> -->
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
      <?php else: ?>
        <div>Không có danh mục nào.</div>
      <?php endif; ?>

      <!-- Tea Section -->
      <h3 class="title-1" data-aos="fade-down">Trà</h3>
      <div class="hr-container" data-aos="fade-up">
        <hr>
      </div>
      <div class="products-container">
        <div class="product" data-name="p-4" data-product-id="4">
          <div class="product-image">
            <img src="images/trà dâu tằm.jpg" alt="Trà dâu tằm" loading="lazy" />
          </div>
          <h3>Trà dâu tằm</h3>
          <div class="price">35.000đ</div>
        </div>

        <div class="product" data-name="p-5" data-product-id="5">
          <div class="product-image">
            <img src="images/trà chanh.jpg" alt="Trà chanh" loading="lazy" />
          </div>
          <h3>Trà chanh</h3>
          <div class="price">25.000đ</div>
        </div>

        <div class="product" data-name="p-6" data-product-id="6">
          <div class="product-image">
            <img src="images/trà ổi.jpg" alt="Trà ổi" loading="lazy" />
          </div>
          <h3>Trà ổi</h3>
          <div class="price">35.000đ</div>
        </div>

        <div class="product" data-name="p-7" data-product-id="7">
          <div class="product-image">
            <img src="images/trà xanh matcha.jpg" alt="Trà xanh matcha" loading="lazy" />
          </div>
          <h3>Trà xanh matcha</h3>
          <div class="price">35.000đ</div>
        </div>

        <div class="product" data-name="p-8" data-product-id="8">
          <div class="product-image">
            <img src="images/trà bạc hà.jpg" alt="Trà bạc hà" loading="lazy" />
          </div>
          <h3>Trà bạc hà</h3>
          <div class="price">32.000đ</div>
        </div>

        <div class="product" data-name="p-9" data-product-id="9">
          <div class="product-image">
            <img src="images/trà dâu.jpg" alt="Trà dâu" loading="lazy" />
          </div>
          <h3>Trà dâu</h3>
          <div class="price">35.000đ</div>
        </div>
      </div>

      <!-- Bingsu Section -->
      <h3 class="title-1" data-aos="fade-down">Bingsu</h3>
      <div class="hr-container" data-aos="fade-up">
        <hr>
      </div>
      <div class="products-container">
        <div class="product" data-name="p-10" data-product-id="10">
          <div class="product-image">
            <img src="images/bánh matcha.jpg" alt="Matcha" loading="lazy" />
          </div>
          <h3>Matcha</h3>
          <div class="price">45.000đ</div>
        </div>

        <div class="product" data-name="p-11" data-product-id="11">
          <div class="product-image">
            <img src="images/bánh socola.jpg" alt="Chocolate" loading="lazy" />
          </div>
          <h3>Chocolate</h3>
          <div class="price">45.000đ</div>
        </div>

        <div class="product" data-name="p-12" data-product-id="12">
          <div class="product-image">
            <img src="images/Yến mạch.jpg" alt="Yến mạch" loading="lazy" />
          </div>
          <h3>Yến mạch</h3>
          <div class="price">48.000đ</div>
        </div>
      </div>

      <!-- Best Seller Section -->
      <h3 class="title" data-aos="fade-down">Best Seller</h3>
      <div class="hr-container" data-aos="fade-up">
        <hr>
      </div>
      <div class="products-container">
        <div class="product" data-name="p-13" data-product-id="13">
          <div class="product-image">
            <img src="images/cafe bạc hà.jpg" alt="Cafe Bạc Hà" loading="lazy" />
          </div>
          <h3>Cafe Bạc Hà</h3>
          <div class="price">28.000đ</div>
        </div>

        <div class="product" data-name="p-14" data-product-id="14">
          <div class="product-image">
            <img src="images/matcha latte.jpg" alt="Matcha Latte" loading="lazy" />
          </div>
          <h3>Matcha Latte</h3>
          <div class="price">38.000đ</div>
        </div>

        <div class="product" data-name="p-15" data-product-id="15">
          <div class="product-image">
            <img src="images/đá dâu.jpg" alt="Dâu sữa đá" loading="lazy" />
          </div>
          <h3>Dâu sữa đá</h3>
          <div class="price">40.000đ</div>
        </div>
      </div>
    </div>

    <!-- Product Preview Modal -->
    <div class="products-preview">
      <div class="preview" data-target="p-1">
        <i class="fas fa-times"></i>
        <img src="images/đá.jpg" alt="Cà phê đen" />
        <h3>Cà phê đen</h3>
        <div class="stars">
          <i class="fas fa-star" style="--i:1"></i>
          <i class="fas fa-star" style="--i:2"></i>
          <i class="fas fa-star" style="--i:3"></i>
          <i class="fas fa-star" style="--i:4"></i>
          <i class="fas fa-star-half-alt" style="--i:5"></i>
        </div>
        <p>Đậm sâu từng giọt, thức tỉnh mọi giác quan.</p>
        <div class="price">19.000đ</div>
        <div class="buttons">
          <a href="#" class="buy">Đặt hàng</a>
          <a href="#" class="cart">Thêm vào giỏ</a>
        </div>
      </div>

      <div class="preview" data-target="p-2">
        <i class="fas fa-times"></i>
        <img src="images/cafe sữa.jpg" alt="Cà phê sữa" />
        <h3>Cà phê sữa</h3>
        <div class="stars">
          <i class="fas fa-star" style="--i:1"></i>
          <i class="fas fa-star" style="--i:2"></i>
          <i class="fas fa-star" style="--i:3"></i>
          <i class="fas fa-star" style="--i:4"></i>
          <i class="fas fa-star-half-alt" style="--i:5"></i>
        </div>
        <p>Hòa quyện ngọt đắng, dư vị khó quên.</p>
        <div class="price">22.000đ</div>
        <div class="buttons">
          <a href="#" class="buy">Đặt hàng</a>
          <a href="#" class="cart">Thêm vào giỏ</a>
        </div>
      </div>

      <div class="preview" data-target="p-3">
        <i class="fas fa-times"></i>
        <img src="images/3.jpg" alt="Bạc xỉu" />
        <h3>Bạc xỉu</h3>
        <div class="stars">
          <i class="fas fa-star" style="--i:1"></i>
          <i class="fas fa-star" style="--i:2"></i>
          <i class="fas fa-star" style="--i:3"></i>
          <i class="fas fa-star" style="--i:4"></i>
          <i class="fas fa-star-half-alt" style="--i:5"></i>
        </div>
        <p>Ngọt béo dịu êm, một chút dư vị hoài niệm.</p>
        <div class="price">25.000đ</div>
        <div class="buttons">
          <a href="#" class="buy">Đặt hàng</a>
          <a href="#" class="cart">Thêm vào giỏ</a>
        </div>
      </div>
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
      // Hover: chỉ hiện card khi hover vào product
      document.querySelectorAll('.product').forEach(function(product) {
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
            // Xử lý logic mua ngay nếu có
          });
        }
      });
    });
  </script>
</body>


</html>
