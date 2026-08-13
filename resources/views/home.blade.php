@extends('layouts.app')

@section('content')

    <section class="hero-section">
        <a href="{{ route('category.show', 'little-boys') }}" class="hero-slider" style="display: block; text-decoration: none;">
            <div class="hero-slide active">
                <div class="hero-bg" style="background-image: url('{{ asset('assets/images/untitled_design.jpg') }}');"></div>
            </div>
        </a>
    </section>

    {{--
    <!-- Brand Highlights -->
    <section class="brand-highlights">
        <div class="highlights-container">
            <!-- Card 1 -->
            <div class="highlight-card">
                <div class="highlight-icon-wrapper">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                <div class="highlight-text">
                    <h3>Cash On Delivery</h3>
                    <p>Available all over Pakistan</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="highlight-card">
                <div class="highlight-icon-wrapper">
                    <i class="fa-solid fa-rotate-left"></i>
                </div>
                <div class="highlight-text">
                    <h3>Money Back Guarantee</h3>
                    <p>We return money within 30 days</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="highlight-card">
                <div class="highlight-icon-wrapper">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div class="highlight-text">
                    <h3>24/7 Customer Support</h3>
                    <p>Friendly 24/7 customer support</p>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="highlight-card">
                <div class="highlight-icon-wrapper">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="highlight-text">
                    <h3>Secure Online Payment</h3>
                    <p>We possess SSL / Secure Certificate</p>
                </div>
            </div>
        </div>
    </section>
    --}}

    <!-- Shop by Category -->
    <section class="category-showcase">
        <div class="bg-blob blob-peach" style="top: 10%; left: -100px;"></div>
        <div class="bg-blob blob-gold" style="bottom: 10%; right: -80px;"></div>
        <div class="container">
            <div class="section-title text-center">
                <span class="section-tagline">Curated Collections</span>
                <h2>Shop by Category</h2>
                <div class="title-divider"></div>
            </div>
            
            <div class="deals-slider-container">
                <div class="slider-wrapper">
                    <div class="slider-track category-track stagger-children" id="catTrack">
                        <!-- Category 1 -->
                        <a href="#" class="showcase-card">
                            <div class="showcase-bg" style="background-image: url('{{ asset('assets/images/products/category_baby.jpg') }}');"></div>
                            <div class="showcase-overlay"></div>
                            <div class="showcase-content">
                                <span>Pure Comfort</span>
                                <h3>Baby (0-2 Years)</h3>
                                <span class="btn-text">Shop Now <i class="fa-solid fa-arrow-right"></i></span>
                            </div>
                        </a>
                        
                        <!-- Category 3 -->
                        <a href="#" class="showcase-card">
                            <div class="showcase-bg" style="background-image: url('{{ asset('assets/images/products/category_kids.jpg') }}');"></div>
                            <div class="showcase-overlay"></div>
                            <div class="showcase-content">
                                <span>Active Kids</span>
                                <h3>Kids (2-8 Years)</h3>
                                <span class="btn-text">Shop Now <i class="fa-solid fa-arrow-right"></i></span>
                            </div>
                        </a>
                        
                        <!-- Category 4 -->
                        <a href="#" class="showcase-card">
                            <div class="showcase-bg" style="background-image: url('{{ asset('assets/images/products/category_accessories.jpg') }}');"></div>
                            <div class="showcase-overlay"></div>
                            <div class="showcase-content">
                                <span>Finishing Touches</span>
                                <h3>Cute Accessories</h3>
                                <span class="btn-text">Shop Now <i class="fa-solid fa-arrow-right"></i></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Deals of the Week -->
    <section class="deals-section">
        <div class="bg-blob blob-olive" style="top: 20%; right: -50px;"></div>
        <div class="bg-blob blob-peach" style="bottom: 10%; left: -120px;"></div>
        <div class="container">
            <div class="section-title-row deals-title-row">
                <div class="section-title text-center" style="margin-bottom: 0;">
                    <span class="section-tagline">Limited Time Offers</span>
                    <h2>Deals Of The Week</h2>
                    <div class="title-divider"></div>
                </div>
                <a href="#" class="btn-link" style="color: var(--dark-charcoal); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; text-decoration: none; display: flex; align-items: center; gap: 8px;">VIEW ALL <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="deals-slider-container">
                <div class="slider-wrapper">
                    <div class="deals-grid slider-track deals-track stagger-children" id="dealsTrack">
                        <!-- Deal 1 -->
                        <div class="deal-card">
                            <div class="deal-bg" style="background-image: url('{{ asset('assets/images/deal_jumpsuits.jpg') }}');"></div>
                            <div class="deal-overlay"></div>
                            <div class="deal-content">
                                <span class="discount-badge">20% OFF</span>
                                <h3>Organic Jumpsuits</h3>
                                <p>Soft and gentle baby jumpsuits made from pure organic cotton.</p>
                                <a href="#" class="deal-btn">Shop Deal <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <!-- Deal 2 -->
                        <div class="deal-card">
                            <div class="deal-bg" style="background-image: url('{{ asset('assets/images/deal_knitwear.jpg') }}');"></div>
                            <div class="deal-overlay"></div>
                            <div class="deal-content">
                                <span class="discount-badge">15% OFF</span>
                                <h3>Cozy Autumn Knitwear</h3>
                                <p>Comfortable knit cardigans and sweaters for chilly evening outings.</p>
                                <a href="#" class="deal-btn">Shop Deal <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <!-- Deal 3 -->
                        <div class="deal-card">
                            <div class="deal-bg" style="background-image: url('{{ asset('assets/images/deal_playwear.jpg') }}');"></div>
                            <div class="deal-overlay"></div>
                            <div class="deal-content">
                                <span class="discount-badge">30% OFF</span>
                                <h3>Summer Playwear</h3>
                                <p>Lightweight and breathable cotton outfits perfect for active toddlers.</p>
                                <a href="#" class="deal-btn">Shop Deal <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <!-- Deal 4 -->
                        <div class="deal-card">
                            <div class="deal-bg" style="background-image: url('{{ asset('assets/images/deal_sleepwear.jpg') }}');"></div>
                            <div class="deal-overlay"></div>
                            <div class="deal-content">
                                <span class="discount-badge">Buy 1 Get 1</span>
                                <h3>Organic Sleepwear</h3>
                                <p>Keep your baby snug and comfortable all night long.</p>
                                <a href="#" class="deal-btn">Shop Deal <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .deals-slider-container {
            position: relative;
            width: 100%;
        }
        .slider-wrapper {
            overflow: hidden;
            width: 100%;
            padding: 10px 0;
        }
        .slider-track {
            display: flex !important;
            gap: 30px;
            transition: transform 0.5s ease-in-out;
            width: 100%;
        }
        .deals-track {
            transition: transform 0.35s cubic-bezier(0.25, 1, 0.5, 1) !important;
        }
        .category-track {
            transition: transform 0.35s cubic-bezier(0.25, 1, 0.5, 1) !important;
        }
        .deals-track .deal-card {
            flex: 0 0 calc(50% - 15px) !important;
            display: flex !important;
        }
        .category-track .showcase-card {
            flex: 0 0 calc(33.333% - 20px) !important;
            display: flex !important;
            height: 450px;
        }
        @media (max-width: 992px) {
            .deals-track .deal-card {
                flex: 0 0 100% !important;
            }
            .category-track .showcase-card {
                flex: 0 0 calc(50% - 15px) !important;
            }
        }
        @media (max-width: 576px) {
            .category-track .showcase-card {
                flex: 0 0 100% !important;
            }
        }
        
        /* Most Selling Products Slider */
        .ms-track .ms-card {
            flex: 0 0 calc(33.333% - 20px) !important;
            display: flex !important;
            flex-direction: column;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--border-soft);
            box-shadow: 0 4px 15px rgba(108, 132, 119, 0.03);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .ms-track .ms-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(108, 132, 119, 0.1);
            border-color: rgba(108, 132, 119, 0.25);
        }
        .ms-img-wrapper {
            position: relative;
            width: 100%;
            padding-top: 133%;
            overflow: hidden;
        }
        .absolute-wishlist {
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
        .ms-img-wrapper:hover .absolute-wishlist {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        .absolute-wishlist:hover {
            color: #ff4747 !important;
            border-color: #ff4747 !important;
        }
        .absolute-wishlist i.fa-solid {
            color: #ff4747 !important;
        }
        .ms-img-wrapper img {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            object-fit: contain;
            background: #ffffff;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .ms-track .ms-card:hover .ms-img-wrapper img {
            transform: scale(1.05);
        }
        .ms-discount {
            position: absolute;
            top: 10px; right: 10px;
            background: var(--accent-peach);
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
            box-shadow: 0 4px 8px rgba(211, 158, 130, 0.2);
        }
        .ms-details {
            padding: 18px 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            background: #ffffff;
        }
        .ms-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .ms-title {
            font-size: 0.92rem;
            font-weight: 400;
            margin: 0;
            color: var(--dark-charcoal);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: color 0.3s;
        }
        .ms-track .ms-card:hover .ms-title {
            color: var(--accent-peach);
        }
        @keyframes heartbeat {
            0% { transform: scale(1); }
            14% { transform: scale(1.25); }
            28% { transform: scale(1); }
            42% { transform: scale(1.25); }
            70% { transform: scale(1); }
        }
        .ms-wishlist:hover {
            color: #e28d75;
            transform: scale(1.1);
        }
        .ms-wishlist:hover i {
            animation: heartbeat 1.2s infinite;
        }
        .ms-price {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }
        .old-price {
            text-decoration: line-through;
            color: var(--slate-gray);
            opacity: 0.7;
            font-size: 0.8rem;
        }
        .new-price {
            font-weight: 700;
            color: var(--dark-charcoal);
            font-size: 1rem;
        }
        @media (max-width: 992px) {
            .ms-track .ms-card { flex: 0 0 calc(50% - 15px) !important; }
        }
        @media (max-width: 768px) {
            .ms-track .ms-card { flex: 0 0 calc(50% - 15px) !important; }
        }
        @media (max-width: 576px) {
            .ms-track .ms-card { flex: 0 0 100% !important; }
        }
        
        /* Featured Categories Tabs */
        .fc-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-soft);
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .fc-title {
            font-size: 1.5rem;
            font-weight: 500;
            color: var(--dark-charcoal);
            margin: 0;
            position: relative;
        }
        .fc-title::after {
            content: '';
            position: absolute;
            bottom: -16px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #C7AE8D;
        }
        .fc-tabs {
            display: flex;
            gap: 20px;
        }
        .fc-tab {
            background: none;
            border: none;
            font-size: 0.95rem;
            color: var(--text-gray);
            cursor: pointer;
            padding: 5px 0 16px 0;
            margin-bottom: -16px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }
        .fc-tab:hover, .fc-tab.active {
            color: var(--dark-charcoal);
        }
        .fc-tab.active {
            border-bottom: 2px solid #C7AE8D;
        }
        .fc-track .ms-card {
            flex: 0 0 calc(33.333% - 20px) !important;
        }
        .fc-content {
            display: none;
        }
        .fc-content.active {
            display: block;
        }
        @media (max-width: 1200px) { .fc-track .ms-card { flex: 0 0 calc(33.333% - 20px) !important; } }
        @media (max-width: 992px) { .fc-track .ms-card { flex: 0 0 calc(50% - 15px) !important; } }
        @media (max-width: 768px) { .fc-track .ms-card { flex: 0 0 calc(50% - 15px) !important; } }
        @media (max-width: 576px) { .fc-track .ms-card { flex: 0 0 100% !important; } }
    </style>

    <script>
        function openCategory(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("fc-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("fc-tab");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(categoryName).classList.add("active");
            evt.currentTarget.classList.add("active");
            
            setTimeout(function() {
                window.dispatchEvent(new Event('resize'));
            }, 50);
        }
        function initSlider(trackId, intervalTime) {
            const track = document.getElementById(trackId);
            if (!track) return;
            const cards = track.children;
            
            let currentIndex = 0;
            let slideInterval;
            
            function getItemsPerView() {
                if (!cards.length) return 1;
                const containerWidth = track.parentElement.offsetWidth;
                const cardWidth = cards[0].offsetWidth;
                // Add gap to both container and card for accurate calculation
                return Math.round((containerWidth + 30) / (cardWidth + 30)) || 1;
            }
            
            function updateSlider() {
                const itemWidth = cards[0].offsetWidth;
                const gap = 30; // matched from css gap
                const moveAmount = itemWidth + gap;
                track.style.transform = `translateX(-${currentIndex * moveAmount}px)`;
            }
            
            function nextSlide() {
                const itemsPerView = getItemsPerView();
                if (currentIndex < cards.length - itemsPerView) {
                    currentIndex++;
                } else {
                    currentIndex = 0; // loop back
                }
                updateSlider();
            }
            
            function startInterval() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, intervalTime);
            }
            
            startInterval();
            
            // Pause auto-sliding on hover
            track.addEventListener('mouseenter', () => {
                clearInterval(slideInterval);
            });
            
            // Resume auto-sliding on mouse leave
            track.addEventListener('mouseleave', () => {
                startInterval();
            });

            window.addEventListener('resize', updateSlider);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Init Sliders
            initSlider('dealsTrack', 2500);
            initSlider('catTrack', 2500);
            initSlider('msTrack', 4000);
            
            // Init Featured Categories Tab Sliders
            initSlider('fcTrack1', 4000);
            initSlider('fcTrack2', 4000);
            initSlider('fcTrack3', 4000);
        });
    </script>



    <!-- Most Selling Products -->
    <section class="most-selling" style="padding: 20px 0; background: var(--white);">
        <div class="bg-blob blob-gold" style="top: 5%; left: -90px;"></div>
        <div class="bg-blob blob-olive" style="bottom: 5%; right: -100px;"></div>
        <div class="container">
            <div class="section-title-row" style="display: flex; justify-content: space-between; align-items: baseline; border-bottom: 1px solid var(--border-soft); padding-bottom: 15px; margin-bottom: 30px;">
                <h2 style="font-size: 1.5rem; font-weight: 500; color: var(--dark-charcoal); margin: 0; position: relative; display: inline-block;">
                    Most Selling Products
                    <span style="position: absolute; bottom: -16px; left: 0; width: 100%; height: 2px; background: #C7AE8D;"></span>
                </h2>
                <a href="#" class="btn-link" style="color: var(--dark-charcoal); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; text-decoration: none; display: flex; align-items: center; gap: 8px;">VIEW ALL <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            
            <div class="slider-container" style="position: relative;">
                <div class="slider-wrapper">
                    <div class="slider-track ms-track stagger-children" id="msTrack">
                        @foreach($products as $prodId => $prod)
                        <div class="ms-card" data-id="{{ $prodId }}" data-sizes="{{ implode(',', $prod->sizes ?? []) }}">
                            <div class="ms-img-wrapper">
                                @if($prod['stock'] <= 0)
                                    <span class="ms-discount" style="background-color: var(--terracotta) !important; font-weight: 700; text-transform: uppercase; font-size: 0.68rem; letter-spacing: 0.5px; border-radius: 4px; padding: 4px 8px;">Out of Stock</span>
                                @elseif(isset($prod['old_price']))
                                    <span class="ms-discount">-{{ round((($prod['old_price'] - $prod['price']) / $prod['old_price']) * 100) }}%</span>
                                @endif
                                <button class="ms-wishlist absolute-wishlist" data-id="{{ $prodId }}" title="Add to Wishlist" onclick="toggleWishlist(this, '{{ $prodId }}', '{{ addslashes($prod['name']) }}', {{ $prod['price'] }}, '{{ asset($prod['image_path']) }}')"><i class="fa-regular fa-heart"></i></button>
                                <button class="ms-quick-view" title="Quick View" data-id="{{ $prodId }}" data-title="{{ $prod['name'] }}" data-price="{{ $prod['price'] }}" data-old-price="{{ $prod['old_price'] ?? '' }}" data-image="{{ asset($prod['image_path']) }}" data-category="{{ $prod['category'] ?? 'Apparel' }}" onclick="openQuickView(this)"><i class="fa-regular fa-eye"></i></button>
                                <a href="{{ route('product.show', $prodId) }}">
                                    <img class="real-product-img primary-img" src="{{ asset($prod['image_path']) }}" alt="{{ $prod['name'] }}">
                                    <img class="real-product-img lifestyle-img" src="{{ asset(str_replace('_front.jpg', '_lifestyle.jpg', $prod['image_path'])) }}" alt="{{ $prod['name'] }}">
                                </a>

                                <!-- Quick Add Size/Qty Overlay -->
                                <div class="quick-add-overlay">
                                    <div class="qa-sizes-title">Select Size</div>
                                    <div class="qa-sizes-list">
                                        @foreach($prod->sizes ?? [] as $size)
                                            <button type="button" class="qa-size-btn" onclick="selectQuickAddSize(this, '{{ $size }}')">{{ $size }}</button>
                                        @endforeach
                                    </div>
                                    <div class="qa-qty-row">
                                        <span>Quantity:</span>
                                        <div class="qa-qty-selector">
                                            <button type="button" onclick="adjustQuickAddQty(this, -1)">-</button>
                                            <input type="number" class="qa-qty-input" value="1" min="1" max="10" readonly>
                                            <button type="button" onclick="adjustQuickAddQty(this, 1)">+</button>
                                        </div>
                                    </div>
                                    <div class="qa-actions">
                                        <button type="button" class="qa-cancel-btn" onclick="closeQuickAddOverlay(this, event)">CANCEL</button>
                                        <button type="button" class="qa-add-btn" onclick="submitQuickAddToCart(this, event)">ADD</button>
                                    </div>
                                </div>
                            </div>
                            <div class="ms-details">
                                <h4 class="ms-title"><a href="{{ route('product.show', $prodId) }}">{{ $prod['name'] }}</a></h4>
                                <div class="ms-price-row">
                                    <div class="ms-price">
                                        @if(isset($prod['old_price']))
                                            <span class="old-price">Rs. {{ number_format($prod['old_price']) }}</span>
                                        @endif
                                        <span class="new-price">Rs. {{ number_format($prod['price']) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 
    <!-- Featured Categories Tabs -->
    <section class="featured-categories" style="padding: 60px 0; background: var(--white);">
        <div class="container">
            <div class="fc-header">
                <h2 class="fc-title">Featured Categories</h2>
                <div class="fc-tabs">
                    <button class="fc-tab active" onclick="openCategory(event, 'BabyBoys')">Little Boys</button>
                    <button class="fc-tab" onclick="openCategory(event, 'BabyGirls')">Little Girls</button>
                    <button class="fc-tab" onclick="openCategory(event, 'Accessories')">Accessories</button>
                </div>
            </div>
            
            <div id="BabyBoys" class="fc-content active">
                <div class="slider-container" style="position: relative;">
                    <div class="slider-wrapper">
                        <div class="slider-track fc-track" id="fcTrack1">
                            @foreach($products as $prodId => $prod)
                                @if($prod['category'] === 'Little Boys')
                                <div class="ms-card">
                                    <div class="ms-img-wrapper">
                                        @if(isset($prod['old_price']))
                                            <span class="ms-discount">-{{ round((($prod['old_price'] - $prod['price']) / $prod['old_price']) * 100) }}%</span>
                                        @endif
                                        <button class="ms-wishlist absolute-wishlist" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
                                        <button class="ms-quick-view fc-quick-view" title="Quick View" data-id="{{ $prodId }}" data-title="{{ $prod['name'] }}" data-price="{{ $prod['price'] }}" data-old-price="{{ $prod['old_price'] ?? '' }}" data-image="{{ asset($prod['image_path']) }}" data-category="{{ $prod['category'] ?? 'Apparel' }}" onclick="openQuickView(this)"><i class="fa-regular fa-eye"></i></button>
                                        <a href="{{ route('product.show', $prodId) }}">
                                            <img class="real-product-img primary-img" src="{{ asset($prod['image_path']) }}" alt="{{ $prod['name'] }}">
                                            <img class="real-product-img lifestyle-img" src="{{ asset(str_replace('_front.jpg', '_lifestyle.jpg', $prod['image_path'])) }}" alt="{{ $prod['name'] }}">
                                        </a>
                                    </div>
                                    <div class="ms-details">
                                        <div class="ms-header">
                                            <h4 class="ms-title"><a href="{{ route('product.show', $prodId) }}">{{ $prod['name'] }}</a></h4>
                                        </div>
                                        <div class="ms-price">
                                            @if(isset($prod['old_price']))
                                                <span class="old-price">Rs. {{ number_format($prod['old_price']) }}</span>
                                            @endif
                                            <span class="new-price">Rs. {{ number_format($prod['price']) }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div id="BabyGirls" class="fc-content">
                <div class="slider-container" style="position: relative;">
                    <div class="slider-wrapper">
                        <div class="slider-track fc-track" id="fcTrack2">
                            @foreach($products as $prodId => $prod)
                                @if($prod['category'] === 'Little Girls')
                                <div class="ms-card">
                                    <div class="ms-img-wrapper">
                                        @if(isset($prod['old_price']))
                                            <span class="ms-discount">-{{ round((($prod['old_price'] - $prod['price']) / $prod['old_price']) * 100) }}%</span>
                                        @endif
                                        <button class="ms-wishlist absolute-wishlist" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></button>
                                        <button class="ms-quick-view fc-quick-view" title="Quick View" data-id="{{ $prodId }}" data-title="{{ $prod['name'] }}" data-price="{{ $prod['price'] }}" data-old-price="{{ $prod['old_price'] ?? '' }}" data-image="{{ asset($prod['image_path']) }}" data-category="{{ $prod['category'] ?? 'Apparel' }}" onclick="openQuickView(this)"><i class="fa-regular fa-eye"></i></button>
                                        <a href="{{ route('product.show', $prodId) }}">
                                            <img class="real-product-img primary-img" src="{{ asset($prod['image_path']) }}" alt="{{ $prod['name'] }}">
                                            <img class="real-product-img lifestyle-img" src="{{ asset(str_replace('_front.jpg', '_lifestyle.jpg', $prod['image_path'])) }}" alt="{{ $prod['name'] }}">
                                        </a>
                                    </div>
                                    <div class="ms-details">
                                        <div class="ms-header">
                                            <h4 class="ms-title"><a href="{{ route('product.show', $prodId) }}">{{ $prod['name'] }}</a></h4>
                                        </div>
                                        <div class="ms-price">
                                            @if(isset($prod['old_price']))
                                                <span class="old-price">Rs. {{ number_format($prod['old_price']) }}</span>
                                            @endif
                                            <span class="new-price">Rs. {{ number_format($prod['price']) }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div id="Accessories" class="fc-content">
                <div class="slider-container" style="position: relative;">
                    <div class="slider-wrapper">
                        <div class="slider-track fc-track" id="fcTrack3">
                            <!-- Product 1 -->
                            <div class="ms-card">
                                <div class="ms-img-wrapper"><span class="ms-discount">-30%</span><button class="ms-wishlist absolute-wishlist" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></button><img src="https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=400&q=80" alt="Accessories"></div>
                                <div class="ms-details"><div class="ms-header"><h4 class="ms-title">Bunny Booties</h4></div><div class="ms-price"><span class="old-price">Rs. 500</span><span class="new-price">Rs. 350</span></div></div>
                            </div>
                            <!-- Product 2 -->
                            <div class="ms-card">
                                <div class="ms-img-wrapper"><span class="ms-discount">-10%</span><button class="ms-wishlist absolute-wishlist" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></button><img src="https://images.unsplash.com/photo-1622290291468-a28f7a7dc6a8?auto=format&fit=crop&w=400&q=80" alt="Accessories"></div>
                                <div class="ms-details"><div class="ms-header"><h4 class="ms-title">Knitted Cap</h4></div><div class="ms-price"><span class="old-price">Rs. 600</span><span class="new-price">Rs. 500</span></div></div>
                            </div>
                            <!-- Product 3 -->
                            <div class="ms-card">
                                <div class="ms-img-wrapper"><span class="ms-discount">-15%</span><button class="ms-wishlist absolute-wishlist" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></button><img src="https://images.unsplash.com/photo-1596870230751-ebdfce98ec42?auto=format&fit=crop&w=400&q=80" alt="Accessories"></div>
                                <div class="ms-details"><div class="ms-header"><h4 class="ms-title">Mittens Set</h4></div><div class="ms-price"><span class="old-price">Rs. 400</span><span class="new-price">Rs. 340</span></div></div>
                            </div>
                            <!-- Product 4 -->
                            <div class="ms-card">
                                <div class="ms-img-wrapper"><span class="ms-discount">-25%</span><button class="ms-wishlist absolute-wishlist" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></button><img src="https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?auto=format&fit=crop&w=400&q=80" alt="Accessories"></div>
                                <div class="ms-details"><div class="ms-header"><h4 class="ms-title">Soft Blanket</h4></div><div class="ms-price"><span class="old-price">Rs. 1,500</span><span class="new-price">Rs. 1,125</span></div></div>
                            </div>
                            <!-- Product 5 -->
                            <div class="ms-card">
                                <div class="ms-img-wrapper"><span class="ms-discount">-5%</span><button class="ms-wishlist absolute-wishlist" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></button><img src="https://images.unsplash.com/photo-1522771930-78848d9293e8?auto=format&fit=crop&w=400&q=80" alt="Accessories"></div>
                                <div class="ms-details"><div class="ms-header"><h4 class="ms-title">Baby Socks</h4></div><div class="ms-price"><span class="old-price">Rs. 300</span><span class="new-price">Rs. 280</span></div></div>
                            </div>
                            <!-- Product 6 -->
                            <div class="ms-card">
                                <div class="ms-img-wrapper"><span class="ms-discount">-30%</span><button class="ms-wishlist absolute-wishlist" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></button><img src="https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=400&q=80" alt="Accessories"></div>
                                <div class="ms-details"><div class="ms-header"><h4 class="ms-title">Teddy Bear</h4></div><div class="ms-price"><span class="old-price">Rs. 500</span><span class="new-price">Rs. 350</span></div></div>
                            </div>
                            <!-- Product 7 -->
                            <div class="ms-card">
                                <div class="ms-img-wrapper"><span class="ms-discount">-10%</span><button class="ms-wishlist absolute-wishlist" title="Add to Wishlist"><i class="fa-regular fa-heart"></i></button><img src="https://images.unsplash.com/photo-1622290291468-a28f7a7dc6a8?auto=format&fit=crop&w=400&q=80" alt="Accessories"></div>
                                <div class="ms-details"><div class="ms-header"><h4 class="ms-title">Winter Cap</h4></div><div class="ms-price"><span class="old-price">Rs. 600</span><span class="new-price">Rs. 500</span></div></div>
                            </div>
                            <!-- Product 8 -->
                            <div class="ms-card">
                                <div class="ms-img-wrapper"><span class="ms-discount">-15%</span><img src="https://images.unsplash.com/photo-1596870230751-ebdfce98ec42?auto=format&fit=crop&w=400&q=80" alt="Accessories"></div>
                                <div class="ms-details"><div class="ms-header"><h4 class="ms-title">Woolen Mittens</h4><button class="ms-wishlist"><i class="fa-regular fa-heart"></i></button></div><div class="ms-price"><span class="old-price">Rs. 400</span><span class="new-price">Rs. 340</span></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    --}}

    <!-- Banner Middle / Video style visual -->
    <section class="visual-promotion">
        <div class="promo-bg" style="background-image: url('{{ asset('assets/images/products/Generated Image August 05, 2026 - 6_54PM.jpg') }}');"></div>
        <div class="promo-overlay"></div>
        <div class="promo-content">
            <span class="promo-tag">Ethically Made</span>
            <h2>Created With Extra Love & Gentle Fabrics</h2>
            <p>Every piece in our shop is sourced from certified manufacturers using non-toxic dyes, because your baby deserves the absolute best.</p>
            <a href="#" class="btn btn-luxury-reverse">Our Story</a>
        </div>
    </section>

    <!-- Testimonials Section (Primebeds Style) -->
    <section class="testimonials-section">
        <div class="bg-blob blob-peach" style="top: 15%; right: -70px;"></div>
        <div class="bg-blob blob-gold" style="bottom: 15%; left: -110px;"></div>
        <div class="container">
            <div class="section-title text-center">
                <span class="section-tagline">Happy Parents</span>
                <h2>What They Say About Us</h2>
                <div class="title-divider"></div>
            </div>

            <div class="testimonials-grid stagger-children">
                <!-- Review 1 -->
                <div class="testimonial-card">
                    <i class="fa-solid fa-quote-right quote-bg-icon"></i>
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="review-text">"The cotton is unbelievably soft! It washes incredibly well and doesn't lose its shape or softness. Highly recommend to all new parents."</p>
                    <div class="reviewer-info">
                        <div class="reviewer-profile">
                            <div class="reviewer-avatar avatar-peach">S</div>
                            <div class="reviewer-meta">
                                <span class="reviewer-name">Sarah M.</span>
                                <span class="verified-badge"><i class="fa-solid fa-circle-check"></i> Verified Buyer</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="testimonial-card">
                    <i class="fa-solid fa-quote-right quote-bg-icon"></i>
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="review-text">"Absolutely love the design aesthetic. Very minimal, elegant, and fits my baby perfectly. The packaging was beautiful too!"</p>
                    <div class="reviewer-info">
                        <div class="reviewer-profile">
                            <div class="reviewer-avatar avatar-terracotta">E</div>
                            <div class="reviewer-meta">
                                <span class="reviewer-name">Emma R.</span>
                                <span class="verified-badge"><i class="fa-solid fa-circle-check"></i> Verified Buyer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
