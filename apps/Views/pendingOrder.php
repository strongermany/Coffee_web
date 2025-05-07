<div class="pending-container">
    <div class="loader"></div>
    <div class="pending-text">ĐANG TẢI...<br>Vui lòng chờ admin xác nhận đơn hàng của bạn.</div>
</div>
<script>
function checkOrderStatus() {
    fetch('<?php echo Base_URL; ?>CartController/checkOrderStatus')
        .then(res => res.json())
        .then(data => {
            if (data.status === 'paid') {
                window.location.href = '<?php echo Base_URL; ?>CartController/listOrder';
            } else {
                setTimeout(checkOrderStatus, 3000);
            }
        });
}
checkOrderStatus();
</script>
<style>
.pending-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 80vh;
    background: #0a1a2f;
}
.loader {
    border: 8px solid #1e3a5c;
    border-top: 8px solid #3ec6ff;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 1s linear infinite;
    margin-bottom: 24px;
}
@keyframes spin {
    0% { transform: rotate(0deg);}
    100% { transform: rotate(360deg);}
}
.pending-text {
    color: #fff;
    font-size: 1.5rem;
    text-align: center;
}
</style> 