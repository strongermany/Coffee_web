<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt hàng thành công</title>
    <style>
        .order-success {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 28px;
            text-align: center;
        }
        .order-success h2 {
            color: #2e7d32;
            margin-bottom: 18px;
        }
        .order-info {
            text-align: left;
            margin: 0 auto 18px auto;
            background: #f8f8f8;
            border-radius: 8px;
            padding: 18px 20px;
            font-size: 1.08em;
        }
        .order-info strong {
            color: #d32f2f;
        }
        .order-success .btn {
            display: inline-block;
            margin-top: 18px;
            background: linear-gradient(90deg,#d32f2f 60%,#8B0000 100%);
            color: #fff;
            font-weight: 700;
            font-size: 1.1em;
            padding: 12px 32px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="order-success">
    <h2>Đặt hàng thành công!</h2>
    <?php if (!empty($order)): ?>
    <div class="order-info">
        <p><strong>Mã đơn hàng:</strong> <?php echo htmlspecialchars($order['order_id']); ?></p>
        <p><strong>Tổng tiền:</strong> <?php echo number_format($order['total_amount'], 0, ',', '.'); ?> đ</p>
        <p><strong>Ngày đặt:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
        <p><strong>Trạng thái:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
        <p><strong>Địa chỉ giao hàng:</strong> <?php echo htmlspecialchars($order['shipping_address']); ?></p>
        <?php if (!empty($order['note'])): ?>
            <p><strong>Ghi chú:</strong> <?php echo htmlspecialchars($order['note']); ?></p>
        <?php endif; ?>
    </div>
    <?php else: ?>
        <p>Không tìm thấy thông tin đơn hàng.</p>
    <?php endif; ?>
    <a href="<?php echo Base_URL; ?>" class="btn">Về trang chủ</a>
</div>
</body>
</html>
