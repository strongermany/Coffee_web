<P>This is all Add orRder </P>

<?php if (!empty($data['orders'])) : ?>
    <h2>Danh sách đơn hàng</h2>
    <table border="1" cellpadding="8" style="width:100%;border-collapse:collapse;">
        <tr>
            <th>Mã đơn</th>
            <th>Khách hàng</th>
            <th>Số tiền</th>
            <th>Trạng thái</th>
            <th>Phương thức</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($data['orders'] as $order): ?>
            <tr>
                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                <td><?php echo htmlspecialchars($order['customer_id']); ?></td>
                <td><?php echo number_format($order['total_amount'] ?? $order['amount'], 0, ',', '.'); ?> đ</td>
                <td><?php echo htmlspecialchars($order['status']); ?></td>
                <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                <td>
                    <?php if ($order['payment_method'] === 'bank' && $order['status'] !== 'paid'): ?>
                        <form method="post" action="<?php echo Base_URL; ?>OrderController/confirmPaid" style="display:inline;">
                            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                            <button type="submit" onclick="return confirm('Xác nhận đã nhận tiền chuyển khoản cho đơn này?')">Xác nhận đã nhận tiền</button>
                        </form>
                    <?php elseif ($order['status'] !== 'paid'): ?>
                        <form method="post" action="<?php echo Base_URL; ?>OrderController/confirmPaid" style="display:inline;">
                            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                            <button type="submit" onclick="return confirm('Xác nhận đơn này đã thanh toán?')">Xác nhận đã thanh toán</button>
                        </form>
                    <?php else: ?>
                        <span style="color:green;font-weight:bold;">Đã thanh toán</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Chưa có đơn hàng nào.</p>
<?php endif; ?>

<form method="post" action="<?php echo Base_URL; ?>CartController/checkout">
    <!-- Các input thông tin khách hàng -->
    <input type="text" name="customer_name" required>
    <input type="text" name="customer_phone" required>
    <input type="email" name="customer_email" required>
    <input type="text" name="customer_address" required>
    <textarea name="note"></textarea>
    <!-- Chọn phương thức thanh toán -->
    <input type="radio" name="payment_method" value="cod" checked> COD
    <input type="radio" name="payment_method" value="bank"> Chuyển khoản
    <!-- ... -->
    <!-- Nút xác nhận nằm trong form -->
    <button type="submit">Xác nhận</button>
</form>