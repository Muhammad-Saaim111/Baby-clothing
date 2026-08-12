@extends('layouts.app')

@section('title', 'Your Shopping Cart')

@section('content')
<div class="cart-page-container">
    <div class="container main-cart-container">
        <!-- Header -->
        <h1 class="cart-page-title">Your Shopping Cart</h1>

        <!-- Free Shipping Progress Bar -->
        <div class="cart-progress-card">
            <div class="progress-message" id="cartProgressMsg">
                Spend Rs. 2,000 more for free shipping!
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar-fill" id="cartProgressBarFill" style="width: 0%;"></div>
            </div>
            <div class="progress-urgency-notice">
                <i class="fa-regular fa-clock"></i> We'll hold the items in your cart for <strong id="cartHoldTimer">10:00</strong> minutes!
            </div>
        </div>

        <!-- Main Cart Columns Grid -->
        <div class="cart-grid-layout" id="cartGridLayout">
            <!-- Left Column: Items Table List -->
            <div class="cart-left-col">
                <div class="cart-table-header">
                    <div class="th-product">Product</div>
                    <div class="th-price">Price</div>
                    <div class="th-quantity">Quantity</div>
                    <div class="th-total">Total</div>
                </div>

                <div id="cartPageItemsList">
                    <!-- Dynamically populated by JS -->
                </div>
            </div>

            <!-- Right Column: Sidebar Totals Summary -->
            <div class="cart-right-col">
                <!-- Special Instructions -->
                <div class="cart-summary-box">
                    <h3 class="box-title">Order Special Instructions <i class="fa-regular fa-clipboard"></i></h3>
                    <div class="box-content">
                        <p class="box-sub">Add special instructions for delivery or packaging:</p>
                        <textarea id="cartPageInstructions" class="cart-notes-textarea" placeholder="Order special instructions..." oninput="saveCartPageInstructions(this.value)"></textarea>
                    </div>
                </div>

                <!-- Shipping Estimator -->
                <div class="cart-summary-box">
                    <h3 class="box-title">Estimate Shipping <i class="fa-solid fa-truck-fast"></i></h3>
                    <div class="box-content">
                        <div class="form-group">
                            <select id="estimatorCountry" class="estimator-select">
                                <option value="PK" selected>Pakistan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="estimatorCity" class="estimator-select" onchange="estimateShippingRate()">
                                <option value="" disabled selected>Select City</option>
                                <option value="LHR">Lahore</option>
                                <option value="KHI">Karachi</option>
                                <option value="ISB">Islamabad</option>
                                <option value="RWP">Rawalpindi</option>
                                <option value="FSD">Faisalabad</option>
                                <option value="MUX">Multan</option>
                                <option value="PEW">Peshawar</option>
                                <option value="OTH">Other City</option>
                            </select>
                        </div>
                        <div id="estimatorResult" class="estimator-result-msg" style="display: none;"></div>
                    </div>
                </div>

                <!-- Coupon Section -->
                <div class="cart-summary-box">
                    <h3 class="box-title">Discount Code <i class="fa-solid fa-tag"></i></h3>
                    <div class="box-content">
                        <div class="cart-coupon-input-group">
                            <input type="text" id="cartPageCouponInput" placeholder="Discount code" class="cart-coupon-input">
                            <button type="button" onclick="applyCartPageCoupon()" class="cart-coupon-btn">Apply</button>
                        </div>
                        <div id="cartPageCouponMsg" class="coupon-msg"></div>
                    </div>
                </div>

                <!-- Grand Totals Box -->
                <div class="cart-totals-card">
                    <div class="totals-row">
                        <span>Subtotal</span>
                        <strong id="cartPageSubtotal">Rs. 0.00</strong>
                    </div>
                    <div class="totals-row" id="cartPageDiscountRow" style="display: none;">
                        <span>Discount (<span id="cartPageCouponCode"></span>)</span>
                        <strong id="cartPageDiscountAmount" class="discount-highlight">-Rs. 0.00</strong>
                    </div>
                    <div class="totals-row">
                        <span>Shipping</span>
                        <span id="cartPageShipping">Rs. 150.00</span>
                    </div>
                    <p class="totals-tax-disclaimer">Taxes and shipping calculated at checkout</p>
                    <div class="totals-row grand-total">
                        <span>Total</span>
                        <strong id="cartPageGrandTotal">Rs. 0.00</strong>
                    </div>

                    <a href="/checkout" class="cart-checkout-btn">PROCEED TO CHECKOUT</a>
                    <a href="/" class="cart-continue-link"><i class="fa-solid fa-arrow-left"></i> Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load cart items initially
        renderCartPage();

        // Start urgency timer
        startCartTimer();

        // Load saved order instructions
        const savedNotes = localStorage.getItem('aim_order_instructions');
        if (savedNotes) {
            document.getElementById('cartPageInstructions').value = savedNotes;
        }

        // Load saved coupon
        const savedCoupon = localStorage.getItem('aim_order_coupon');
        if (savedCoupon) {
            document.getElementById('cartPageCouponInput').value = savedCoupon;
            applyCartPageCoupon(true);
        }
    });

    // Urgency Timer Logic
    function startCartTimer() {
        let duration = 600; // 10 minutes
        const timerEl = document.getElementById('cartHoldTimer');
        
        const interval = setInterval(function() {
            let minutes = Math.floor(duration / 60);
            let seconds = duration % 60;
            
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            
            if (timerEl) timerEl.textContent = minutes + ':' + seconds;
            
            if (--duration < 0) {
                clearInterval(interval);
                if (timerEl) timerEl.textContent = "Expired! Re-add items";
            }
        }, 1000);
    }

    function getCart() {
        try {
            return JSON.parse(localStorage.getItem('aim_cart')) || [];
        } catch(e) {
            return [];
        }
    }

    function saveCart(cart) {
        localStorage.setItem('aim_cart', JSON.stringify(cart));
        // Update both page and header drawer layouts
        if (typeof updateCartCount === 'function') updateCartCount();
    }

    let cartPageSubtotalVal = 0;
    let cartPageDiscountVal = 0;
    let cartPageShippingVal = 150;
    let cartPageActiveCoupon = null;

    function renderCartPage() {
        const cart = getCart();
        const container = document.getElementById('cartPageItemsList');
        const gridLayout = document.getElementById('cartGridLayout');

        if (cart.length === 0) {
            // Render empty state
            document.querySelector('.main-cart-container').innerHTML = `
                <div class="cart-empty-page-state">
                    <div class="empty-icon-circle">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <h2>Your Shopping Cart is Empty</h2>
                    <p>Looks like you haven't added anything to your cart yet. Explore our adorable baby clothing collections and grab something special!</p>
                    <a href="/" class="return-shop-btn">Continue Shopping</a>
                </div>
            `;
            return;
        }

        container.innerHTML = '';
        cartPageSubtotalVal = 0;

        cart.forEach((item, index) => {
            const price = Number(item.price) || 0;
            const oldPrice = Number(item.oldPrice) || 0;
            const itemTotal = price * (Number(item.quantity) || 1);
            cartPageSubtotalVal += itemTotal;

            const oldPriceHtml = oldPrice > price ? `<span class="c-old-price">Rs. ${oldPrice.toLocaleString()}.00</span>` : '';

            const row = document.createElement('div');
            row.className = 'cart-table-row';
            row.innerHTML = `
                <div class="td-product">
                    <img src="${item.image}" alt="${item.name}">
                    <div class="c-product-info">
                        <h3>${item.name}</h3>
                        <p class="c-meta">Size: ${item.size}</p>
                        <div class="c-actions">
                            <button onclick="openEditModal(${index})" class="c-edit-link"><i class="fa-regular fa-pen-to-square"></i> Edit Option</button>
                        </div>
                    </div>
                </div>
                <div class="td-price">
                    ${oldPriceHtml}
                    <span class="c-new-price">Rs. ${price.toLocaleString()}.00</span>
                </div>
                <div class="td-quantity">
                    <div class="c-qty-controls">
                        <button onclick="updateCartPageQty(${index}, -1)">-</button>
                        <input type="number" value="${item.quantity}" readonly>
                        <button onclick="updateCartPageQty(${index}, 1)">+</button>
                    </div>
                    <button onclick="removeCartPageItem(${index})" class="c-delete-btn" title="Remove Item"><i class="fa-regular fa-trash-can"></i> Remove</button>
                </div>
                <div class="td-total">
                    Rs. ${itemTotal.toLocaleString()}.00
                </div>
            `;
            container.appendChild(row);
        });

        // Update Shipping progress bar (Rs. 2,000 threshold)
        const progressMsg = document.getElementById('cartProgressMsg');
        const progressBarFill = document.getElementById('cartProgressBarFill');
        
        if (cartPageSubtotalVal >= 2000) {
            progressMsg.innerHTML = `<i class="fa-solid fa-circle-check" style="color: #4CAF50;"></i> Congratulations! You've unlocked <strong>FREE SHIPPING</strong>!`;
            progressBarFill.style.width = '100%';
            progressBarFill.style.backgroundColor = '#4CAF50';
            cartPageShippingVal = 0;
            document.getElementById('cartPageShipping').textContent = 'Free';
        } else {
            const needed = 2000 - cartPageSubtotalVal;
            progressMsg.innerHTML = `Spend <strong>Rs. ${needed.toLocaleString()}.00</strong> more to unlock <strong>FREE SHIPPING</strong>!`;
            progressBarFill.style.width = (cartPageSubtotalVal / 2000 * 100) + '%';
            progressBarFill.style.backgroundColor = 'var(--primary-olive)';
            cartPageShippingVal = 150;
            document.getElementById('cartPageShipping').textContent = 'Rs. 150.00';
        }

        recalculateCartPageTotals();
    }

    function updateCartPageQty(index, change) {
        const cart = getCart();
        if (!cart[index]) return;

        const newQty = (Number(cart[index].quantity) || 1) + change;
        if (newQty >= 1) {
            cart[index].quantity = newQty;
            saveCart(cart);
            renderCartPage();
            if (typeof renderCartDrawer === 'function') renderCartDrawer();
        }
    }

    function removeCartPageItem(index) {
        const cart = getCart();
        if (!cart[index]) return;

        cart.splice(index, 1);
        saveCart(cart);
        renderCartPage();
        if (typeof renderCartDrawer === 'function') renderCartDrawer();
        if (typeof showToast === 'function') showToast('Removed', 'Item has been removed from your basket.');
    }

    function recalculateCartPageTotals() {
        document.getElementById('cartPageSubtotal').textContent = `Rs. ${cartPageSubtotalVal.toLocaleString()}.00`;

        if (cartPageActiveCoupon === 'WELCOME10' || cartPageActiveCoupon === 'SAVE10') {
            cartPageDiscountVal = Math.round(cartPageSubtotalVal * 0.1);
            document.getElementById('cartPageDiscountRow').style.display = 'flex';
            document.getElementById('cartPageCouponCode').textContent = cartPageActiveCoupon;
            document.getElementById('cartPageDiscountAmount').textContent = `-Rs. ${cartPageDiscountVal.toLocaleString()}.00`;
        } else {
            cartPageDiscountVal = 0;
            document.getElementById('cartPageDiscountRow').style.display = 'none';
        }

        const total = cartPageSubtotalVal - cartPageDiscountVal + cartPageShippingVal;
        document.getElementById('cartPageGrandTotal').textContent = `Rs. ${total.toLocaleString()}.00`;
    }

    function applyCartPageCoupon(isAuto = false) {
        const input = document.getElementById('cartPageCouponInput');
        const code = input.value.trim().toUpperCase();
        const msgEl = document.getElementById('cartPageCouponMsg');

        if (!code) {
            if (!isAuto) {
                msgEl.textContent = 'Please enter a coupon code.';
                msgEl.className = 'coupon-msg error';
            }
            return;
        }

        if (code === 'WELCOME10' || code === 'SAVE10') {
            cartPageActiveCoupon = code;
            localStorage.setItem('aim_order_coupon', code);
            msgEl.textContent = `Coupon "${code}" applied successfully! 10% discount added.`;
            msgEl.className = 'coupon-msg success';
            recalculateCartPageTotals();
        } else {
            cartPageActiveCoupon = null;
            msgEl.textContent = 'Invalid coupon code. Try WELCOME10 or SAVE10.';
            msgEl.className = 'coupon-msg error';
            recalculateCartPageTotals();
        }
    }

    function saveCartPageInstructions(val) {
        localStorage.setItem('aim_order_instructions', val);
    }

    function estimateShippingRate() {
        const city = document.getElementById('estimatorCity').value;
        const resultEl = document.getElementById('estimatorResult');

        if (!city) return;

        resultEl.style.display = 'block';
        resultEl.className = 'estimator-result-msg success';
        
        if (cartPageSubtotalVal >= 2000) {
            resultEl.innerHTML = `<i class="fa-solid fa-circle-check"></i> Shipping to <strong>${getCityName(city)}</strong>: <strong>FREE</strong> (Orders over Rs. 2,000)`;
        } else {
            resultEl.innerHTML = `<i class="fa-solid fa-circle-check"></i> Shipping to <strong>${getCityName(city)}</strong>: <strong>Rs. 150.00</strong> (Cash on Delivery)`;
        }
    }

    function getCityName(code) {
        const cities = {
            'LHR': 'Lahore',
            'KHI': 'Karachi',
            'ISB': 'Islamabad',
            'RWP': 'Rawalpindi',
            'FSD': 'Faisalabad',
            'MUX': 'Multan',
            'PEW': 'Peshawar',
            'OTH': 'Selected City'
        };
        return cities[code] || 'Selected City';
    }
</script>
@endsection
