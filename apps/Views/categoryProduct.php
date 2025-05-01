<?php
$category_name = isset($category_info) ? $category_info['Category'] : 'Tất cả sản phẩm';
?>

<div class="category-banner">
  <link rel="stylesheet" href="<?php echo Base_URL ?>public/css/footer.css" />
    <div class="container">
        <h1 class="text-center mb-4 animate__animated animate__fadeInDown"><?php echo $category_name; ?></h1>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <?php if(isset($products) && is_array($products)): ?>
            <?php foreach($products as $product): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="product-card animate__animated animate__fadeInUp">
                        <div class="product-image">
                            <img src="<?php echo Base_URL; ?>public/uploads/product/<?php echo $product['Images_product']; ?>" 
                                 alt="<?php echo $product['Title_product']; ?>" 
                                 class="img-fluid">
                            <div class="product-overlay">
                                <a href="<?php echo Base_URL; ?>index/detailsProduct/<?php echo $product['Id_product']; ?>" 
                                   class="btn btn-outline-light btn-sm">
                                    Xem chi tiết
                                </a>
                                <div class="d-flex align-items-center" style="gap: 8px;">
                                    <input type="number" min="1" value="1" class="form-control form-control-sm qty-input" style="width:60px;">
                                    <button class="btn btn-primary btn-sm add-to-cart" 
                                            data-product-id="<?php echo $product['Id_product']; ?>">
                                        Thêm vào giỏ
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">
                                <?php echo $product['Title_product']; ?>
                            </h3>
                            <div class="product-price">
                                <?php echo number_format($product['Price_product'], 0, ',', '.'); ?>đ
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>Không có sản phẩm nào trong danh mục này.</p>
            </div>
        <?php endif; ?>
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
    // Xử lý thêm vào giỏ hàng
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            // Lấy số lượng từ input cùng hàng
            const qtyInput = this.closest('.d-flex').querySelector('.qty-input');
            const quantity = qtyInput ? parseInt(qtyInput.value) : 1;

            // Animation khi click
            this.innerHTML = '<i class="fas fa-check"></i> Đã thêm';
            this.classList.add('added');
            
            // Gọi API thêm vào giỏ hàng
            fetch(`${Base_URL}CartController/add/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.redirect) {
                    window.location.href = data.redirect;
                    return;
                }
                if(data.success) {
                    // Cập nhật số lượng giỏ hàng
                    const cartCount = document.querySelector('.cart-count');
                    if(cartCount) {
                        cartCount.textContent = data.cart_count;
                    }
                    // Hiển thị thông báo thành công
                    showNotification('Đã thêm sản phẩm vào giỏ hàng', 'success');
                } else {
                    // Hiển thị thông báo lỗi
                    showNotification(data.message || 'Có lỗi xảy ra', 'error');
                    // Reset button state
                    this.innerHTML = 'Thêm vào giỏ';
                    this.classList.remove('added');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Có lỗi xảy ra khi thêm vào giỏ hàng', 'error');
                // Reset button state
                this.innerHTML = 'Thêm vào giỏ';
                this.classList.remove('added');
            });
        });
    });

    // Hàm hiển thị thông báo
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        // Thêm style cho notification
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
        
        // Xóa notification sau 3 giây
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
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
});
</script>
