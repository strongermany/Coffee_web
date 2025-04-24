<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/categoryProduct.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
  <div class="content-wrapper menu-products">
    <div class="container">
      <!-- Coffee Section -->
      <h3 class="title-1" data-aos="fade-down">Cà phê</h3>
      <div class="hr-container" data-aos="fade-up">
        <hr>
      </div>
      <div class="products-container">
        <div class="product" data-name="p-1">
          <div class="product-image">
            <img src="images/đá.jpg" alt="Cà phê đen" loading="lazy" />
          </div>
          <h3>Cà phê đen</h3>
          <div class="price">19.000đ</div>
        </div>

        <div class="product" data-name="p-2">
          <div class="product-image">
            <img src="images/cafe sữa.jpg" alt="Cà phê sữa" loading="lazy" />
          </div>
          <h3>Cà phê sữa</h3>
          <div class="price">22.000đ</div>
        </div>

        <div class="product" data-name="p-3">
          <div class="product-image">
            <img src="images/3.jpg" alt="Bạc xỉu" loading="lazy" />
          </div>
          <h3>Bạc xỉu</h3>
          <div class="price">25.000đ</div>
        </div>
      </div>

      <!-- Tea Section -->
      <h3 class="title-1" data-aos="fade-down">Trà</h3>
      <div class="hr-container" data-aos="fade-up">
        <hr>
      </div>
      <div class="products-container">
        <div class="product" data-name="p-4">
          <div class="product-image">
            <img src="images/trà dâu tằm.jpg" alt="Trà dâu tằm" loading="lazy" />
          </div>
          <h3>Trà dâu tằm</h3>
          <div class="price">35.000đ</div>
        </div>

        <div class="product" data-name="p-5">
          <div class="product-image">
            <img src="images/trà chanh.jpg" alt="Trà chanh" loading="lazy" />
          </div>
          <h3>Trà chanh</h3>
          <div class="price">25.000đ</div>
        </div>

        <div class="product" data-name="p-6">
          <div class="product-image">
            <img src="images/trà ổi.jpg" alt="Trà ổi" loading="lazy" />
          </div>
          <h3>Trà ổi</h3>
          <div class="price">35.000đ</div>
        </div>

        <div class="product" data-name="p-7">
          <div class="product-image">
            <img src="images/trà xanh matcha.jpg" alt="Trà xanh matcha" loading="lazy" />
          </div>
          <h3>Trà xanh matcha</h3>
          <div class="price">35.000đ</div>
        </div>

        <div class="product" data-name="p-8">
          <div class="product-image">
            <img src="images/trà bạc hà.jpg" alt="Trà bạc hà" loading="lazy" />
          </div>
          <h3>Trà bạc hà</h3>
          <div class="price">32.000đ</div>
        </div>

        <div class="product" data-name="p-9">
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
        <div class="product" data-name="p-10">
          <div class="product-image">
            <img src="images/bánh matcha.jpg" alt="Matcha" loading="lazy" />
          </div>
          <h3>Matcha</h3>
          <div class="price">45.000đ</div>
        </div>

        <div class="product" data-name="p-11">
          <div class="product-image">
            <img src="images/bánh socola.jpg" alt="Chocolate" loading="lazy" />
          </div>
          <h3>Chocolate</h3>
          <div class="price">45.000đ</div>
        </div>

        <div class="product" data-name="p-12">
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
        <div class="product" data-name="p-13">
          <div class="product-image">
            <img src="images/cafe bạc hà.jpg" alt="Cafe Bạc Hà" loading="lazy" />
          </div>
          <h3>Cafe Bạc Hà</h3>
          <div class="price">28.000đ</div>
        </div>

        <div class="product" data-name="p-14">
          <div class="product-image">
            <img src="images/matcha latte.jpg" alt="Matcha Latte" loading="lazy" />
          </div>
          <h3>Matcha Latte</h3>
          <div class="price">38.000đ</div>
        </div>

        <div class="product" data-name="p-15">
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
</body>
