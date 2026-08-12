
        // Quick View Logic
        const qvModal = document.getElementById('quickViewModal');
        let qvCurrentPrice = 0;
        
        window.openQuickView = function(btn) {
            const title = btn.getAttribute('data-title');
            const price = parseInt(btn.getAttribute('data-price'));
            const oldPrice = btn.getAttribute('data-old-price') ? parseInt(btn.getAttribute('data-old-price')) : 0;
            const image = btn.getAttribute('data-image');
            const id = btn.getAttribute('data-id');
            const category = btn.getAttribute('data-category') || 'Apparel';
            
            // Dynamically get the product type from the title (e.g. "Sweatshirt" from "Grey Sweatshirt")
            const titleWords = title.split(' ');
            const productType = titleWords.length > 0 ? titleWords[titleWords.length - 1] : category;
            
            document.getElementById('qvTitle').textContent = title;
            document.getElementById('qvImage').src = image;
            document.getElementById('qvPrice').textContent = 'Rs.' + price.toLocaleString() + '.00';
            document.getElementById('qvCategory').textContent = productType;
            
            // Build Thumbnails
            let thumbHtml = '';
            
            // Front (Main) Thumbnail
            thumbHtml += `<img src="${image}" class="qv-thumb active" onclick="document.getElementById('qvImage').src='${image}'; document.querySelectorAll('.qv-thumbnails img').forEach(img => img.classList.remove('active')); this.classList.add('active');" alt="Front">`;
            
            // Check if we can infer back and lifestyle images
            if (image.includes('_front.jpg')) {
                const backImg = image.replace('_front.jpg', '_back.jpg');
                const lifeImg = image.replace('_front.jpg', '_lifestyle.jpg');
                
                thumbHtml += `<img src="${backImg}" class="qv-thumb" onclick="document.getElementById('qvImage').src='${backImg}'; document.querySelectorAll('.qv-thumbnails img').forEach(img => img.classList.remove('active')); this.classList.add('active');" onerror="this.style.display='none'" alt="Back">`;
                
                thumbHtml += `<img src="${lifeImg}" class="qv-thumb" onclick="document.getElementById('qvImage').src='${lifeImg}'; document.querySelectorAll('.qv-thumbnails img').forEach(img => img.classList.remove('active')); this.classList.add('active');" onerror="this.style.display='none'" alt="Lifestyle">`;
            }
            
            const thumbContainer = document.getElementById('qvThumbnails');
            if (thumbContainer) {
                thumbContainer.innerHTML = thumbHtml;
            }
            
            const oldPriceEl = document.getElementById('qvOldPrice');
            const discountEl = document.getElementById('qvDiscount');
            const badgeEl = document.getElementById('qvBadge');
            
            if (oldPrice > price) {
                oldPriceEl.textContent = 'Rs.' + oldPrice.toLocaleString() + '.00';
                oldPriceEl.style.display = 'inline';
                let discount = Math.round(((oldPrice - price) / oldPrice) * 100);
                discountEl.textContent = '(-' + discount + '%)';
                discountEl.style.display = 'inline-block';
                badgeEl.style.display = 'block';
            } else {
                oldPriceEl.style.display = 'none';
                discountEl.style.display = 'none';
                badgeEl.style.display = 'none';
            }
            
            qvCurrentPrice = price;
            document.getElementById('qvQtyInput').value = 1;
            updateQvSubtotal();
            
            document.getElementById('qvViewDetails').href = '/product/' + id;
            
            qvModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        };
        
        window.closeQuickView = function() {
            qvModal.classList.remove('active');
            document.body.style.overflow = '';
        };
        
        // Setup Quick View Size selection
        document.addEventListener('DOMContentLoaded', function() {
            const sizeBtns = document.querySelectorAll('.qv-size-btn');
            const selectedSizeLabel = document.getElementById('qvSelectedSize');
            
            sizeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    sizeBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    if (selectedSizeLabel) {
                        selectedSizeLabel.textContent = this.textContent;
                    }
                });
            });
        });
        
        window.incrementQvQty = function() {
            const input = document.getElementById('qvQtyInput');
            input.value = parseInt(input.value) + 1;
            updateQvSubtotal();
        };
        
        window.decrementQvQty = function() {
            const input = document.getElementById('qvQtyInput');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateQvSubtotal();
            }
        };
        
        function updateQvSubtotal() {
            const qty = parseInt(document.getElementById('qvQtyInput').value);
            document.getElementById('qvSubtotal').textContent = (qvCurrentPrice * qty).toLocaleString() + '.00';
        }

        // Edit Item Modal Logic
        let editingCartIndex = -1;
        let editingCurrentPrice = 0;

        window.openEditModal = function(index) {
            const cart = getCart();
            const item = cart[index];
            if (!item) return;

            editingCartIndex = index;
            editingCurrentPrice = item.price;

            document.getElementById('editTitle').textContent = item.name;
            document.getElementById('editVariant').textContent = item.size;
            document.getElementById('editSelectedSize').textContent = item.size;
            document.getElementById('editImage').src = item.image;
            document.getElementById('editPrice').textContent = 'Rs.' + item.price.toLocaleString() + '.00';
            
            if (item.oldPrice && item.oldPrice > item.price) {
                document.getElementById('editOldPrice').textContent = 'Rs.' + item.oldPrice.toLocaleString() + '.00';
                document.getElementById('editOldPrice').style.display = 'inline';
            } else {
                document.getElementById('editOldPrice').style.display = 'none';
            }

            document.getElementById('editQtyInput').value = item.quantity;
            
            // Generate some mock sizes
            const sizeGrid = document.getElementById('editSizeGrid');
            sizeGrid.innerHTML = '';
            const mockSizes = ['2Y To 3Y', '3Y To 4Y', '4Y To 5Y', '5Y To 6Y', '6Y To 7Y', '7Y To 8Y', '9Y To 10Y', '11Y To 12Y'];
            if (!mockSizes.includes(item.size)) mockSizes.unshift(item.size); // Ensure current size is there
            
            mockSizes.forEach(s => {
                const btn = document.createElement('button');
                btn.className = 'edit-size-btn';
                if (s === item.size) btn.classList.add('active');
                btn.textContent = s;
                btn.onclick = function() {
                    document.querySelectorAll('.edit-size-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    document.getElementById('editSelectedSize').textContent = s;
                };
                sizeGrid.appendChild(btn);
            });

            document.getElementById('editItemModal').classList.add('active');
            
            // Close quick view if open
            if(qvModal.classList.contains('active')) closeQuickView();
        };

        window.closeEditModal = function() {
            document.getElementById('editItemModal').classList.remove('active');
        };

        window.incrementEditQty = function() {
            const input = document.getElementById('editQtyInput');
            input.value = parseInt(input.value) + 1;
        };

        window.decrementEditQty = function() {
            const input = document.getElementById('editQtyInput');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        };

        window.updateCartItem = function() {
            if (editingCartIndex === -1) return;
            const cart = getCart();
            if (!cart[editingCartIndex]) return;

            const newSize = document.getElementById('editSelectedSize').textContent;
            const newQty = parseInt(document.getElementById('editQtyInput').value);

            cart[editingCartIndex].size = newSize;
            cart[editingCartIndex].quantity = newQty;

            localStorage.setItem('aim_cart', JSON.stringify(cart));
            closeEditModal();
            renderCartDrawer();
            showToast('Updated', 'Cart item has been updated.');
        };;
        
        window.updateQvSubtotal = function() {
            const qty = parseInt(document.getElementById('qvQtyInput').value);
            const subtotal = qty * qvCurrentPrice;
            document.getElementById('qvSubtotal').textContent = subtotal.toLocaleString() + '.00';
        };
        
        // Close modal when clicking outside
        qvModal.addEventListener('click', function(e) {
            if (e.target === qvModal) {
                closeQuickView();
            }
        });
        
        // Handle Quick View Add To Cart
        const qvAddToCartBtn = document.getElementById('qvAddToCartBtn');
        if (qvAddToCartBtn) {
            qvAddToCartBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = document.getElementById('qvViewDetails').href.split('/').pop();
                const title = document.getElementById('qvTitle').textContent;
                const price = qvCurrentPrice;
                const oldPriceText = document.getElementById('qvOldPrice').textContent;
                const oldPrice = oldPriceText ? parseInt(oldPriceText.replace(/[^\d]/g, '')) || null : null;
                const image = document.getElementById('qvImage').src;
                const qty = parseInt(document.getElementById('qvQtyInput').value) || 1;
                const sizeEl = document.getElementById('qvSelectedSize');
                const size = sizeEl ? sizeEl.textContent.trim() : 'Standard';
                
                addItemToCart(id, title, price, image, qty, size, oldPrice);
                closeQuickView();
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Select all major sections and static components (stagger-children is animated via parent's revealed class to avoid slider sliding bugs)
            const selector = 'section, .ms-grid, .category-showcase-grid, .product-detail-page, .main-catalog-container, .catalog-sidebar';
            const elements = document.querySelectorAll(selector);
            
            elements.forEach(el => {
                // Skip hero sections and stagger-children containers from direct reveal effect
                if (!el.classList.contains('hero-section') && !el.classList.contains('stagger-children')) {
                    el.classList.add('reveal-on-scroll');
                }
            });

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    } else {
                        // Remove revealed class when out of view to allow re-triggering animations
                        entry.target.classList.remove('revealed');
                    }
                });
            }, {
                threshold: 0.08, // Reveal when 8% is visible
                rootMargin: "0px 0px -60px 0px"
            });
            
            elements.forEach(el => {
                if (el.classList.contains('reveal-on-scroll')) {
                    observer.observe(el);
                }
            });

            // Mobile Menu Drawer Functionality
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const drawerCloseBtn = document.getElementById('drawerCloseBtn');
            const mobileDrawer = document.getElementById('mobileDrawer');
            const mobileDrawerOverlay = document.getElementById('mobileDrawerOverlay');
            
            if (mobileMenuBtn && mobileDrawer && mobileDrawerOverlay) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileDrawer.classList.add('active');
                    mobileDrawerOverlay.classList.add('active');
                    document.body.style.overflow = 'hidden'; // Prevent background scrolling
                });
                
                function closeDrawer() {
                    mobileDrawer.classList.remove('active');
                    mobileDrawerOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
                
                if (drawerCloseBtn) {
                    drawerCloseBtn.addEventListener('click', closeDrawer);
                }
                mobileDrawerOverlay.addEventListener('click', closeDrawer);
            }
            // Submenu Toggle inside Drawer
            const submenuToggleBtns = document.querySelectorAll('.submenu-toggle-btn');
            submenuToggleBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const parentLi = btn.closest('.drawer-has-submenu');
                    const submenu = parentLi.querySelector('.drawer-submenu');
                    if (submenu) {
                        submenu.classList.toggle('active');
                        btn.classList.toggle('active');
                    }
                });
            });

            // --- Cart Logic (Local Storage) ---
            
            // Create Toast elements
            const toastContainer = document.createElement('div');
            toastContainer.className = 'cart-toast';
            toastContainer.style.top = '90px';
            toastContainer.style.bottom = 'auto';
            toastContainer.innerHTML = `
                <div class="cart-toast-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                <div class="cart-toast-content">
                    <h5 class="cart-toast-title">Added to Cart</h5>
                    <p class="cart-toast-message"></p>
                </div>
            `;
            document.body.appendChild(toastContainer);

            function showToast(title, message) {
                toastContainer.querySelector('.cart-toast-title').textContent = title;
                toastContainer.querySelector('.cart-toast-message').textContent = message;
                toastContainer.classList.add('show');
                setTimeout(() => {
                    toastContainer.classList.remove('show');
                }, 3000);
            }

            // Load saved instructions when opening cart drawer
            document.addEventListener('DOMContentLoaded', function() {
                const savedInst = localStorage.getItem('aim_order_instructions');
                if (savedInst) {
                    const textarea = document.getElementById('sicTextarea');
                    if (textarea) textarea.value = savedInst;
                }
                
                const savedCoupon = localStorage.getItem('aim_order_coupon');
                if (savedCoupon) {
                    const input = document.getElementById('sicCouponInput');
                    if (input) input.value = savedCoupon;
                }
            });

            window.toggleSpecialInstructions = function() {
                const card = document.getElementById('specialInstructionsCard');
                const couponCard = document.getElementById('addCouponCard');
                if (couponCard.classList.contains('active')) couponCard.classList.remove('active');
                
                if (card.classList.contains('active')) {
                    card.classList.remove('active');
                } else {
                    card.classList.add('active');
                }
            };

            window.saveSpecialInstructions = function() {
                const text = document.getElementById('sicTextarea').value;
                localStorage.setItem('aim_order_instructions', text);
                toggleSpecialInstructions();
                showToast("Saved!", "Special instructions saved for your order.");
            };
            
            window.toggleAddCoupon = function() {
                const card = document.getElementById('addCouponCard');
                const instCard = document.getElementById('specialInstructionsCard');
                if (instCard.classList.contains('active')) instCard.classList.remove('active');
                
                if (card.classList.contains('active')) {
                    card.classList.remove('active');
                } else {
                    card.classList.add('active');
                }
            };
            
            window.saveCoupon = function() {
                const text = document.getElementById('sicCouponInput').value;
                localStorage.setItem('aim_order_coupon', text);
                toggleAddCoupon();
                showToast("Applied!", "Coupon code has been applied.");
            };

            function getCart() {
                try {
                    return JSON.parse(localStorage.getItem('aim_cart')) || [];
                } catch(e) {
                    return [];
                }
            }

            function saveCart(cart) {
                localStorage.setItem('aim_cart', JSON.stringify(cart));
                updateCartCount();
                if (typeof renderCartDrawer === 'function') {
                    renderCartDrawer();
                }
            }

            function updateCartCount() {
                const cart = getCart();
                const count = cart.reduce((total, item) => total + item.quantity, 0);
                const countBadge = document.querySelector('.cart-count');
                if (countBadge) {
                    countBadge.textContent = count;
                    // Mini bounce animation
                    countBadge.style.transform = 'scale(1.3)';
                    setTimeout(() => {
                        countBadge.style.transform = 'scale(1)';
                    }, 200);
                }
            }

            function addItemToCart(id, name, price, image, quantity = 1, size = 'Standard', oldPrice = null) {
                let cart = getCart();
                const existingIndex = cart.findIndex(item => item.id === id && item.size === size);
                
                if (existingIndex > -1) {
                    cart[existingIndex].quantity += quantity;
                } else {
                    cart.push({ id, name, price, image, quantity, size, oldPrice });
                }
                
                saveCart(cart);
                showToast("Added to Basket!", `${name} has been added.`);
                
                // Slide open the cart drawer automatically
                setTimeout(() => {
                    openCartDrawer();
                }, 300);
            }

            // --- Cart Drawer Logic ---
            const cartDrawer = document.getElementById('cartDrawer');
            const cartDrawerOverlay = document.getElementById('cartDrawerOverlay');

            window.openCartDrawer = function() {
                renderCartDrawer();
                cartDrawer.classList.add('active');
                cartDrawerOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            };

            window.closeCartDrawer = function() {
                cartDrawer.classList.remove('active');
                cartDrawerOverlay.classList.remove('active');
                document.body.style.overflow = '';
            };

            // Trigger cart drawer on header cart icon click
            const headerCartIcon = document.querySelector('.cart-icon');
            if (headerCartIcon) {
                headerCartIcon.addEventListener('click', function(e) {
                    e.preventDefault();
                    openCartDrawer();
                });
            }

            window.updateCartDrawerItemQty = function(id, size, change) {
                let cart = getCart();
                const index = cart.findIndex(item => item.id === id && item.size === size);
                if (index > -1) {
                    cart[index].quantity += change;
                    if (cart[index].quantity <= 0) {
                        cart.splice(index, 1);
                    }
                    saveCart(cart);
                    renderCartDrawer();
                }
            };

            window.removeCartDrawerItem = function(id, size) {
                let cart = getCart();
                const index = cart.findIndex(item => item.id === id && item.size === size);
                if (index > -1) {
                    cart.splice(index, 1);
                    saveCart(cart);
                    renderCartDrawer();
                }
            };

            window.renderCartDrawer = function() {
                const cart = getCart();
                const cartItemsContainer = document.getElementById('cartDrawerItems');
                const cartCountEl = document.getElementById('cartDrawerCount');
                const cartSubtotalEl = document.getElementById('cartDrawerSubtotal');
                const cartTotalEl = document.getElementById('cartDrawerTotal');
                
                // Shipping progress controls
                const shippingProgressText = document.getElementById('shippingProgressText');
                const shippingProgressBar = document.getElementById('shippingProgressBar');

                // Total items count
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartCountEl.textContent = `${totalItems} ${totalItems === 1 ? 'item' : 'items'}`;

                // Calculate subtotal
                const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                cartSubtotalEl.textContent = `Rs. ${subtotal.toLocaleString()}.00`;
                cartTotalEl.textContent = `Rs. ${subtotal.toLocaleString()}.00`;

                // Shipping progress threshold (Rs. 5,000)
                const freeShippingThreshold = 5000;
                if (subtotal >= freeShippingThreshold) {
                    shippingProgressText.textContent = "You qualify for free shipping!";
                    shippingProgressBar.style.width = "100%";
                    shippingProgressBar.classList.add('completed');
                } else {
                    const remaining = freeShippingThreshold - subtotal;
                    const percent = Math.min((subtotal / freeShippingThreshold) * 100, 100);
                    shippingProgressText.textContent = `Spend Rs. ${remaining.toLocaleString()} more for free shipping!`;
                    shippingProgressBar.style.width = `${percent}%`;
                    shippingProgressBar.classList.remove('completed');
                }

                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = `
                        <div class="cart-empty-state" style="text-align: center; padding: 40px 20px; color: var(--slate-gray);">
                            <i class="fa-solid fa-cart-shopping" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.3;"></i>
                            <p style="margin-bottom: 20px; font-weight: 500;">Your basket is currently empty.</p>
                            <button class="continue-shopping-btn" onclick="closeCartDrawer()" style="background: var(--dark-charcoal); color: var(--white); border: none; padding: 10px 20px; border-radius: 4px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">Continue Shopping</button>
                        </div>
                    `;
                    document.getElementById('cartDrawerFooter').style.display = 'none';
                    return;
                }

                document.getElementById('cartDrawerFooter').style.display = 'block';

                let itemsHtml = '';
                cart.forEach((item, index) => {
                    itemsHtml += `
                        <div class="cart-drawer-item">
                            <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                            <div class="cart-item-details">
                                <h4 class="cart-item-title">${item.name}</h4>
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 4px;">
                                    <p class="cart-item-meta" style="margin: 0; padding-right: 10px;">Size: ${item.size}</p>
                                    <button class="cart-item-edit-btn" onclick="openEditModal(${index})" style="background: transparent; border: none; color: #999; cursor: pointer; padding: 0; font-size: 1.1rem; transition: color 0.2s;"><i class="fa-regular fa-pen-to-square"></i></button>
                                </div>
                                <div class="cart-item-price-row" style="margin-bottom: 8px;">
                                    ${item.oldPrice && item.oldPrice > item.price ? `<span class="cart-item-old-price" style="text-decoration: line-through; color: #999; font-size: 0.9rem; margin-right: 8px;">Rs. ${item.oldPrice.toLocaleString()}.00</span>` : ''}
                                    <span class="cart-item-price" style="font-size: 1rem; font-weight: 700; color: var(--dark-charcoal);">Rs. ${item.price.toLocaleString()}.00</span>
                                </div>
                                <div class="cart-item-controls-row">
                                    <div class="cart-item-qty">
                                        <button onclick="updateCartDrawerItemQty('${item.id}', '${item.size}', -1)">-</button>
                                        <input type="number" value="${item.quantity}" readonly>
                                        <button onclick="updateCartDrawerItemQty('${item.id}', '${item.size}', 1)">+</button>
                                    </div>
                                    <button class="cart-item-delete" onclick="removeCartDrawerItem('${item.id}', '${item.size}')">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
                cartItemsContainer.innerHTML = itemsHtml;
            };

            // Initial Count and Render
            updateCartCount();
            renderCartDrawer();

            // Inject floating basket icon to all product cards
            const productCards = document.querySelectorAll('.ms-card');
            productCards.forEach((card, index) => {
                const imgWrapper = card.querySelector('.ms-img-wrapper');
                if (imgWrapper && !imgWrapper.querySelector('.ms-cart-btn-floating')) {
                    const btn = document.createElement('button');
                    btn.className = 'ms-cart-btn-floating';
                    btn.setAttribute('title', 'Add to Cart');
                    btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" style="width: 17px; height: 17px; display: block;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>`;
                    
                    // Click handler
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Extract product details
                        let id = card.getAttribute('data-id');
                        if (!id) {
                            // Fallback to index or link parsing
                            const link = card.querySelector('a');
                            const match = link ? link.getAttribute('href').match(/\/product\/(\d+)/) : null;
                            id = match ? match[1] : `p-${index}`;
                        }
                        
                        const nameEl = card.querySelector('.ms-title a') || card.querySelector('.ms-title');
                        const name = nameEl ? nameEl.textContent.trim() : 'Baby Product';
                        
                        const priceEl = card.querySelector('.new-price');
                        let price = 0;
                        if (priceEl) {
                            price = parseInt(priceEl.textContent.replace(/[^\d]/g, '')) || 0;
                        }
                        
                        const imgEl = card.querySelector('.real-product-img') || card.querySelector('img');
                        const image = imgEl ? imgEl.getAttribute('src') : '';
                        
                        // Default to standard size or first size if available
                        const sizesAttr = card.getAttribute('data-sizes');
                        const size = sizesAttr ? sizesAttr.split(',')[0] : 'Standard';

                        // Parse old price if it exists
                        const oldPriceEl = card.querySelector('.old-price');
                        const oldPrice = oldPriceEl ? parseInt(oldPriceEl.textContent.replace(/[^\d]/g, '')) || null : null;

                        addItemToCart(id, name, price, image, 1, size, oldPrice);
                    });
                    
                    imgWrapper.appendChild(btn);
                }
            });

            // Product Detail Page "ADD TO CART" button handler
            const detailAddBtn = document.querySelector('.pb-add-to-cart-btn');
            if (detailAddBtn) {
                detailAddBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Try to parse details from product page
                    const titleEl = document.querySelector('.pb-title');
                    const name = titleEl ? titleEl.textContent.trim() : 'Baby Product';
                    
                    const priceEl = document.querySelector('.pb-price .new-price') || document.querySelector('.new-price');
                    let price = 0;
                    if (priceEl) {
                        price = parseInt(priceEl.textContent.replace(/[^\d]/g, '')) || 0;
                    }
                    
                    const imgEl = document.getElementById('mainProductImage') || document.querySelector('.pb-gallery img');
                    const image = imgEl ? imgEl.getAttribute('src') : '';
                    
                    const qtyEl = document.getElementById('productQty');
                    const quantity = qtyEl ? parseInt(qtyEl.value) || 1 : 1;
                    
                    const sizeEl = document.getElementById('sizeSelected');
                    const size = sizeEl ? sizeEl.textContent.trim() : 'Standard';
                    
                    // Parse old price if it exists
                    const oldPriceEl = document.querySelector('.pb-old-price') || document.querySelector('.pb-price .old-price') || document.querySelector('.old-price');
                    const oldPrice = oldPriceEl ? parseInt(oldPriceEl.textContent.replace(/[^\d]/g, '')) || null : null;
                    
                    // ID from url pathname /product/id
                    const match = window.location.pathname.match(/\/product\/(\d+)/);
                    const id = match ? match[1] : 'current-product';
                    
                    addItemToCart(id, name, price, image, quantity, size, oldPrice);
                });
            }
        });
    