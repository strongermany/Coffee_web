<link rel="stylesheet" href="<?php echo Base_URL ?>public/css/cart1.css" />
<script>var Base_URL = "<?php echo Base_URL; ?>";</script>
<section>
  <div class="cart-page-body">
    <div class="bg_in">
      <div class="content_page cart_page">
         <div class="breadcrumbs">
            <ol>
               <li><a href="<?php echo Base_URL; ?>">Trang chủ</a></li>
               <li><strong>Thanh toán</strong></li>
            </ol>
         </div>
         <div class="box-title">
            <div class="title-bar">
               <h1>Thanh toán đơn hàng</h1>
            </div>
         </div>
         <div class="content_text">
            <div class="container_table">
               <table class="table">
                  <thead>
                     <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($cartItems)): ?>
                      <?php foreach ($cartItems as $item): ?>
                        <tr>
                           <td>
                              <img src="<?php echo Base_URL; ?>public/uploads/product/<?php echo $item['product']['Images_product']; ?>" alt="<?php echo $item['product']['Title_product']; ?>" class="img-responsive" style="width:60px;height:60px;object-fit:cover;" />
                           </td>
                           <td><?php echo $item['product']['Title_product']; ?></td>
                           <td><span class="color_red font_money"><?php echo number_format($item['product']['Price_product'], 0, ',', '.'); ?> đ</span></td>
                           <td>
                              <input type="number" class="inputsoluong" name="qty[<?php echo $item['product']['Id_product']; ?>]" value="<?php echo $item['quantity']; ?>" min="1" data-price="<?php echo $item['product']['Price_product']; ?>">
                           </td>
                           <td class="text_center"><span class="color_red font_money item-total"><?php echo number_format($item['subtotal'], 0, ',', '.'); ?> đ</span></td>
                           <td class="actions">
                              <button class="btn_df btn-sm remove-from-cart" data-product-id="<?php echo $item['product']['Id_product']; ?>">Xóa</button>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                        <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống.</td>
                      </tr>
                  <?php endif; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="6" class="textright_text">
                        <div class="sum_price_all">
                          <span class="text_price">Tổng tiền thanh toán</span>:
                          <span class="text_price color_red total-price"><?php echo number_format($total, 0, ',', '.'); ?> đ</span>
                        </div>
                      </td>
                    </tr>
                  </tfoot>
               </table>
            </div>
            <div class="contact_form">
               <div class="contact_left">
                  <div class="ch-contacts-details">
                     <ul class="contact-list">
                        <li class="addr">
                           <strong class="title">Thông tin liên hệ</strong>
                           <p>Hotline: 1800 1525</p>
                           <p>Email: support@hippocoffee.com.vn</p>
                           <p>Giờ làm việc: 8:00 - 22:00</p>
                        </li>
                     </ul>
                     <div class="hiring-box">
                        <strong class="title">Chính sách thanh toán</strong>
                        <p>- Thanh toán khi nhận hàng (COD)</p>
                        <p>- Thanh toán qua ngân ngân hàng</p>
                        <p>- Thanh toán qua ví điện tử momo</p>
                     </div>
                  </div>
               </div>
               <div class="contact_right">
                  <div class="form_contact_in">
                     <div class="box_contact">
                        <form name="FormDatHang" id="order-form" method="post" action="<?php echo Base_URL; ?>CartController/checkout">
                           <div class="content-box_contact">
                              <div class="row">
                                 <div class="input">
                                    <label>Họ và tên: <span style="color:red;">*</span></label>
                                    <input type="text" name="customer_name" required class="clsip" placeholder="Nhập họ và tên" value="<?php echo isset($customerInfo['customer_name']) ? htmlspecialchars($customerInfo['customer_name']) : '' ?>">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="input">
                                    <label>Số điện thoại: <span style="color:red;">*</span></label>
                                    <input type="text" name="customer_phone" required class="clsip" placeholder="Nhập số điện thoại" value="<?php echo isset($customerInfo['phone']) ? htmlspecialchars($customerInfo['phone']) : '' ?>">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="input">
                                    <label>Địa chỉ: <span style="color:red;">*</span></label>
                                    <input type="text" name="customer_address" required class="clsip" placeholder="Nhập địa chỉ giao hàng" value="<?php echo isset($customerInfo['address']) ? htmlspecialchars($customerInfo['address']) : '' ?>">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="input">
                                    <label>Email: <span style="color:red;">*</span></label>
                                    <input type="email" name="customer_email" required class="clsip" placeholder="Nhập email" value="<?php echo isset($customerInfo['email']) ? htmlspecialchars($customerInfo['email']) : '' ?>">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="input">
                                    <label>Ghi chú:</label>
                                    <textarea name="note" class="clsipa" placeholder="Nhập ghi chú (nếu có)"><?php echo isset($customerInfo['note']) ? htmlspecialchars($customerInfo['note']) : '' ?></textarea>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="input">
                                    <input type="hidden" name="payment_method" id="payment_method" value="cod">
                                 </div>
                              </div>
                              <div class="row btnclass">
                                 <div class="input ipmaxn">
                                    <input type="submit" class="btn-gui" name="frmSubmit" value="Đặt hàng" id="btn-order">
                                    <input type="reset" class="btn-gui" value="Nhập lại">
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </div>
  </div>
</section>
<!-- Popup chọn phương thức thanh toán -->
<div id="payment-modal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.4);align-items:center;justify-content:center;">
  <div style="background:#fff;border-radius:12px;max-width:400px;width:90vw;padding:32px 24px;box-shadow:0 8px 32px rgba(0,0,0,0.15);position:relative;">
    <button id="close-modal" style="position:absolute;top:12px;right:16px;background:none;border:none;font-size:22px;cursor:pointer;">&times;</button>
    <h2 style="color:#d32f2f;text-align:center;margin-bottom:18px;font-size:1.3rem;">Chọn phương thức thanh toán</h2>
    <div style="display:flex;flex-direction:column;gap:16px;">
      <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:1.1em;">
        <input type="radio" name="payment-method" value="cod" checked> Thanh toán khi nhận hàng (COD)
      </label>
      <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:1.1em;">
        <input type="radio" name="payment-method" value="bank"> Chuyển khoản
      </label>
    </div>
    <div id="qr-section" style="display:none;margin-top:20px;text-align:center;">
      <div style="margin-bottom:12px;font-weight:600;">Quét mã để chuyển khoản:</div>
      <div style="display:flex;justify-content:center;gap:18px;">
        <div>
          <div style="font-size:0.95em;margin-bottom:4px;">Momo</div>
          <img src="<?php echo Base_URL ?>public/images/qr-momo.png" alt="QR Momo" class="qr-image">
        </div>
        <div>
          <div style="font-size:0.95em;margin-bottom:4px;">Ngân hàng</div>
          <img src="<?php echo Base_URL ?>public/images/qr-bank.png" alt="QR Ngân hàng" class="qr-image">
        </div>
      </div>
    </div>
    <button id="confirm-payment" style="margin-top:28px;width:100%;background:linear-gradient(90deg,#d32f2f 60%,#8B0000 100%);color:#fff;font-weight:700;font-size:1.1em;padding:12px 0;border:none;border-radius:8px;cursor:pointer;">Xác nhận</button>
  </div>
</div>
<script>
document.querySelectorAll('.inputsoluong').forEach(function(input) {
    input.addEventListener('input', function() {
        var price = parseInt(input.getAttribute('data-price'));
        var qty = parseInt(input.value) || 1;
        var total = price * qty;
        var totalStr = total.toLocaleString('vi-VN') + ' đ';
        var row = input.closest('tr');
        row.querySelector('.item-total').textContent = totalStr;
        var sum = 0;
        document.querySelectorAll('.inputsoluong').forEach(function(ip) {
            var p = parseInt(ip.getAttribute('data-price'));
            var q = parseInt(ip.value) || 1;
            sum += p * q;
        });
        document.querySelector('.total-price').textContent = sum.toLocaleString('vi-VN') + ' đ';
    });
});
// Hiển thị popup khi ấn Đặt hàng
const btnOrder = document.getElementById('btn-order');
const modal = document.getElementById('payment-modal');
const closeModal = document.getElementById('close-modal');
const qrSection = document.getElementById('qr-section');
const radios = document.getElementsByName('payment-method');
const confirmBtn = document.getElementById('confirm-payment');

btnOrder.addEventListener('click', function(e) {
  e.preventDefault();
  modal.style.display = 'flex';
});
closeModal.addEventListener('click', function() {
  modal.style.display = 'none';
});
radios.forEach(function(radio) {
  radio.addEventListener('change', function() {
    if (this.value === 'bank') {
      qrSection.style.display = 'block';
    } else {
      qrSection.style.display = 'none';
    }
  });
});
confirmBtn.addEventListener('click', function() {
  // Lấy phương thức thanh toán đã chọn
  let method = document.querySelector('input[name="payment-method"]:checked').value;
  document.getElementById('payment_method').value = method;
  modal.style.display = 'none';
  // Submit form đặt hàng
  document.getElementById('order-form').submit();
});
// Đóng popup khi click ra ngoài
modal.addEventListener('click', function(e) {
  if (e.target === modal) modal.style.display = 'none';
});
// Xóa sản phẩm khỏi giỏ hàng
const deleteBtns = document.querySelectorAll('.actions .btn_df');
deleteBtns.forEach(function(btn) {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    const row = btn.closest('tr');
    row.remove();
    // Cập nhật lại tổng tiền
    let sum = 0;
    document.querySelectorAll('.inputsoluong').forEach(function(ip) {
      if (ip.closest('tr')) { // chỉ tính các dòng còn lại
        var p = parseInt(ip.getAttribute('data-price'));
        var q = parseInt(ip.value) || 1;
        sum += p * q;
      }
    });
    document.querySelector('.total-price').textContent = sum.toLocaleString('vi-VN') + ' đ';
  });
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.remove-from-cart').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) return;
            fetch(`${Base_URL}CartController/remove`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `product_id=${productId}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Xóa dòng sản phẩm khỏi bảng
                    const row = this.closest('tr');
                    row.parentNode.removeChild(row);
                    // Cập nhật số lượng giỏ hàng trên header
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) cartCount.textContent = data.cart_count;
                    // Cập nhật lại tổng tiền
                    let sum = 0;
                    document.querySelectorAll('.item-total').forEach(function(span) {
                        sum += parseInt(span.textContent.replace(/\D/g, '')) || 0;
                    });
                    document.querySelector('.total-price').textContent = sum.toLocaleString('vi-VN') + ' đ';
                } else {
                    alert(data.message || 'Xóa sản phẩm thất bại!');
                }
            });
        });
    });
});
</script>