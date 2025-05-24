<?php if (!empty($data['orders'])) : ?>
<div class="order-container">
    <div class="order-header">
        <h2 class="order-title">Danh sách đơn hàng</h2>
    </div>

    <div class="order-table-wrapper">
        <table class="order-table">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Số tiền</th>
                    <th>Trạng thái</th>
                    <th>Phương thức</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['orders'] as $order): ?>
                <tr>
                    <td>
                        <span class="order-id">#<?php echo htmlspecialchars($order['order_id']); ?></span>
                    </td>
                    <td>
                        <div class="customer-info">
                            <span class="customer-name"><?php echo htmlspecialchars($order['customer_id']); ?></span>
                        </div>
                    </td>
                    <td>
                        <span
                            class="order-amount"><?php echo number_format($order['total_amount'] ?? $order['amount'], 0, ',', '.'); ?>
                            đ</span>
                    </td>
                    <td>
                        <span class="order-status status-<?php echo strtolower($order['status']); ?>">
                            <?php echo htmlspecialchars($order['status']); ?>
                        </span>
                    </td>
                    <td>
                        <span class="payment-method">
                            <?php echo htmlspecialchars($order['payment_method']); ?>
                        </span>
                    </td>
                    <td>
                        <div class="order-actions">
                            <?php if ($order['payment_method'] === 'bank' && $order['status'] !== 'paid'): ?>
                            <form method="post" action="<?php echo Base_URL; ?>OrderController/confirmPaid"
                                class="action-form">
                                <input type="hidden" name="order_id"
                                    value="<?php echo htmlspecialchars($order['order_id']); ?>">
                                <button type="submit" class="order-btn confirm-btn"
                                    onclick="return confirm('Xác nhận đã nhận tiền chuyển khoản cho đơn này?')">
                                    <i class="fas fa-check-circle"></i>
                                    Xác nhận
                                </button>
                            </form>
                            <?php elseif ($order['status'] !== 'paid'): ?>
                            <form method="post" action="<?php echo Base_URL; ?>OrderController/confirmPaid"
                                class="action-form">
                                <input type="hidden" name="order_id"
                                    value="<?php echo htmlspecialchars($order['order_id']); ?>">
                                <button type="submit" class="order-btn confirm-btn"
                                    onclick="return confirm('Xác nhận đơn này đã thanh toán?')">
                                    <i class="fas fa-check-circle"></i>
                                    Xác nhận
                                </button>
                            </form>
                            <?php else: ?>
                            <span class="status-badge paid">
                                <i class="fas fa-check-circle"></i>
                                Đã thanh toán
                            </span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
<div class="empty-state">
    <i class="fas fa-shopping-cart"></i>
    <p>Chưa có đơn hàng nào.</p>
</div>
<?php endif; ?>


<style>
/* Order Container Styles */
.order-container {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.order-title {
    font-size: 1.5rem;
    color: var(--primary-color);
    margin: 0;
}

/* Table Styles */
.order-table-wrapper {
    overflow-x: auto;
}

.order-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.order-table th {
    background: var(--light-bg);
    padding: 1rem;
    font-weight: 600;
    text-align: left;
    color: var(--primary-color);
    border-bottom: 2px solid var(--border-color);
}

.order-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
}

.order-table tr:hover {
    background: var(--light-bg);
}

/* Order Status Styles */
.order-status {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}

.status-pending {
    background: #fff3e0;
    color: #e65100;
}

.status-paid {
    background: #e8f5e9;
    color: #2e7d32;
}

.status-cancelled {
    background: #ffebee;
    color: #c62828;
}

/* Button Styles */
.order-btn {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.confirm-btn {
    background: var(--accent-color);
    color: white;
}

.confirm-btn:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
}

/* Form Styles */
.order-form-container {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.form-title {
    font-size: 1.3rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--text-color);
    font-weight: 500;
}

.form-control {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid var(--border-color);
    border-radius: 6px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(57, 73, 171, 0.15);
    outline: none;
}

/* Payment Methods */
.payment-methods {
    margin: 1.5rem 0;
}

.payment-method-label {
    display: block;
    margin-bottom: 1rem;
    font-weight: 500;
    color: var(--text-color);
}

.payment-options {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.payment-option {
    flex: 1;
    min-width: 200px;
    padding: 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-option:hover {
    border-color: var(--accent-color);
}

.payment-option input[type="radio"] {
    display: none;
}

.option-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.payment-option input[type="radio"]:checked+.option-label {
    color: var(--accent-color);
}

/* Submit Button */
.submit-btn {
    background: var(--accent-color);
    color: white;
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.submit-btn:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.empty-state i {
    font-size: 3rem;
    color: var(--border-color);
    margin-bottom: 1rem;
}

.empty-state p {
    color: var(--text-color);
    font-size: 1.1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .order-header {
        flex-direction: column;
        align-items: stretch;
    }

    .order-filters {
        display: flex;
        gap: 0.5rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }

    .order-filter {
        white-space: nowrap;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }

    .payment-options {
        flex-direction: column;
    }
}
</style>