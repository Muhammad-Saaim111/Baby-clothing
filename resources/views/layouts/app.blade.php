<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BabyClothing | @yield('title', 'Premium Baby Wear')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons (FontAwesome or similar) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    
    <!-- Inline cache-busting overrides for icons -->
    <style>
        .absolute-wishlist, .grid-wishlist-btn {
            position: absolute !important;
            top: 45px !important;
            right: 12px !important;
            left: auto !important;
            width: 32px !important;
            height: 32px !important;
            background: #ffffff !important;
            border: 1px solid var(--border-soft) !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            color: var(--text-gray) !important;
            font-size: 0.9rem !important;
            transition: all 0.3s ease !important;
            z-index: 10 !important;
            opacity: 0 !important;
            transform: translateY(-10px) !important;
        }
        .ms-img-wrapper:hover .absolute-wishlist,
        .ms-img-wrapper:hover .grid-wishlist-btn {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        .absolute-wishlist:hover,
        .grid-wishlist-btn:hover {
            color: #ff4747 !important;
            border-color: #ff4747 !important;
        }
        .absolute-wishlist i.fa-solid,
        .grid-wishlist-btn i.fa-solid {
            color: #ff4747 !important;
        }
        .ms-quick-view {
            position: absolute !important;
            top: 85px !important;
            right: 12px !important;
            left: auto !important;
            width: 32px !important;
            height: 32px !important;
            background: #ffffff !important;
            border: 1px solid var(--border-soft) !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            color: var(--text-gray) !important;
            font-size: 0.9rem !important;
            transition: all 0.3s ease !important;
            z-index: 10 !important;
            opacity: 0 !important;
            transform: translateY(-10px) !important;
        }
        .ms-img-wrapper:hover .ms-quick-view {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        
        /* Show image completely, aligned to top, slightly larger */
        .qv-main-image-wrapper {
            width: 100%;
            height: 460px !important;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            overflow: hidden;
            background: #f1f3f4 !important;
        }

        .qv-main-image-wrapper img {
            width: 100% !important;
            height: auto !important;
            max-height: 100% !important;
            object-fit: contain !important;
            object-position: top center !important;
            margin-top: 0 !important;
            transform: scale(1.4);
            transform-origin: top center;
        }
        
        .qv-image-col {
            padding: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: flex-start !important;
            height: 100%;
            overflow: hidden;
            background: #f1f3f4 !important;
        }
        
        /* Thumbnails Styling */
        .qv-thumbnails {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            background: #f1f3f4;
            padding: 15px;
            z-index: 20;
        }
        
        .qv-thumbnails img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            background: #f1f3f4;
        }
        
        .qv-thumbnails img.active, .qv-thumbnails img:hover {
            border-color: var(--dark-charcoal);
        }
    </style>
</head>
<body>

    <!-- Mobile Navigation Drawer -->
    <div class="mobile-drawer-overlay" id="mobileDrawerOverlay"></div>
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header">
            <a href="/" class="drawer-logo">
                <img src="{{ asset('assets/images/logo_clean.png') }}" alt="AiM'EE Logo" style="height: 35px; width: auto; display: block;">
            </a>
            <button class="drawer-close-btn" id="drawerCloseBtn"><i class="fas fa-times"></i></button>
        </div>
        <div class="drawer-content">
            <ul class="drawer-nav-links">
                <li><a href="/">Home</a></li>
                <li class="drawer-has-submenu">
                    <div class="submenu-toggle-row">
                        <a href="{{ route('category.show', 'little-boys') }}">Boys</a>
                        <button class="submenu-toggle-btn"><i class="fas fa-chevron-down"></i></button>
                    </div>
                    <ul class="drawer-submenu">
                        <li><a href="{{ route('category.show', 'little-boys') }}">Sweatshirts</a></li>
                        <li><a href="{{ route('category.show', 'little-boys') }}">Shirts</a></li>
                    </ul>
                </li>
                <li class="drawer-has-submenu">
                    <div class="submenu-toggle-row">
                        <a href="{{ route('category.show', 'little-girls') }}">Girls</a>
                        <button class="submenu-toggle-btn"><i class="fas fa-chevron-down"></i></button>
                    </div>
                    <ul class="drawer-submenu">
                        <li><a href="{{ route('category.show', 'little-girls') }}">Sweatshirts</a></li>
                        <li><a href="{{ route('category.show', 'little-girls') }}">Tops</a></li>
                    </ul>
                </li>
                <li class="drawer-has-submenu">
                    <div class="submenu-toggle-row">
                        <a href="{{ route('category.show', 'new-born') }}">New Born</a>
                        <button class="submenu-toggle-btn"><i class="fas fa-chevron-down"></i></button>
                    </div>
                    <ul class="drawer-submenu">
                        <li><a href="{{ route('category.show', 'new-born') }}">Rompers</a></li>
                        <li><a href="{{ route('category.show', 'new-born') }}">Bodysuits</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sale-link">Hot Sale</a></li>
            </ul>
        </div>
    </div>

    <!-- Top Announcement Bar -->
    <div class="announcement-bar">
        <div class="ticker-wrapper">
            <div class="ticker-content">
                <span><span class="divider">⚡</span> Free Shipping on all orders over Rs. 5,000! Shop Now</span>
                <span><span class="divider">⚡</span> Pre-Winter Sale up to 30% Off. Shop Now</span>
                <span><span class="divider">⚡</span> Handcrafted for comfort, designed for style</span>
            </div>
            <div class="ticker-content">
                <span><span class="divider">⚡</span> Free Shipping on all orders over Rs. 5,000! Shop Now</span>
                <span><span class="divider">⚡</span> Pre-Winter Sale up to 30% Off. Shop Now</span>
                <span><span class="divider">⚡</span> Handcrafted for comfort, designed for style</span>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="header-container">
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-btn"><i class="fas fa-bars"></i></button>

            <!-- Logo -->
            <a href="/" class="logo">
                <img src="{{ asset('assets/images/logo_clean.png') }}" alt="AiM'EE Logo" style="height: 40px; width: auto; display: block;">
            </a>

            <!-- Navigation Links -->
            <nav class="desktop-nav">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li class="has-dropdown">
                        <a href="{{ route('category.show', 'little-boys') }}">Boys <i class="fas fa-chevron-down" style="font-size:0.7rem; margin-left:3px;"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('category.show', 'little-boys') }}">Sweatshirts</a></li>
                            <li><a href="{{ route('category.show', 'little-boys') }}">Shirts</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown">
                        <a href="{{ route('category.show', 'little-girls') }}">Girls <i class="fas fa-chevron-down" style="font-size:0.7rem; margin-left:3px;"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('category.show', 'little-girls') }}">Sweatshirts</a></li>
                            <li><a href="{{ route('category.show', 'little-girls') }}">Tops</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown">
                        <a href="{{ route('category.show', 'new-born') }}">New Born <i class="fas fa-chevron-down" style="font-size:0.7rem; margin-left:3px;"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('category.show', 'new-born') }}">Rompers</a></li>
                            <li><a href="{{ route('category.show', 'new-born') }}">Bodysuits</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="sale-link">Hot Sale</a></li>
                </ul>
            </nav>

            <!-- Icons (Search, User, Cart) -->
            <div class="header-icons">
                <a href="#" class="icon-link"><i class="fas fa-search"></i></a>
                <a href="#" class="icon-link"><i class="far fa-user"></i></a>
                <a href="#" class="icon-link cart-icon">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-col">
                <a href="/" class="footer-logo">
                    <img src="{{ asset('assets/images/logo_clean.png') }}" alt="AiM'EE Logo" style="height: 40px; width: auto; display: block;">
                </a>
                <p>Premium, comfortable, and adorable clothing for your little ones. Made with love and care.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h3>Shop</h3>
                <ul>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Baby (0-2 Years)</a></li>
                    <li><a href="#">Toddler (2-5 Years)</a></li>
                    <li><a href="#">Kids (5-8 Years)</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">Sale</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Information</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns & Exchanges</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Newsletter</h3>
                <p>Subscribe to receive updates, access to exclusive deals, and more.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} BabyClothing. All rights reserved.</p>
            <div class="payment-methods">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-amex"></i>
            </div>
        </div>
       <!-- Quick View Modal -->
    <div id="quickViewModal" class="qv-modal-overlay">
        <div class="qv-modal-content">
            <button class="qv-close-btn" onclick="closeQuickView()"><i class="fa-solid fa-xmark"></i></button>
            <div class="qv-modal-grid">
                <div class="qv-image-col">
                    <div class="qv-main-image-wrapper">
                        <span class="qv-badge" id="qvBadge">Sale</span>
                        <img id="qvImage" src="" alt="Product">
                    </div>
                    <div class="qv-thumbnails" id="qvThumbnails">
                        <!-- Thumbnails injected via JS -->
                    </div>
                </div>
                <div class="qv-details-col">
                    <div class="qv-title-row">
                        <h2 id="qvTitle">Product Title</h2>
                        <button class="qv-wishlist"><i class="fa-regular fa-heart"></i></button>
                    </div>
                    <div class="qv-stats">
                        <i class="fa-solid fa-fire" style="color: #ff4747;"></i> <span id="qvSold">3 sold in last 35 hours</span>
                    </div>
                    <div class="qv-meta">
                        <p>Availability: <span>20 In stock</span></p>
                        <p>Product type: <span id="qvCategory">Apparel</span></p>
                    </div>
                    <div class="qv-price-row">
                        <span id="qvOldPrice" class="qv-old-price"></span>
                        <span id="qvPrice" class="qv-new-price"></span>
                        <span id="qvDiscount" class="qv-discount-badge"></span>
                    </div>
                    
                    <div class="qv-size-selector">
                        <p class="qv-label">Size: <span id="qvSelectedSize">2Y To 3Y</span></p>
                        <div class="qv-sizes">
                            <button class="qv-size-btn active">2Y To 3Y</button>
                            <button class="qv-size-btn">3Y To 4Y</button>
                            <button class="qv-size-btn">4Y To 5Y</button>
                            <button class="qv-size-btn">5Y To 6Y</button>
                            <button class="qv-size-btn">6Y To 7Y</button>
                            <button class="qv-size-btn">7Y To 8Y</button>
                        </div>
                    </div>
                    
                    <div class="qv-quantity">
                        <p class="qv-label">Quantity:</p>
                        <div class="qv-qty-controls">
                            <button onclick="decrementQvQty()">-</button>
                            <input type="number" id="qvQtyInput" value="1" min="1" readonly>
                            <button onclick="incrementQvQty()">+</button>
                        </div>
                        <p class="qv-subtotal">Subtotal: Rs.<span id="qvSubtotal"></span></p>
                    </div>
                    
                    <div class="qv-actions">
                        <button class="qv-add-to-cart" id="qvAddToCartBtn">ADD TO CART</button>
                        <a href="#" id="qvViewDetails" class="qv-buy-now">BUY IT NOW</a>
                    </div>
                    <p class="qv-viewing"><i class="fa-regular fa-eye"></i> 50 customers are viewing this product</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Reveal JavaScript -->
    <script>
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

            function addItemToCart(id, name, price, image, quantity = 1, size = 'Standard') {
                let cart = getCart();
                const existingIndex = cart.findIndex(item => item.id === id && item.size === size);
                
                if (existingIndex > -1) {
                    cart[existingIndex].quantity += quantity;
                } else {
                    cart.push({ id, name, price, image, quantity, size });
                }
                
                saveCart(cart);
                showToast("Added to Basket!", `${name} has been added.`);
            }

            // Initial Count Update
            updateCartCount();

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

                        addItemToCart(id, name, price, image, 1, size);
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
                    
                    // ID from url pathname /product/id
                    const match = window.location.pathname.match(/\/product\/(\d+)/);
                    const id = match ? match[1] : 'current-product';
                    
                    addItemToCart(id, name, price, image, quantity, size);
                });
            }
        });
    </script>
</body>
</html>
