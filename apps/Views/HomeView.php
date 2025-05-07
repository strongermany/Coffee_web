<body>
  <div class="home-main-bg">
    <!-- Sản phẩm nổi bật -->
    <section class="section-products">
      <h2 class="section-title">GIAN HÀNG SẢN PHẨM VỀ CAFE</h2>
      <hr class="section-divider" />
      <div class="product-grid">
        <?php if (!empty($products)): ?>
          <?php foreach ($products as $product): ?>
            <div class="product-card">
              <img src="<?php echo Base_URL . 'public/uploads/product/' . $product['Images_product']; ?>" alt="<?php echo $product['Title_product']; ?>">
              <h3><?php echo $product['Title_product']; ?></h3>
              <div class="price"><?php echo number_format($product['Price_product'], 0, ',', '.'); ?>đ</div>
            </div>
          <?php endforeach; ?>
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
</body>