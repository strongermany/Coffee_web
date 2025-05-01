// Cart functionality
document.addEventListener('DOMContentLoaded', function() {
    // Update cart count badge
    function updateCartBadge() {
        const cartBadge = document.querySelector('.cart-count');
        if (cartBadge) {
            cartBadge.textContent = sessionStorage.getItem('cart_count') || '0';
        }
    }

    // Add to cart
    function addToCart(productId, quantity = 1) {
        fetch(`${BASE_URL}cartController/addToCart`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}&quantity=${quantity}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartBadge();
                showNotification('Product added to cart successfully!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error adding product to cart', 'error');
        });
    }

    // Update quantity
    function updateQuantity(productId, quantity) {
        fetch(`${BASE_URL}cartController/updateQuantity`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}&quantity=${quantity}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartBadge();
                updateTotalPrice();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error updating quantity', 'error');
        });
    }

    // Remove from cart
    function removeFromCart(productId) {
        fetch(`${BASE_URL}cartController/removeFromCart`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartBadge();
                // Remove the item from the cart table
                const row = document.querySelector(`tr[data-product-id="${productId}"]`);
                if (row) {
                    row.remove();
                }
                updateTotalPrice();
                showNotification('Product removed from cart');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error removing product from cart', 'error');
        });
    }

    // Update total price
    function updateTotalPrice() {
        const items = document.querySelectorAll('.item-total');
        let total = 0;
        items.forEach(item => {
            total += parseFloat(item.dataset.price) * parseInt(item.closest('tr').querySelector('.inputsoluong').value);
        });
        document.querySelector('.total-price').textContent = `${total.toLocaleString()} đ`;
    }

    // Show notification
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Event listeners
    document.addEventListener('click', function(e) {
        // Add to cart button
        if (e.target.matches('.add-to-cart')) {
            const productId = e.target.dataset.productId;
            const quantity = e.target.closest('.product').querySelector('.qty')?.value || 1;
            addToCart(productId, quantity);
        }
        
        // Remove from cart button
        if (e.target.matches('.btn_df')) {
            const productId = e.target.closest('tr').dataset.productId;
            removeFromCart(productId);
        }
    });

    // Quantity input change
    document.addEventListener('change', function(e) {
        if (e.target.matches('.inputsoluong')) {
            const productId = e.target.closest('tr').dataset.productId;
            const quantity = e.target.value;
            updateQuantity(productId, quantity);
        }
    });

    // Initialize cart badge
    updateCartBadge();
}); 