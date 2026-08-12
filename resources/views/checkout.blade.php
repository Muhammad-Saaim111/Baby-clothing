@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="checkout-page-container">
    <div class="checkout-container">
        <!-- Main Form Column (Left) -->
        <div class="checkout-left-col">
            <div class="checkout-header-logo">
                <a href="/" class="logo-text">AI<span>MÉE</span></a>
            </div>

            <!-- Breadcrumbs -->
            <div class="checkout-breadcrumbs">
                <a href="/">Home</a> <i class="fa-solid fa-chevron-right"></i>
                <a href="#" onclick="openCartDrawer(); return false;">Cart</a> <i class="fa-solid fa-chevron-right"></i>
                <span class="active">Information</span>
            </div>

            <form id="checkoutForm" onsubmit="handleCheckoutSubmit(event)">
                <!-- Contact Information -->
                <div class="checkout-section">
                    <div class="section-header">
                        <h3>Contact</h3>
                        <p class="login-prompt">Already have an account? <a href="#">Log in</a></p>
                    </div>
                    <div class="form-group">
                        <input type="email" id="checkoutEmail" placeholder="Email address" required class="checkout-input">
                    </div>
                    <div class="form-checkbox">
                        <input type="checkbox" id="emailOffers" checked>
                        <label for="emailOffers">Email me with news and offers</label>
                    </div>
                </div>

                <!-- Delivery Details -->
                <div class="checkout-section">
                    <h3>Delivery</h3>
                    <div class="form-group">
                        <select id="checkoutCountry" class="checkout-input" required>
                            <option value="PK" selected>Pakistan</option>
                        </select>
                    </div>
                    <div class="form-row-2">
                        <div class="form-group">
                            <input type="text" id="checkoutFirstName" placeholder="First name" required class="checkout-input">
                        </div>
                        <div class="form-group">
                            <input type="text" id="checkoutLastName" placeholder="Last name" required class="checkout-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" id="checkoutAddress" placeholder="Address" required class="checkout-input">
                    </div>
                    <div class="form-group">
                        <input type="text" id="checkoutApartment" placeholder="Apartment, suite, etc. (optional)" class="checkout-input">
                    </div>
                    <div class="form-row-2">
                        <div class="form-group">
                            <input type="text" id="checkoutCity" placeholder="City" required class="checkout-input">
                        </div>
                        <div class="form-group">
                            <input type="text" id="checkoutPostal" placeholder="Postal code (optional)" class="checkout-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="checkoutPhone" placeholder="Phone" required class="checkout-input" pattern="[0-9]{10,12}">
                        <span class="input-helper">Please enter a valid phone number (e.g. 03001234567)</span>
                    </div>
                    <div class="form-checkbox">
                        <input type="checkbox" id="saveInfo">
                        <label for="saveInfo">Save this information for next time</label>
                    </div>
                </div>

                <!-- Shipping Method -->
                <div class="checkout-section">
                    <h3>Shipping method</h3>
                    <div class="shipping-method-box">
                        <div class="sm-details">
                            <input type="radio" checked id="standardShipping" name="shipping">
                            <label for="standardShipping" class="sm-label">
                                <span class="sm-title">Standard Shipping (Cash on Delivery)</span>
                                <span class="sm-sub">2 to 5 business days delivery</span>
                            </label>
                        </div>
                        <span class="sm-price" id="shippingMethodPrice">Rs. 150.00</span>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="checkout-section">
                    <h3>Payment</h3>
                    <p class="section-subtitle">All transactions are secure and encrypted.</p>
                    
                    <div class="payment-method-box active" id="pmBoxCOD">
                        <div class="pm-header" style="cursor: pointer;" onclick="togglePaymentSelection('COD')">
                            <input type="radio" checked id="codPayment" name="payment" value="COD">
                            <label for="codPayment" class="pm-label" style="cursor: pointer;">Cash on Delivery (COD)</label>
                        </div>
                        <div class="pm-body" id="pmBodyCOD">
                            <i class="fa-solid fa-truck-ramp-box pm-icon"></i>
                            <p>Pay cash when the order is delivered to your doorstep. Make sure to have the exact amount ready upon delivery.</p>
                        </div>
                    </div>

                    <div class="payment-method-box" id="pmBoxEP" style="margin-top: 15px;">
                        <div class="pm-header" style="cursor: pointer;" onclick="togglePaymentSelection('Easypaisa')">
                            <input type="radio" id="epPayment" name="payment" value="Easypaisa">
                            <label for="epPayment" class="pm-label" style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                <span>Easypaisa Mobile Wallet</span>
                                <span style="background: #3fb54f; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.65rem; font-weight: 700; text-transform: uppercase;">easy<span style="font-weight: 400;">paisa</span></span>
                            </label>
                        </div>
                        <div class="pm-body" id="pmBodyEP" style="display: none;">
                            <i class="fa-solid fa-mobile-screen-button pm-icon" style="color: #3fb54f;"></i>
                            <p>You will be redirected to the secure Easypaisa payment gateway to complete your transaction using your Mobile Wallet.</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="checkout-actions">
                    <button type="submit" class="complete-order-btn">Complete order</button>
                    <a href="/" class="return-link"><i class="fa-solid fa-chevron-left"></i> Return to shop</a>
                </div>
            </form>
        </div>

        <!-- Order Summary Column (Right) -->
        <div class="checkout-right-col">
            <div id="checkoutSummaryItems">
                <!-- Dynamically populated -->
            </div>

            <!-- Coupon Code Section -->
            <div class="checkout-coupon-section">
                <input type="text" id="checkoutCouponInput" placeholder="Discount code or gift card" class="checkout-input" style="text-transform:uppercase;">
                <button type="button" id="applyCouponBtn" onclick="applyCheckoutCoupon()" class="coupon-apply-btn">Apply</button>
            </div>
            <div id="couponMessage" class="coupon-msg"></div>

            <!-- Cost Summary -->
            <div class="checkout-costs">
                <div class="cost-row">
                    <span>Subtotal</span>
                    <span id="checkoutSubtotal">Rs. 0.00</span>
                </div>
                <div class="cost-row" id="checkoutDiscountRow" style="display: none;">
                    <span>Discount (<span id="couponCodeDisplay"></span>)</span>
                    <span id="checkoutDiscountAmount" class="discount-highlight">-Rs. 0.00</span>
                </div>
                <div class="cost-row">
                    <span>Shipping</span>
                    <span id="checkoutShipping">Rs. 150.00</span>
                </div>
                <div class="cost-row total-row">
                    <span>Total</span>
                    <span id="checkoutTotal">Rs. 0.00</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Success Modal Overlay -->
<div class="order-success-overlay" id="orderSuccessModal">
    <div class="order-success-content">
        <div class="success-icon-wrapper">
            <i class="fa-solid fa-check"></i>
        </div>
        <h2>Thank you for your order!</h2>
        <p class="success-desc">Your order has been placed successfully. A confirmation email has been sent to <strong id="successCustomerEmail"></strong>.</p>
        
        <div class="order-details-card">
            <div class="od-row">
                <span>Order ID:</span>
                <strong id="successOrderId">#AIM-839420</strong>
            </div>
            <div class="od-row">
                <span>Payment Method:</span>
                <span>Cash on Delivery (COD)</span>
            </div>
            <div class="od-row">
                <span>Total Amount:</span>
                <strong id="successTotalAmount">Rs. 0.00</strong>
            </div>
        </div>
        
        <button onclick="continueShoppingAfterOrder()" class="continue-shopping-btn">Continue shopping</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check for success redirect from Easypaisa
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('order_success') === '1') {
            document.getElementById('successCustomerEmail').textContent = urlParams.get('email');
            document.getElementById('successOrderId').textContent = '#' + urlParams.get('order_number');
            document.getElementById('successTotalAmount').textContent = `Rs. ${Number(urlParams.get('total')).toLocaleString()}.00`;

            document.getElementById('orderSuccessModal').classList.add('active');
            
            // Clear cart and update UI immediately
            localStorage.removeItem('aim_cart');
            localStorage.removeItem('aim_order_coupon');
            localStorage.removeItem('aim_order_instructions');
            if (typeof updateCartCount === 'function') updateCartCount();
            if (typeof renderCartDrawer === 'function') renderCartDrawer();
        }

        // Load cart items and calculate totals
        renderCheckoutSummary();

        // Prefill contact if saved previously
        const savedEmail = localStorage.getItem('aim_checkout_email');
        if (savedEmail) document.getElementById('checkoutEmail').value = savedEmail;
        
        const savedFirstName = localStorage.getItem('aim_checkout_firstname');
        if (savedFirstName) document.getElementById('checkoutFirstName').value = savedFirstName;

        const savedLastName = localStorage.getItem('aim_checkout_lastname');
        if (savedLastName) document.getElementById('checkoutLastName').value = savedLastName;

        const savedAddress = localStorage.getItem('aim_checkout_address');
        if (savedAddress) document.getElementById('checkoutAddress').value = savedAddress;

        const savedCity = localStorage.getItem('aim_checkout_city');
        if (savedCity) document.getElementById('checkoutCity').value = savedCity;

        const savedPhone = localStorage.getItem('aim_checkout_phone');
        if (savedPhone) document.getElementById('checkoutPhone').value = savedPhone;
        
        // Auto apply coupon if saved in localStorage
        const savedCoupon = localStorage.getItem('aim_order_coupon');
        if (savedCoupon) {
            document.getElementById('checkoutCouponInput').value = savedCoupon;
            applyCheckoutCoupon(true);
        }
    });

    let selectedPaymentMethod = 'COD';

    function togglePaymentSelection(method) {
        selectedPaymentMethod = method;
        const shippingTitleEl = document.querySelector('.sm-title');
        
        if (method === 'COD') {
            document.getElementById('codPayment').checked = true;
            document.getElementById('epPayment').checked = false;
            
            document.getElementById('pmBoxCOD').classList.add('active');
            document.getElementById('pmBoxEP').classList.remove('active');
            
            document.getElementById('pmBodyCOD').style.display = 'block';
            document.getElementById('pmBodyEP').style.display = 'none';
            
            if (shippingTitleEl) {
                shippingTitleEl.textContent = 'Standard Shipping (Cash on Delivery)';
            }
        } else {
            document.getElementById('codPayment').checked = false;
            document.getElementById('epPayment').checked = true;
            
            document.getElementById('pmBoxCOD').classList.remove('active');
            document.getElementById('pmBoxEP').classList.add('active');
            
            document.getElementById('pmBodyCOD').style.display = 'none';
            document.getElementById('pmBodyEP').style.display = 'block';
            
            if (shippingTitleEl) {
                shippingTitleEl.textContent = 'Standard Shipping (Prepaid)';
            }
        }
    }

    function getCart() {
        try {
            return JSON.parse(localStorage.getItem('aim_cart')) || [];
        } catch(e) {
            return [];
        }
    }

    let checkoutSubtotal = 0;
    let checkoutDiscount = 0;
    let checkoutShipping = 150;
    let activeCoupon = null;
    let activeCouponDiscount = 0;

    function renderCheckoutSummary() {
        const cart = getCart();
        const container = document.getElementById('checkoutSummaryItems');
        
        if (cart.length === 0) {
            container.innerHTML = `
                <div class="empty-checkout-state">
                    <i class="fa-solid fa-basket-shopping empty-icon"></i>
                    <p>Your shopping basket is empty.</p>
                    <a href="/" class="continue-shopping-btn">Return to Shop</a>
                </div>
            `;
            // Disable complete button
            const btn = document.querySelector('.complete-order-btn');
            if (btn) btn.disabled = true;
            return;
        }

        container.innerHTML = '';
        checkoutSubtotal = 0;

        cart.forEach(item => {
            const price = Number(item.price) || 0;
            const itemTotal = price * (Number(item.quantity) || 1);
            checkoutSubtotal += itemTotal;

            const itemDiv = document.createElement('div');
            itemDiv.className = 'checkout-summary-item';
            itemDiv.innerHTML = `
                <div class="summary-img-wrapper">
                    <img src="${item.image}" alt="${item.name}">
                    <span class="summary-qty-badge">${item.quantity}</span>
                </div>
                <div class="summary-details">
                    <h4>${item.name}</h4>
                    <p>Size: ${item.size}</p>
                </div>
                <span class="summary-price">Rs. ${itemTotal.toLocaleString()}.00</span>
            `;
            container.appendChild(itemDiv);
        });

        // Calculate Shipping: Free on orders over Rs. 2,000
        if (checkoutSubtotal >= 2000) {
            checkoutShipping = 0;
            document.getElementById('shippingMethodPrice').textContent = 'Free';
            document.getElementById('checkoutShipping').textContent = 'Free';
        } else {
            checkoutShipping = 150;
            document.getElementById('shippingMethodPrice').textContent = 'Rs. 150.00';
            document.getElementById('checkoutShipping').textContent = 'Rs. 150.00';
        }

        recalculateTotals();
    }

    function recalculateTotals() {
        document.getElementById('checkoutSubtotal').textContent = `Rs. ${checkoutSubtotal.toLocaleString()}.00`;
        
        // Apply coupon discount from real API response
        if (activeCoupon && activeCouponDiscount > 0) {
            checkoutDiscount = activeCouponDiscount;
            document.getElementById('checkoutDiscountRow').style.display = 'flex';
            document.getElementById('couponCodeDisplay').textContent = activeCoupon;
            document.getElementById('checkoutDiscountAmount').textContent = `-Rs. ${checkoutDiscount.toLocaleString()}.00`;
        } else {
            checkoutDiscount = 0;
            document.getElementById('checkoutDiscountRow').style.display = 'none';
        }

        const grandTotal = checkoutSubtotal - checkoutDiscount + checkoutShipping;
        document.getElementById('checkoutTotal').textContent = `Rs. ${grandTotal.toLocaleString()}.00`;
    }

    function applyCheckoutCoupon(isAuto = false) {
        const input  = document.getElementById('checkoutCouponInput');
        const code   = input.value.trim().toUpperCase();
        const msgEl  = document.getElementById('couponMessage');
        const applyBtn = document.getElementById('applyCouponBtn');

        if (!code) {
            if (!isAuto) {
                msgEl.textContent = 'Please enter a coupon code.';
                msgEl.className = 'coupon-msg error';
            }
            return;
        }

        if (applyBtn) { applyBtn.disabled = true; applyBtn.textContent = 'Checking…'; }

        fetch('/coupon/apply', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ code: code, subtotal: checkoutSubtotal })
        })
        .then(async res => {
            const data = await res.json();
            if (data.success) {
                activeCoupon = data.code;
                activeCouponDiscount = data.discount;
                localStorage.setItem('aim_order_coupon', data.code);
                msgEl.textContent = data.message;
                msgEl.className = 'coupon-msg success';
                recalculateTotals();
            } else {
                activeCoupon = null;
                activeCouponDiscount = 0;
                localStorage.removeItem('aim_order_coupon');
                msgEl.textContent = data.message;
                msgEl.className = 'coupon-msg error';
                recalculateTotals();
            }
        })
        .catch(() => {
            msgEl.textContent = 'Could not connect. Please try again.';
            msgEl.className = 'coupon-msg error';
        })
        .finally(() => {
            if (applyBtn) { applyBtn.disabled = false; applyBtn.textContent = 'Apply'; }
        });
    }

    function handleCheckoutSubmit(e) {
        e.preventDefault();
        
        const submitBtn = e.target.querySelector('.complete-order-btn');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Processing order...';
        
        const email = document.getElementById('checkoutEmail').value;
        const firstName = document.getElementById('checkoutFirstName').value;
        const lastName = document.getElementById('checkoutLastName').value;
        const address = document.getElementById('checkoutAddress').value;
        const apartment = document.getElementById('checkoutApartment') ? document.getElementById('checkoutApartment').value : '';
        const city = document.getElementById('checkoutCity').value;
        const postalCode = document.getElementById('checkoutPostal') ? document.getElementById('checkoutPostal').value : '';
        const phone = document.getElementById('checkoutPhone').value;
        const saveInfo = document.getElementById('saveInfo').checked;

        if (saveInfo) {
            localStorage.setItem('aim_checkout_email', email);
            localStorage.setItem('aim_checkout_firstname', firstName);
            localStorage.setItem('aim_checkout_lastname', lastName);
            localStorage.setItem('aim_checkout_address', address);
            localStorage.setItem('aim_checkout_city', city);
            localStorage.setItem('aim_checkout_phone', phone);
        }

        // Get additional order data
        const specialInstructions = localStorage.getItem('aim_order_instructions') || '';
        const couponCode = activeCoupon || '';
        const items = getCart();

        const payload = {
            email,
            first_name: firstName,
            last_name: lastName,
            address,
            apartment,
            city,
            postal_code: postalCode,
            phone,
            payment_method: selectedPaymentMethod,
            subtotal: checkoutSubtotal,
            discount: checkoutDiscount,
            shipping: checkoutShipping,
            total: checkoutSubtotal - checkoutDiscount + checkoutShipping,
            coupon_code: couponCode,
            special_instructions: specialInstructions,
            items: items.map(item => ({
                id: String(item.id),
                name: item.name,
                price: Number(item.price),
                quantity: Number(item.quantity),
                size: item.size
            }))
        };

        fetch('/checkout/place', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        .then(async response => {
            const data = await response.json();
            if (response.ok && data.success) {
                if (data.redirect_url) {
                    // Redirect user to Easypaisa mock checkout portal
                    window.location.href = data.redirect_url;
                    return;
                }

                // Trigger Success Modal
                document.getElementById('successCustomerEmail').textContent = email;
                document.getElementById('successOrderId').textContent = '#' + data.order_number;
                document.getElementById('successTotalAmount').textContent = `Rs. ${Number(data.total).toLocaleString()}.00`;

                document.getElementById('orderSuccessModal').classList.add('active');

                // Clear cart and update UI immediately
                localStorage.removeItem('aim_cart');
                localStorage.removeItem('aim_order_coupon');
                localStorage.removeItem('aim_order_instructions');
                if (typeof updateCartCount === 'function') updateCartCount();
                if (typeof renderCartDrawer === 'function') renderCartDrawer();
            } else {
                // Show errors
                if (data.errors) {
                    const errorMsgs = Object.values(data.errors).flat().join('\n');
                    alert(data.message + '\n' + errorMsgs);
                } else {
                    alert(data.message || 'Something went wrong. Please check your inputs.');
                }
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        })
        .catch(err => {
            console.error(err);
            alert('A connection error occurred. Please check your internet connection and try again.');
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        });
    }

    function continueShoppingAfterOrder() {
        // Clear cart
        localStorage.removeItem('aim_cart');
        localStorage.removeItem('aim_order_coupon');
        localStorage.removeItem('aim_order_instructions');
        if (typeof updateCartCount === 'function') updateCartCount();
        if (typeof renderCartDrawer === 'function') renderCartDrawer();
        
        // Redirect to homepage
        window.location.href = '/';
    }
</script>
@endsection
