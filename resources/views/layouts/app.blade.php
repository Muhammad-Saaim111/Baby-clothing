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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=3.2">
</head>
<body>

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
                            <li><a href="{{ route('category.show', 'little-boys') }}">All Boys</a></li>
                            <li><a href="{{ route('category.show', 'little-boys') }}">Sweatshirts</a></li>
                            <li><a href="{{ route('category.show', 'little-boys') }}">Shirts</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown">
                        <a href="{{ route('category.show', 'little-girls') }}">Girls <i class="fas fa-chevron-down" style="font-size:0.7rem; margin-left:3px;"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('category.show', 'little-girls') }}">All Girls</a></li>
                            <li><a href="{{ route('category.show', 'little-girls') }}">Sweatshirts</a></li>
                            <li><a href="{{ route('category.show', 'little-girls') }}">Tops</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown">
                        <a href="{{ route('category.show', 'new-born') }}">New Born <i class="fas fa-chevron-down" style="font-size:0.7rem; margin-left:3px;"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('category.show', 'new-born') }}">All New Born</a></li>
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
    </footer>

    <!-- Scroll Reveal JavaScript -->
    <script>
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
        });
    </script>
</body>
</html>
