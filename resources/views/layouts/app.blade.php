<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BabyClothing | @yield('title', 'Premium Baby Wear')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Fredoka:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons (FontAwesome or similar) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/redesign.css') }}?v={{ time() }}">
    
    @livewireStyles

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

        /* Google Auth Button Styles */
        .google-auth-separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
            color: #888;
            font-size: 13px;
        }
        .google-auth-separator::before,
        .google-auth-separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #eee;
        }
        .google-auth-separator not(:empty)::before {
            margin-right: .25em;
        }
        .google-auth-separator not(:empty)::after {
            margin-left: .25em;
        }
        .google-auth-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px;
            background: white;
            color: #444;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-weight: 500;
            font-size: 15px;
            text-decoration: none;
            transition: background-color 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        .google-auth-btn img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }
        .google-auth-btn:hover {
            background: #fdfdfd;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            color: #333;
        }

        /* Preloader Styling */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #faf8f6; /* Warm boutique cream background */
            z-index: 999999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .preloader-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .preloader-logo-wrapper {
            position: relative;
        }

        .preloader-logo {
            height: 60px;
            width: auto;
            display: block;
            animation: logoHeartbeat 3.5s infinite ease-in-out;
        }

        @keyframes logoHeartbeat {
            0% {
                transform: scale(0.96);
                filter: drop-shadow(0 2px 4px rgba(211, 158, 130, 0.1));
            }
            15% {
                transform: scale(1.06);
                filter: drop-shadow(0 8px 16px rgba(211, 158, 130, 0.3));
            }
            30% {
                transform: scale(0.98);
                filter: drop-shadow(0 4px 8px rgba(211, 158, 130, 0.2));
            }
            45% {
                transform: scale(1.08);
                filter: drop-shadow(0 10px 20px rgba(211, 158, 130, 0.35));
            }
            70% {
                transform: scale(0.96);
                filter: drop-shadow(0 2px 4px rgba(211, 158, 130, 0.1));
            }
            100% {
                transform: scale(0.96);
                filter: drop-shadow(0 2px 4px rgba(211, 158, 130, 0.1));
            }
        }
    </style>
</head>
<body>

    <!-- Preloader Screen -->
    <div id="preloader">
        <div class="preloader-content">
            <div class="preloader-logo-wrapper">
                <img src="{{ asset('assets/images/logo_clean.png') }}" alt="AiM'EE Logo" class="preloader-logo">
            </div>
        </div>
    </div>
    
    <script>
        // Immediately run this inline to ensure loader disappears safely on page load
        (function() {
            function removePreloader() {
                var preloader = document.getElementById('preloader');
                if (preloader) {
                    preloader.style.opacity = '0';
                    preloader.style.visibility = 'hidden';
                    setTimeout(function() {
                        if (preloader.parentNode) {
                            preloader.parentNode.removeChild(preloader);
                        }
                    }, 500);
                }
            }
            
            // Safety timeout: remove loader after 4.5 seconds even if assets fail to load
            var safetyTimeout = setTimeout(removePreloader, 4500);
            
            window.addEventListener('load', function() {
                clearTimeout(safetyTimeout);
                removePreloader();
            });
        })();
    </script>

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
                    </ul>
                </li>
                <li class="drawer-has-submenu">
                    <div class="submenu-toggle-row">
                        <a href="{{ route('category.show', 'little-girls') }}">Girls</a>
                        <button class="submenu-toggle-btn"><i class="fas fa-chevron-down"></i></button>
                    </div>
                    <ul class="drawer-submenu">
                        <li><a href="{{ route('category.show', 'little-girls') }}">Sweatshirts</a></li>
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
            <a href="/" class="logo" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; line-height: 1;">
                <img src="{{ asset('assets/images/logo_clean.png') }}" alt="AiM'EE Logo" style="height: 38px; width: auto; display: block;">
                <span class="logo-tagline" style="font-family: 'Caveat', cursive; font-size: 1.3rem; font-weight: 700; color: #3b4e61; letter-spacing: 0.5px; margin-top: 1px; text-transform: none; white-space: nowrap;">For Every Little Smile</span>
            </a>

            <!-- Navigation Links -->
            <nav class="desktop-nav">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li class="has-dropdown">
                        <a href="{{ route('category.show', 'little-boys') }}">Boys <i class="fas fa-chevron-down" style="font-size:0.7rem; margin-left:3px;"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('category.show', 'little-boys') }}">Sweatshirts</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown">
                        <a href="{{ route('category.show', 'little-girls') }}">Girls <i class="fas fa-chevron-down" style="font-size:0.7rem; margin-left:3px;"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('category.show', 'little-girls') }}">Sweatshirts</a></li>
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
                <button class="icon-link" id="searchToggleBtn" onclick="openSearchOverlay()" title="Search"><i class="fas fa-search"></i></button>
                @auth
                    <div class="user-profile-menu">
                        <a href="#" class="icon-link user-profile-trigger" title="Account" onclick="event.preventDefault(); document.querySelector('.user-dropdown-card').classList.toggle('active');">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            @else
                                <i class="fa-regular fa-user"></i>
                                <span class="user-initials-badge">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            @endif
                        </a>
                        <div class="user-dropdown-card">
                            <p class="ud-welcome">Hi, <strong>{{ Auth::user()->name }}</strong></p>
                            <a href="{{ route('profile') }}"><i class="fa-regular fa-user"></i> Profile Settings</a>
                            <a href="{{ route('orders') }}"><i class="fa-solid fa-box"></i> My Orders</a>
                            <a href="/wishlist"><i class="fa-regular fa-heart"></i> My Wishlist</a>
                            <a href="#" onclick="handleAjaxLogout(event)"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</a>
                        </div>
                    </div>
                @else
                    <a href="#" class="icon-link" id="authModalTrigger" onclick="openAuthModal(); return false;" title="Login/Signup"><i class="fa-regular fa-user"></i></a>
                @endauth
                <a href="/wishlist" class="icon-link wishlist-icon" title="Wishlist">
                    <i class="fa-regular fa-heart"></i>
                    <span class="wishlist-count" id="headerWishlistCount" style="display: none;">0</span>
                </a>
                <a href="#" class="icon-link cart-icon">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Search Overlay -->
    <div class="search-overlay" id="searchOverlay" onclick="closeSearchOverlay(event)">
        <div class="search-overlay-inner">
            <form action="/search" method="GET" class="search-overlay-form">
                <i class="fas fa-search search-overlay-icon"></i>
                <input type="text" name="q" id="searchOverlayInput" placeholder="Search sweatshirts, boys, girls…" autocomplete="off">
                <button type="submit">Search</button>
                <button type="button" class="search-close-btn" onclick="closeSearchOverlay()"><i class="fas fa-times"></i></button>
            </form>
        </div>
    </div>

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
    <!-- Authentication Modal (Login / Signup) -->
    <div id="authModal" class="auth-modal-overlay">
        <div class="auth-modal-content">
            <button class="auth-close-btn" onclick="closeAuthModal()"><i class="fa-solid fa-xmark"></i></button>
            <div class="auth-tabs">
                <button type="button" class="auth-tab-btn active" id="tab-login" onclick="switchAuthTab('login')">LOG IN</button>
                <button type="button" class="auth-tab-btn" id="tab-register" onclick="switchAuthTab('register')">CREATE ACCOUNT</button>
            </div>
            
            <!-- Login Form -->
            <form id="loginForm" class="auth-form" onsubmit="handleAjaxLogin(event)">
                @csrf
                <div id="loginSuccess" class="auth-success-msg" style="display: none; background: #e6f6ee; color: #1c7c54; padding: 12px; border-radius: 6px; border: 1px solid #b6e3cc; font-size: 13px; margin-bottom: 15px; gap: 10px; align-items: flex-start;"><i class="fa-solid fa-check" style="margin-top: 2px;"></i><span></span></div>
                <div id="loginError" class="auth-error-msg" style="display: none;"></div>
                <div class="form-group">
                    <input type="email" id="loginEmail" placeholder="Email address" required class="auth-input">
                </div>
                <div class="form-group">
                    <input type="password" id="loginPassword" placeholder="Password" required class="auth-input">
                </div>
                <button type="submit" class="auth-submit-btn">SIGN IN</button>
            </form>
            
            <!-- Register Form -->
            <form id="registerForm" class="auth-form" onsubmit="handleAjaxRegister(event)" style="display: none;">
                @csrf
                <div id="registerError" class="auth-error-msg" style="display: none;"></div>
                <div class="form-group">
                    <input type="text" id="registerName" placeholder="Full name" required class="auth-input">
                </div>
                <div class="form-group">
                    <input type="email" id="registerEmail" placeholder="Email address" required class="auth-input">
                </div>
                <div class="form-group">
                    <input type="password" id="registerPassword" placeholder="Password (min. 6 characters)" required class="auth-input">
                </div>
                <div class="form-group">
                    <input type="password" id="registerConfirmPassword" placeholder="Confirm password" required class="auth-input">
                </div>
                <button type="submit" class="auth-submit-btn">CREATE ACCOUNT</button>
            </form>

            <div class="google-auth-separator">
                <span>OR</span>
            </div>
            
            <a href="{{ route('google.login') }}" class="google-auth-btn">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google">
                Continue with Google
            </a>
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

    <!-- Edit Option Modal -->
    <div id="editItemModal" class="edit-modal-overlay">
        <div class="edit-modal-content">
            <button class="edit-close-btn" onclick="closeEditModal()"><i class="fa-solid fa-xmark"></i></button>
            <h2 class="edit-modal-title">Edit Option</h2>
            <div id="editItemsContainer">
                <!-- Dynamically populated by JS -->
            </div>
            <button class="edit-add-to-cart-btn" onclick="updateCartItem()">ADD TO CART</button>
        </div>
    </div>

    <!-- Shopping Cart Drawer Overlay -->
    <div id="cartDrawerOverlay" class="cart-drawer-overlay" onclick="closeCartDrawer()"></div>

    <!-- Shopping Cart Drawer -->
    <div id="cartDrawer" class="cart-drawer">
        <div class="cart-drawer-header">
            <h3>Shopping Cart</h3>
            <span class="cart-drawer-count" id="cartDrawerCount">0 items</span>
            <button class="cart-drawer-close" onclick="closeCartDrawer()"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="cart-shipping-bar">
            <div class="shipping-info">
                <span id="shippingProgressText">Spend Rs. 5,000 more for free shipping!</span>
                <i class="fa-solid fa-truck-fast"></i>
            </div>
            <div class="shipping-progress-bg">
                <div id="shippingProgressBar" class="shipping-progress-bar" style="width: 0%"></div>
            </div>
        </div>

        <div class="cart-drawer-items" id="cartDrawerItems">
            <!-- Items injected dynamically -->
        </div>

        <div class="cart-drawer-footer" id="cartDrawerFooter">
            <div class="cart-addon-toolbar">
                <button class="addon-btn" id="specialInstructionsBtn" title="Special Instructions" onclick="toggleSpecialInstructions()"><i class="fa-regular fa-clipboard"></i></button>
                <button class="addon-btn" id="addCouponBtn" title="Add Coupon" onclick="toggleAddCoupon()"><i class="fa-solid fa-tag"></i></button>
            </div>
            
            <!-- Special Instructions Card -->
            <div class="special-instructions-card" id="specialInstructionsCard">
                <div class="sic-header">
                    <i class="fa-regular fa-clipboard"></i> 
                    <h4>Order Special Instructions</h4>
                </div>
                <textarea class="sic-textarea" id="sicTextarea" placeholder="Order special instructions"></textarea>
                <div class="sic-actions">
                    <button class="sic-save-btn" onclick="saveSpecialInstructions()">SAVE</button>
                    <button class="sic-cancel-btn" onclick="toggleSpecialInstructions()">CANCEL</button>
                </div>
            </div>
            
            <!-- Add Coupon Card -->
            <div class="special-instructions-card" id="addCouponCard">
                <div class="sic-header">
                    <i class="fa-solid fa-tag"></i> 
                    <h4>Add A Coupon</h4>
                </div>
                <p class="sic-subtitle">Coupon code content</p>
                <input type="text" class="sic-input" id="sicCouponInput" />
                <div class="sic-actions">
                    <button class="sic-save-btn" onclick="saveCoupon()">SAVE</button>
                    <button class="sic-cancel-btn" onclick="toggleAddCoupon()">CANCEL</button>
                </div>
            </div>
            
            <div class="cart-totals">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span id="cartDrawerSubtotal">Rs. 0.00</span>
                </div>
                <div class="total-row" id="cartDrawerDiscountRow" style="display: none;">
                    <span>Discount:</span>
                    <span id="cartDrawerDiscountAmount" style="color: var(--terracotta); font-weight: bold;">-Rs. 0.00</span>
                </div>
                <div class="total-row main-total">
                    <span>Total:</span>
                    <span id="cartDrawerTotal">Rs. 0.00</span>
                </div>
                <p class="tax-info">Tax included and shipping calculated at checkout</p>
            </div>
            <div class="cart-drawer-actions">
                <a href="/checkout" class="checkout-btn" style="text-align: center; display: flex; align-items: center; justify-content: center; text-decoration: none;">CHECKOUT</a>
                <a href="/cart" class="view-cart-btn">VIEW CART</a>
            </div>
        </div>
    </div>

    <!-- Scroll Reveal JavaScript -->
    <script>
        // --- LocalStorage User Scoping Monkey-Patch ---
        (function() {
            const userId = @json(Auth::id() ?? 'guest');
            
            // Merge guest cart/wishlist to logged-in user cart/wishlist if they just logged in
            if (userId !== 'guest') {
                const guestCart = localStorage.getItem('aim_cart_guest');
                if (guestCart) {
                    let userCartKey = 'aim_cart_' + userId;
                    let userCart = JSON.parse(localStorage.getItem(userCartKey)) || [];
                    let parsedGuestCart = JSON.parse(guestCart) || [];
                    
                    parsedGuestCart.forEach(guestItem => {
                        const existingIndex = userCart.findIndex(item => item.id === guestItem.id && item.size === guestItem.size);
                        if (existingIndex > -1) {
                            userCart[existingIndex].quantity += guestItem.quantity;
                        } else {
                            userCart.push(guestItem);
                        }
                    });
                    localStorage.setItem(userCartKey, JSON.stringify(userCart));
                    localStorage.removeItem('aim_cart_guest');
                }
                
                const guestWishlist = localStorage.getItem('aim_wishlist_guest');
                if (guestWishlist) {
                    let userWishlistKey = 'aim_wishlist_' + userId;
                    let userWishlist = JSON.parse(localStorage.getItem(userWishlistKey)) || [];
                    let parsedGuestWishlist = JSON.parse(guestWishlist) || [];
                    
                    parsedGuestWishlist.forEach(guestItem => {
                        if (!userWishlist.some(item => item.id === guestItem.id)) {
                            userWishlist.push(guestItem);
                        }
                    });
                    localStorage.setItem(userWishlistKey, JSON.stringify(userWishlist));
                    localStorage.removeItem('aim_wishlist_guest');
                }
            }

            // Save original storage methods
            const originalGetItem = Storage.prototype.getItem;
            const originalSetItem = Storage.prototype.setItem;
            const originalRemoveItem = Storage.prototype.removeItem;
            
            // Expose for aggressive clearing
            window.originalStorageRemove = originalRemoveItem;

            // Helper to map keys
            function mapKey(key) {
                if (key && key.startsWith('aim_') && !key.endsWith('_guest') && !key.match(/_\d+$/)) {
                    return key + '_' + userId;
                }
                return key;
            }

            Storage.prototype.getItem = function(key) {
                return originalGetItem.call(this, mapKey(key));
            };

            Storage.prototype.setItem = function(key, value) {
                originalSetItem.call(this, mapKey(key), value);
            };

            Storage.prototype.removeItem = function(key) {
                originalRemoveItem.call(this, mapKey(key));
            };
        })();

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
            
            // Bind Wishlist inside Quick View modal
            const qvWishlistBtn = document.querySelector('.qv-wishlist');
            if (qvWishlistBtn) {
                qvWishlistBtn.setAttribute('data-id', id);
                qvWishlistBtn.onclick = function() {
                    toggleWishlist(this, id, title, price, image);
                };
            }
            updateWishlistUI();
            
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

            window.showToast = function(title, message) {
                toastContainer.querySelector('.cart-toast-title').textContent = title;
                toastContainer.querySelector('.cart-toast-message').textContent = message;
                toastContainer.classList.add('show');
                setTimeout(() => {
                    toastContainer.classList.remove('show');
                }, 3000);
            };

            // Load saved instructions when opening cart drawer
            function initPageToasts() {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('verified') === '1') {
                    if (window.showToast) {
                        window.showToast("Email Verified! ✅", "You are now logged in. Welcome! 🎉");
                    }
                    // Clean up URL without reloading
                    window.history.replaceState({}, document.title, window.location.pathname);
                }

                @if(session('success') || session('status'))
                    if (window.showToast) {
                        window.showToast("Success! 🎉", "{{ session('success') ?? session('status') }}");
                    }
                @endif

                @if(session('error'))
                    if (window.showToast) {
                        window.showToast("Error! ❌", "{{ session('error') }}");
                    }
                @endif
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initPageToasts);
            } else {
                initPageToasts();
            }

            function initCartCheck() {
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

                // --- FUNNEL CLEAR CHECK ---
                // Only check if we actually have items in the cart
                const currentCart = getCart();
                if (currentCart.length === 0) {
                    return; // Cart is already empty, no need to check
                }

                // If backend cleared the cart, empty it on frontend too
                const email = localStorage.getItem('aim_checkout_email');
                const cartId = localStorage.getItem('aim_cart_id');
                const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                if (tokenMeta) {
                    fetch('/api/cart/check', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': tokenMeta.getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ email: email, cart_id: cartId })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.cleared) {
                            // Aggressively clear EVERYTHING related to cart
                            try {
                                const keysToNuke = [];
                                for (let i = 0; i < localStorage.length; i++) {
                                    const k = localStorage.key(i);
                                    if (k && (k.startsWith('aim_cart') || k.startsWith('aim_checkout'))) {
                                        keysToNuke.push(k);
                                    }
                                }
                                keysToNuke.forEach(k => {
                                    if (typeof window.originalStorageRemove === 'function') {
                                        window.originalStorageRemove.call(localStorage, k);
                                    } else {
                                        localStorage.removeItem(k);
                                    }
                                });
                            } catch(err) {}
                            
                            if (typeof updateCartCount === 'function') updateCartCount();
                            if (typeof renderCartDrawer === 'function') renderCartDrawer();
                        }
                    })
                    .catch(e => {}); // Silent fail
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCartCheck);
            } else {
                initCartCheck();
            }

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
                const text = document.getElementById('sicCouponInput').value.trim().toUpperCase();
                const btn = event ? event.target : null;
                
                if (!text) {
                    showToast("Error", "Please enter a coupon code.");
                    return;
                }

                if (btn) btn.textContent = 'SAVING...';

                const cart = getCart();
                const subtotal = cart.reduce((sum, item) => sum + ((Number(item.price) || 0) * (Number(item.quantity) || 1)), 0);

                fetch('/coupon/apply', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ code: text, subtotal: subtotal })
                })
                .then(async res => {
                    const data = await res.json();
                    if (data.success) {
                        localStorage.setItem('aim_order_coupon', data.code);
                        localStorage.setItem('aim_order_coupon_type', data.type);
                        localStorage.setItem('aim_order_coupon_value', data.value);
                        toggleAddCoupon();
                        showToast("Applied!", data.message);
                        renderCartDrawer();
                    } else {
                        localStorage.removeItem('aim_order_coupon');
                        localStorage.removeItem('aim_order_coupon_type');
                        localStorage.removeItem('aim_order_coupon_value');
                        showToast("Error", data.message);
                        renderCartDrawer();
                    }
                })
                .catch(() => showToast("Error", "Could not connect to server."))
                .finally(() => { if (btn) btn.textContent = 'SAVE'; });
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
                syncCartToServer(cart);
            }

            function syncCartToServer(cart) {
                const subtotal = cart.reduce((sum, item) => sum + ((Number(item.price) || 0) * (Number(item.quantity) || 1)), 0);
                
                // Try to get email if user is typing on checkout page
                const emailInput = document.getElementById('email') || document.querySelector('input[name="email"]');
                const email = emailInput && emailInput.value && emailInput.value.includes('@') ? emailInput.value : null;

                const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                if (!tokenMeta) return;

                fetch('/api/cart/sync', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': tokenMeta.getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ cart: cart, total: subtotal, email: email })
                }).catch(e => {}); // Silent fail
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
            window.updateCartCount = updateCartCount;

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

            window.addItemToCart = addItemToCart;

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

        // Edit Item Modal Logic
        let editingCartIndex = -1;
        let currentEditItems = [];
        
        window.openEditModal = function(index) {
            const cart = getCart();
            const item = cart[index];
            if (!item) return;

            editingCartIndex = index;
            currentEditItems = [ { ...item, quantity: item.quantity || 1 } ];
            
            renderEditItems();
            document.getElementById('editItemModal').classList.add('active');
            
            if(typeof qvModal !== 'undefined' && qvModal && qvModal.classList.contains('active')) {
                if (typeof closeQuickView === 'function') closeQuickView();
            }
        };
        
        window.renderEditItems = function() {
            const container = document.getElementById('editItemsContainer');
            container.innerHTML = '';
            
            const mockSizes = ['2Y To 3Y', '3Y To 4Y', '4Y To 5Y', '5Y To 6Y', '6Y To 7Y', '7Y To 8Y', '9Y To 10Y', '11Y To 12Y'];
            
            currentEditItems.forEach((item, i) => {
                const price = Number(item.price) || 0;
                const oldPrice = Number(item.oldPrice) || 0;
                
                const block = document.createElement('div');
                block.className = 'edit-modal-grid';
                if (i > 0) {
                    block.style.borderTop = '1px solid #eee';
                    block.style.paddingTop = '30px';
                }
                
                let sizesHtml = '';
                let sizes = [...mockSizes];
                if (!sizes.includes(item.size)) sizes.unshift(item.size);
                
                sizes.forEach(s => {
                    const activeClass = (s === item.size) ? 'active' : '';
                    sizesHtml += `<button class="edit-size-btn ${activeClass}" onclick="updateEditItemSize(${i}, '${s}')">${s}</button>`;
                });
                
                const removeBtnHtml = currentEditItems.length > 1 
                    ? `<button class="edit-item-remove-btn" onclick="removeEditItem(${i})" title="Remove"><i class="fa-solid fa-xmark"></i></button>` 
                    : '';
                
                const isLastItem = (i === currentEditItems.length - 1);
                const addMoreBtnHtml = isLastItem ? `<button class="edit-add-more-btn" onclick="addMoreEditItem()">+ ADD MORE</button>` : '';

                block.innerHTML = `
                    <div class="edit-image-col" style="position: relative;">
                        ${removeBtnHtml}
                        <img src="${item.image || ''}" alt="Product">
                    </div>
                    <div class="edit-details-col">
                        <h4 class="edit-title">${item.name || 'Product'}</h4>
                        <p class="edit-variant">${item.size || 'Standard'}</p>
                        
                        <div class="edit-price-row">
                            ${oldPrice > price ? `<span class="edit-old-price">Rs.${oldPrice.toLocaleString()}.00</span>` : ''}
                            <span class="edit-new-price">Rs.${price.toLocaleString()}.00</span>
                        </div>
                        
                        <div class="edit-quantity">
                            <p class="edit-label">Quantity:</p>
                            <div class="edit-qty-controls">
                                <button onclick="updateEditItemQty(${i}, -1)">-</button>
                                <input type="number" value="${item.quantity}" readonly>
                                <button onclick="updateEditItemQty(${i}, 1)">+</button>
                            </div>
                        </div>
                        
                        <div class="edit-size-selector">
                            <p class="edit-label">Size: <span>${item.size || 'Standard'}</span></p>
                            <div class="edit-sizes">
                                ${sizesHtml}
                            </div>
                        </div>
                        
                        ${addMoreBtnHtml}
                    </div>
                `;
                container.appendChild(block);
            });
        };
        
        window.addMoreEditItem = function() {
            if (currentEditItems.length > 0) {
                const clone = { ...currentEditItems[0], quantity: 1 };
                currentEditItems.push(clone);
                renderEditItems();
            }
        };
        
        window.removeEditItem = function(index) {
            if (currentEditItems.length > 1) {
                currentEditItems.splice(index, 1);
                renderEditItems();
            }
        };
        
        window.updateEditItemSize = function(index, size) {
            currentEditItems[index].size = size;
            renderEditItems();
        };
        
        window.updateEditItemQty = function(index, change) {
            const newQty = currentEditItems[index].quantity + change;
            if (newQty >= 1) {
                currentEditItems[index].quantity = newQty;
                renderEditItems();
            }
        };

        window.closeEditModal = function() {
            document.getElementById('editItemModal').classList.remove('active');
        };

        window.updateCartItem = function() {
            if (editingCartIndex === -1 || currentEditItems.length === 0) return;
            const cart = getCart();
            if (!cart[editingCartIndex]) return;

            // Remove original item
            cart.splice(editingCartIndex, 1);
            saveCart(cart); 
            
            // Add items back using addItemToCart so quantities merge correctly if same size
            currentEditItems.forEach(item => {
                addItemToCart(item.id, item.name, item.price, item.image, item.quantity, item.size, item.oldPrice);
            });

            closeEditModal();
        };

        window.updateQvSubtotal = function() {
            const qty = parseInt(document.getElementById('qvQtyInput').value);
            const subtotal = qty * qvCurrentPrice;
            document.getElementById('qvSubtotal').textContent = subtotal.toLocaleString() + '.00';
        };
        

            // Wishlist Logic
        function getWishlist() {
            try {
                return JSON.parse(localStorage.getItem('aim_wishlist')) || [];
            } catch(e) {
                return [];
            }
        }

        function saveWishlist(wishlist) {
            localStorage.setItem('aim_wishlist', JSON.stringify(wishlist));
            updateWishlistUI();
        }

        window.toggleWishlist = function(btn, id, name, price, image) {
            let wishlist = getWishlist();
            const index = wishlist.findIndex(item => item.id === id);

            // Add wiggle class for micro-animation
            btn.classList.add('wiggle');
            setTimeout(() => btn.classList.remove('wiggle'), 500);

            if (index > -1) {
                // Remove
                wishlist.splice(index, 1);
                saveWishlist(wishlist);
                showToast("Removed", `${name} has been removed from your wishlist.`);
            } else {
                // Add
                wishlist.push({ id, name, price, image });
                saveWishlist(wishlist);
                showToast("Wishlist! ❤️", `${name} has been saved for later.`);
            }
        };

        window.updateWishlistUI = function() {
            const wishlist = getWishlist();
            const countEl = document.getElementById('headerWishlistCount');
            
            // Update Header badge
            if (countEl) {
                if (wishlist.length > 0) {
                    countEl.textContent = wishlist.length;
                    countEl.style.display = 'flex';
                } else {
                    countEl.style.display = 'none';
                }
            }

            // Update all favorited buttons on the page
            document.querySelectorAll('.absolute-wishlist, .grid-wishlist-btn, .qv-wishlist').forEach(btn => {
                const id = btn.getAttribute('data-id');
                const isFavorited = wishlist.some(item => String(item.id) === String(id));
                const icon = btn.querySelector('i');
                
                if (icon) {
                    if (isFavorited) {
                        btn.classList.add('active');
                        icon.className = 'fa-solid fa-heart';
                    } else {
                        btn.classList.remove('active');
                        icon.className = 'fa-regular fa-heart';
                    }
                }
            });
        };

        // Call updateWishlistUI on DOMContentLoaded
        updateWishlistUI();

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
                const subtotal = cart.reduce((sum, item) => sum + ((Number(item.price) || 0) * (Number(item.quantity) || 1)), 0);
                cartSubtotalEl.textContent = `Rs. ${subtotal.toLocaleString()}.00`;

                // Calculate discount if coupon saved
                let discount = 0;
                const savedCoupon = localStorage.getItem('aim_order_coupon');
                const savedType = localStorage.getItem('aim_order_coupon_type');
                const savedValue = Number(localStorage.getItem('aim_order_coupon_value'));
                
                const discountRow = document.getElementById('cartDrawerDiscountRow');
                const discountAmountEl = document.getElementById('cartDrawerDiscountAmount');
                
                if (savedCoupon && savedType && savedValue && subtotal > 0) {
                    if (savedType === 'percentage') {
                        discount = Math.round(subtotal * (savedValue / 100));
                    } else if (savedType === 'fixed') {
                        discount = Math.min(savedValue, subtotal);
                    }
                    
                    if (discountRow) discountRow.style.display = 'flex';
                    if (discountAmountEl) discountAmountEl.textContent = `-Rs. ${discount.toLocaleString()}.00`;
                    
                    // Display applied coupon code in input field
                    const input = document.getElementById('sicCouponInput');
                    if (input && !input.value) input.value = savedCoupon;
                } else {
                    if (discountRow) discountRow.style.display = 'none';
                }
                
                const finalTotal = subtotal - discount;
                cartTotalEl.textContent = `Rs. ${finalTotal.toLocaleString()}.00`;

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
                    const price = Number(item.price) || 0;
                    const oldPrice = Number(item.oldPrice) || 0;
                    
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
                                    ${oldPrice > price ? `<span class="cart-item-old-price" style="text-decoration: line-through; color: #999; font-size: 0.9rem; margin-right: 8px;">Rs. ${oldPrice.toLocaleString()}.00</span>` : ''}
                                    <span class="cart-item-price" style="font-size: 1rem; font-weight: 700; color: var(--dark-charcoal);">Rs. ${price.toLocaleString()}.00</span>
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
                    
                    // Click handler to open Quick-Add Sizes & Qty
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const overlay = imgWrapper.querySelector('.quick-add-overlay');
                        if (overlay) {
                            overlay.classList.add('active');
                            // Hide the hover button while overlay is open
                            btn.style.opacity = '0';
                            btn.style.pointerEvents = 'none';
                        }
                    });
                    
                    imgWrapper.appendChild(btn);
                }
            });

            // --- Quick-Add Overlay Global Helper Functions ---
            window.selectQuickAddSize = function(btn, size) {
                event.preventDefault();
                event.stopPropagation();
                const parent = btn.closest('.qa-sizes-list');
                parent.querySelectorAll('.qa-size-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            };

            window.adjustQuickAddQty = function(btn, amount) {
                event.preventDefault();
                event.stopPropagation();
                const selector = btn.closest('.qa-qty-selector');
                const input = selector.querySelector('.qa-qty-input');
                let val = parseInt(input.value) + amount;
                if (val < 1) val = 1;
                if (val > 10) val = 10;
                input.value = val;
            };

            window.closeQuickAddOverlay = function(btn, event) {
                if (event) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                const overlay = btn.closest('.quick-add-overlay');
                if (overlay) {
                    overlay.classList.remove('active');
                    // Reset selected size and qty for clean slate next time
                    overlay.querySelectorAll('.qa-size-btn').forEach(b => b.classList.remove('active'));
                    overlay.querySelector('.qa-qty-input').value = 1;
                    
                    // Show the hover button back
                    const imgWrapper = overlay.closest('.ms-img-wrapper');
                    const floatingBtn = imgWrapper.querySelector('.ms-cart-btn-floating');
                    if (floatingBtn) {
                        floatingBtn.style.opacity = '';
                        floatingBtn.style.pointerEvents = '';
                    }
                }
            };

            window.submitQuickAddToCart = function(btn, event) {
                event.preventDefault();
                event.stopPropagation();
                const card = btn.closest('.ms-card');
                const overlay = btn.closest('.quick-add-overlay');
                
                // 1. Get Selected Size
                const activeSizeBtn = overlay.querySelector('.qa-size-btn.active');
                if (!activeSizeBtn) {
                    if (window.showToast) {
                        window.showToast("Size Required! ❌", "Please select a size first.");
                    } else {
                        alert("Please select a size first.");
                    }
                    return;
                }
                const size = activeSizeBtn.textContent.trim();
                
                // 2. Get Quantity
                const quantity = parseInt(overlay.querySelector('.qa-qty-input').value) || 1;
                
                // 3. Extract product details
                let id = card.getAttribute('data-id');
                if (!id) {
                    const link = card.querySelector('a');
                    const match = link ? link.getAttribute('href').match(/\/product\/(\d+)/) : null;
                    id = match ? match[1] : `p-quick`;
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
                
                const oldPriceEl = card.querySelector('.old-price');
                const oldPrice = oldPriceEl ? parseInt(oldPriceEl.textContent.replace(/[^\d]/g, '')) || null : null;
                
                // 4. Add to Cart!
                if (typeof window.addItemToCart === 'function') {
                    window.addItemToCart(id, name, price, image, quantity, size, oldPrice);
                }
                
                // 5. Close overlay
                window.closeQuickAddOverlay(btn);
            };

            // Product Detail Page "ADD TO CART" button handler
            const detailAddBtn = document.querySelector('.pb-add-to-cart-btn');
            if (detailAddBtn) {
                detailAddBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Try to parse details from product page
                    const titleEl = document.querySelector('.product-title') || document.querySelector('.pb-title');
                    const name = titleEl ? titleEl.textContent.trim() : 'Baby Product';
                    
                    const priceEl = document.querySelector('.pb-new-price') || document.querySelector('.pb-price .new-price') || document.querySelector('.new-price');
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
                    
                    if (size === 'Select a size') {
                        if (typeof showToast === 'function') {
                            showToast('Please select a size first!', 'error');
                        } else {
                            alert('Please select a size first!');
                        }
                        
                        // Shake or highlight the size selector
                        const sizeHeader = document.querySelector('.pb-option-header');
                        if (sizeHeader) {
                            sizeHeader.style.borderBottom = '2px solid var(--terracotta)';
                            setTimeout(() => sizeHeader.style.borderBottom = '', 2000);
                        }
                        return;
                    }
                    
                    // Parse old price if it exists
                    const oldPriceEl = document.querySelector('.pb-old-price') || document.querySelector('.pb-price .old-price') || document.querySelector('.old-price');
                    const oldPrice = oldPriceEl ? parseInt(oldPriceEl.textContent.replace(/[^\d]/g, '')) || null : null;
                    
                    // ID from url pathname /product/id
                    const match = window.location.pathname.match(/\/product\/(\d+)/);
                    const id = match ? match[1] : 'current-product';
                    
                    addItemToCart(id, name, price, image, quantity, size, oldPrice);
                });
            }
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                const userDropdown = document.querySelector('.user-dropdown-card');
                const userTrigger = document.querySelector('.user-profile-trigger');
                if (userDropdown && userDropdown.classList.contains('active') && !userDropdown.contains(e.target) && (!userTrigger || !userTrigger.contains(e.target))) {
                    userDropdown.classList.remove('active');
                }
            });
        });

        // Authentication Modal Logic
        const authModal = document.getElementById('authModal');

        window.openAuthModal = function() {
            if (authModal) {
                authModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        };

        window.closeAuthModal = function() {
            if (authModal) {
                authModal.classList.remove('active');
                document.body.style.overflow = '';
            }
        };

        window.switchAuthTab = function(tab) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const tabLogin = document.getElementById('tab-login');
            const tabRegister = document.getElementById('tab-register');
            
            // Clear errors
            document.getElementById('loginError').style.display = 'none';
            document.getElementById('registerError').style.display = 'none';

            if (tab === 'login') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
                tabLogin.classList.add('active');
                tabRegister.classList.remove('active');
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                tabLogin.classList.remove('active');
                tabRegister.classList.add('active');
            }
        };

        window.handleAjaxLogin = function(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            const errorEl = document.getElementById('loginError');
            const submitBtn = e.target.querySelector('.auth-submit-btn');

            errorEl.style.display = 'none';
            submitBtn.disabled = true;
            submitBtn.textContent = 'SIGNING IN...';

            fetch('/login/ajax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email, password })
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.success) {
                    showToast("Welcome Back! 👋", data.message || "Logged in successfully.");
                    setTimeout(() => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            window.location.reload();
                        }
                    }, 1000);
                } else {
                    errorEl.textContent = data.message || "Invalid credentials. Please try again.";
                    errorEl.style.display = 'block';
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'SIGN IN';
                }
            })
            .catch(err => {
                errorEl.textContent = "An error occurred. Please try again later.";
                errorEl.style.display = 'block';
                submitBtn.disabled = false;
                submitBtn.textContent = 'SIGN IN';
            });
        };

        window.handleAjaxRegister = function(e) {
            e.preventDefault();
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const password_confirmation = document.getElementById('registerConfirmPassword').value;
            const errorEl = document.getElementById('registerError');
            const submitBtn = e.target.querySelector('.auth-submit-btn');

            errorEl.style.display = 'none';
            submitBtn.disabled = true;
            submitBtn.textContent = 'CREATING ACCOUNT...';

            fetch('/register/ajax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name, email, password, password_confirmation })
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.success) {
                    const loginSuccess = document.getElementById('loginSuccess');
                    loginSuccess.querySelector('span').textContent = data.message || "Account created. Verification email sent. Please verify your email, then login.";
                    loginSuccess.style.display = 'flex';
                    
                    document.getElementById('registerForm').reset();
                    switchAuthTab('login');
                    
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'CREATE ACCOUNT';
                } else {
                    // Display validation errors nicely
                    let errorMsg = data.message || "Failed to register account.";
                    if (data.errors) {
                        const firstErrorKey = Object.keys(data.errors)[0];
                        errorMsg = data.errors[firstErrorKey][0];
                    }
                    errorEl.textContent = errorMsg;
                    errorEl.style.display = 'block';
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'CREATE ACCOUNT';
                }
            })
            .catch(err => {
                errorEl.textContent = "An error occurred. Please try again later.";
                errorEl.style.display = 'block';
                submitBtn.disabled = false;
                submitBtn.textContent = 'CREATE ACCOUNT';
            });
        };

        window.handleAjaxLogout = function(e) {
            e.preventDefault();
            showToast("Signing out...", "Hope to see you again soon!");

            fetch('/logout/ajax', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                if (response.ok) {
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 800);
                }
            })
            .catch(err => {
                window.location.reload();
            });
        };

        // Auto open login modal if parameter is present in URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('open_login') === '1') {
            setTimeout(() => {
                if (window.openAuthModal) window.openAuthModal();
            }, 500);
        }

        // Search Overlay
        window.openSearchOverlay = function() {
            const overlay = document.getElementById('searchOverlay');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
            setTimeout(() => document.getElementById('searchOverlayInput').focus(), 100);
        };

        window.closeSearchOverlay = function(e) {
            if (e && e.target !== document.getElementById('searchOverlay')) return;
            const overlay = document.getElementById('searchOverlay');
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        };

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const overlay = document.getElementById('searchOverlay');
                if (overlay && overlay.classList.contains('open')) {
                    overlay.classList.remove('open');
                    document.body.style.overflow = '';
                }
            }
        });
    </script>
    @livewireScripts
</body>
</html>
