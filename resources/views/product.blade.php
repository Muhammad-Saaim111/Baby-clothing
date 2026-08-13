@extends('layouts.app')

@section('title', $product['name'])

@section('content')
<div class="product-detail-page">
    <div class="container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <a href="/">Home</a>
            <i class="fas fa-chevron-right"></i>
            <a href="#">{{ $product['category'] }}</a>
            <i class="fas fa-chevron-right"></i>
            <span>{{ $product['name'] }}</span>
        </div>

        <!-- Product Main Section -->
        <div class="product-main-grid">
            <!-- Left Side: Split Gallery -->
            <div class="product-gallery">
                <!-- Main Image Container -->
                <div class="product-main-image-container">
                    <img id="mainProductImage" src="{{ asset($product['image_path']) }}" alt="{{ $product['name'] }}">
                </div>
                
                <!-- Thumbnails Container -->
                <div class="product-thumbnails">
                    @php
                        $base_image_path = str_replace('_front.jpg', '', $product['image_path']);
                    @endphp
                    <button class="thumb-btn active" onclick="switchView('{{ asset($base_image_path . '_front.jpg') }}', this)">
                        <div class="thumb-crop-wrapper">
                            <img src="{{ asset($base_image_path . '_front.jpg') }}" alt="Front View">
                        </div>
                        <span>Front View</span>
                    </button>
                    <button class="thumb-btn" onclick="switchView('{{ asset($base_image_path . '_back.jpg') }}', this)">
                        <div class="thumb-crop-wrapper">
                            <img src="{{ asset($base_image_path . '_back.jpg') }}" alt="Back View">
                        </div>
                        <span>Back View</span>
                    </button>
                    <button class="thumb-btn" onclick="switchView('{{ asset($base_image_path . '_lifestyle.jpg') }}', this)">
                        <div class="thumb-crop-wrapper">
                            <img src="{{ asset($base_image_path . '_lifestyle.jpg') }}" alt="Lifestyle View">
                        </div>
                        <span>Lifestyle</span>
                    </button>
                </div>
            </div>

            <!-- Right Side: Details (Prime Beds Card Style) -->
            <div class="product-info-panel">

                <!-- Product Title & Desc -->
                <h1 class="product-title">{{ $product['name'] }}</h1>
                
                <div class="product-stars-display" onclick="document.getElementById('reviewsSection').scrollIntoView({behavior: 'smooth'})" style="display: flex; align-items: center; gap: 6px; cursor: pointer; margin-bottom: 15px;">
                    <div class="stars" style="margin-bottom: 0 !important; display: inline-flex; gap: 2px;">
                        @php
                            $approvedReviews = $product->reviews()->where('status', 'approved')->get();
                            $avgRating = $approvedReviews->avg('rating') ?: 0;
                            $floorRating = floor($avgRating);
                            $reviewCount = $approvedReviews->count();
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $floorRating)
                                <i class="fa-solid fa-star"></i>
                            @elseif($i - 0.5 <= $avgRating)
                                <i class="fa-solid fa-star-half-stroke"></i>
                            @else
                                <i class="fa-regular fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span>{{ number_format($avgRating, 1) }} ({{ $reviewCount }} {{ Str::plural('Review', $reviewCount) }})</span>
                </div>

                <p class="product-description">{{ $product['description'] }}</p>

                <!-- Price Box (Prime Beds style) -->
                <div class="pb-price-box">
                    @if($product['stock'] <= 0)
                        <span class="pb-save-badge" style="background-color: var(--terracotta) !important; color: #fff !important; font-weight: 700; text-transform: uppercase;">OUT OF STOCK</span>
                    @endif
                    @if(isset($product['old_price']))
                        <span class="pb-old-price">Rs. {{ number_format($product['old_price']) }}</span>
                        <span class="pb-new-price">Rs. {{ number_format($product['price']) }}</span>
                        @if($product['stock'] > 0)
                            <span class="pb-save-badge">SAVE {{ round((($product['old_price'] - $product['price']) / $product['old_price']) * 100) }}%</span>
                        @endif
                    @else
                        <span class="pb-new-price">Rs. {{ number_format($product['price']) }}</span>
                    @endif
                </div>

                <!-- Options (Prime Beds accordion-row style) -->
                <div class="pb-option-rows">

                    <!-- Size Row -->
                    <div class="pb-option-row" id="sizeRow">
                        <div class="pb-option-header" onclick="togglePbOption('sizePanel')">
                            <span class="pb-option-label">+ Size <span class="req-star">*</span></span>
                            <span class="pb-option-selected" id="sizeSelected">Select a size</span>
                            <i class="fas fa-circle-check pb-check-icon" id="sizeCheck"></i>
                        </div>
                        <div class="pb-option-panel" id="sizePanel">
                            <div class="pb-size-grid">
                                @foreach($product['sizes'] ?? ['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y'] as $index => $size)
                                <label class="pb-size-chip">
                                    <input type="radio" name="size" value="{{ $size }}" onchange="selectSize('{{ $size }}')">
                                    <span>{{ str_replace('Y', ' Yr', $size) }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <!-- Stock indicator placed outside the collapsing panel but inside the size row container -->
                        <div id="stockIndicator" class="pb-stock-indicator" style="display: none; margin: 0 18px 14px;">
                            <span class="pulse-dot"></span>
                            <span id="stockIndicatorText"></span>
                        </div>
                    </div>

                    <!-- Fabric & Care Row -->
                    <div class="pb-option-row">
                        <div class="pb-option-header" onclick="togglePbOption('fabricPanel')">
                            <span class="pb-option-label">+ Fabric &amp; Care <span class="req-star">*</span></span>
                            <i class="fas fa-circle-check pb-check-icon active"></i>
                        </div>
                        <div class="pb-option-panel" id="fabricPanel">
                            <ul class="pb-info-list">
                                <li>We use only the softest cotton blends suited for delicate baby skin</li>
                                <li>Wash cold on gentle cycle</li>
                                <li>Do not bleach or tumble dry</li>
                                <li>Iron on low heat if needed</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Shipping Row -->
                    <div class="pb-option-row">
                        <div class="pb-option-header" onclick="togglePbOption('shippingPanel')">
                            <span class="pb-option-label">+ Shipping &amp; Returns <span class="req-star">*</span></span>
                            <i class="fas fa-circle-check pb-check-icon active"></i>
                        </div>
                        <div class="pb-option-panel" id="shippingPanel">
                            <p class="pb-info-text">Delivery across Pakistan within 3-5 working days. Cash on delivery available. Returns accepted within 14 days in original packaging.</p>
                        </div>
                    </div>

                </div>

                <!-- Qty + Add to Cart -->
                <div class="pb-purchase-row">
                    <div class="pb-qty-selector">
                        <button type="button" onclick="adjustQty(-1)"><i class="fas fa-minus"></i></button>
                        <input type="number" id="productQty" value="1" min="1" max="10" readonly>
                        <button type="button" onclick="adjustQty(1)"><i class="fas fa-plus"></i></button>
                    </div>
                    @if($product->stock > 0)
                        <button class="pb-add-to-cart-btn">
                            <i class="fas fa-shopping-cart"></i> ADD TO CART
                        </button>
                    @else
                        <button class="pb-add-to-cart-btn" style="background: #999; cursor: not-allowed;" disabled>
                            <i class="fas fa-ban"></i> OUT OF STOCK
                        </button>
                    @endif
                    <button class="grid-wishlist-btn absolute-wishlist" style="position: static; margin-left: 10px; width: 54px; height: 54px; display: flex; align-items: center; justify-content: center; border: 1px solid #dcdad5; border-radius: 8px; background: #fff; cursor: pointer; color: var(--dark-charcoal); font-size: 1.3rem; transition: all 0.2s;" data-id="{{ $product->id }}" title="Add to Wishlist" onclick="toggleWishlist(this, '{{ $product->id }}', '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ asset($product->image_path) }}')">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>

                <!-- Category Tag -->
                <div class="pb-category-tag">
                    <i class="fas fa-tag"></i>
                    <span>{{ $product['category'] }}</span>
                </div>

                <!-- Trust Badges -->
                <div class="pb-trust-badges">
                    <div class="pb-badge"><i class="fas fa-lock"></i> Secure Checkout</div>
                    <div class="pb-badge"><i class="fas fa-truck"></i> Fast Delivery</div>
                    <div class="pb-badge"><i class="fas fa-undo"></i> Easy Returns</div>
                    <div class="pb-badge"><i class="fas fa-headset"></i> 24/7 Support</div>
                </div>

            </div>

        </div>



        <!-- Related Products Section -->
        @if(count($related) > 0)
        <section class="related-products-section">
            <h2 class="section-subtitle-related">You May Also Like</h2>
            <div class="related-grid stagger-children">
                @foreach($related as $relId => $relProd)
                <div class="related-card">
                    <div class="related-img-wrapper">
                        @if(isset($relProd['old_price']))
                            <span class="rel-discount">-{{ round((($relProd['old_price'] - $relProd['price']) / $relProd['old_price']) * 100) }}%</span>
                        @endif
                        <a href="{{ route('product.show', $relId) }}" class="related-image-link">
                            <img src="{{ asset($relProd['image_path']) }}" alt="{{ $relProd['name'] }}" class="rel-product-img rel-img-front">
                            @php
                                $lifestyle_image = str_replace('_front.jpg', '_lifestyle.jpg', $relProd['image_path']);
                            @endphp
                            <img src="{{ asset($lifestyle_image) }}" alt="{{ $relProd['name'] }}" class="rel-product-img rel-img-lifestyle" onerror="this.style.display='none'">
                        </a>
                    </div>
                    <div class="rel-details">
                        <h4 class="rel-title"><a href="{{ route('product.show', $relId) }}">{{ $relProd['name'] }}</a></h4>
                        <div class="rel-price">
                            @if(isset($relProd['old_price']))
                                <span class="old-price">Rs. {{ number_format($relProd['old_price']) }}</span>
                            @endif
                            <span class="new-price">Rs. {{ number_format($relProd['price']) }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Customer Reviews Section -->
        <section class="reviews-section" id="reviewsSection">
            <livewire:submit-review :product="$product" />
            <livewire:product-reviews :product="$product" />
        </section>
    </div>
</div>

{{--
<!-- Size Guide Modal -->
<div id="sizeGuideModal" class="size-modal" onclick="closeSizeGuide(event)">
    <div class="size-modal-content" onclick="event.stopPropagation()">
        <span class="close-modal" onclick="closeSizeGuide()">&times;</span>
        <h2>Size Chart Guide</h2>
        <p>All measurements are in inches. Use this chart to find the perfect fit for your little one.</p>
        <table class="size-table">
            <thead>
                <tr>
                    <th>Age Bracket</th>
                    <th>Chest (in)</th>
                    <th>Length (in)</th>
                    <th>Sleeve (in)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>New Born</td>
                    <td>10.5</td>
                    <td>12.0</td>
                    <td>9.0</td>
                </tr>
                <tr>
                    <td>1-2 Years</td>
                    <td>11.5</td>
                    <td>14.0</td>
                    <td>11.5</td>
                </tr>
                <tr>
                    <td>2-3 Years</td>
                    <td>12.5</td>
                    <td>15.5</td>
                    <td>13.0</td>
                </tr>
                <tr>
                    <td>3-4 Years</td>
                    <td>13.5</td>
                    <td>17.0</td>
                    <td>14.5</td>
                </tr>
                <tr>
                    <td>5-6 Years</td>
                    <td>14.5</td>
                    <td>19.0</td>
                    <td>16.0</td>
                </tr>
                <tr>
                    <td>7-8 Years</td>
                    <td>15.5</td>
                    <td>21.0</td>
                    <td>17.5</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
--}}

<!-- JavaScript for Gallery & Quantity -->
<script>
    function switchView(imageUrl, element) {
        const mainImg = document.getElementById('mainProductImage');
        mainImg.style.opacity = '0';
        mainImg.style.transform = 'scale(0.96)';
        setTimeout(() => {
            mainImg.src = imageUrl;
            mainImg.style.objectPosition = 'center center';
            mainImg.style.opacity = '1';
            mainImg.style.transform = 'scale(1)';
        }, 180);
        document.querySelectorAll('.thumb-btn').forEach(btn => btn.classList.remove('active'));
        element.classList.add('active');
    }

    function adjustQty(amount) {
        const qtyInput = document.getElementById('productQty');
        let newQty = parseInt(qtyInput.value) + amount;
        if (newQty >= 1 && newQty <= 10) qtyInput.value = newQty;
    }

    function togglePbOption(panelId) {
        const panel = document.getElementById(panelId);
        if (!panel) return;
        const isOpen = panel.style.maxHeight && panel.style.maxHeight !== '0px';
        // close all panels
        document.querySelectorAll('.pb-option-panel').forEach(p => {
            p.style.maxHeight = '0px';
            p.style.opacity = '0';
            p.style.paddingTop = '0';
        });
        if (!isOpen) {
            panel.style.maxHeight = '500px';
            panel.style.opacity = '1';
            panel.style.paddingTop = '14px';
        }
    }

    function selectSize(size) {
        const label = document.getElementById('sizeSelected');
        const icon  = document.getElementById('sizeCheck');
        if (label) label.textContent = size.replace('Y', ' Yr');
        if (icon)  icon.classList.add('active');
        
        // Show stock indicator with mock dynamic count
        const stockInd = document.getElementById('stockIndicator');
        const stockText = document.getElementById('stockIndicatorText');
        if (stockInd && stockText) {
            const stockCount = Math.floor(Math.random() * 3) + 2; // 2, 3, or 4
            stockText.textContent = `Hurry! Only ${stockCount} items left in stock for size ${size.replace('Y', ' Yr')}!`;
            stockInd.style.display = 'flex';
        }

        // close size panel after selection
        const panel = document.getElementById('sizePanel');
        if (panel) {
            panel.style.maxHeight = '0px';
            panel.style.opacity = '0';
            panel.style.paddingTop = '0';
        }
    }

    // Review Star Rating Selector
    function selectFormRating(rating) {
        document.getElementById('ratingInput').value = rating;
        const stars = document.querySelectorAll('#starRatingSelector i');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('active');
                star.classList.remove('fa-regular');
                star.classList.add('fa-solid');
            } else {
                star.classList.remove('active');
                star.classList.remove('fa-solid');
                star.classList.add('fa-regular');
            }
        });
    }

    // Open size panel by default on load
    document.addEventListener('DOMContentLoaded', function() {
        togglePbOption('sizePanel');
    });
</script>

@endsection
