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

            <!-- Right Side: Details -->
            <div class="product-info-panel">
                <span class="product-tag">{{ $product['category'] }}</span>
                <h1 class="product-title">{{ $product['name'] }}</h1>
                
                <!-- Rating -->
                <div class="product-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-text">4.8 (12 Customer Reviews)</span>
                </div>

                <!-- Price -->
                <div class="product-price-box">
                    @if(isset($product['old_price']))
                        <span class="product-old-price">Rs. {{ number_format($product['old_price']) }}</span>
                        <span class="product-new-price">Rs. {{ number_format($product['price']) }}</span>
                        <span class="product-discount-badge">Save {{ round((($product['old_price'] - $product['price']) / $product['old_price']) * 100) }}%</span>
                    @else
                        <span class="product-new-price">Rs. {{ number_format($product['price']) }}</span>
                    @endif
                </div>

                <p class="product-description">{{ $product['description'] }}</p>

                <!-- Features list -->
                <ul class="product-features">
                    @foreach($product['features'] as $feature)
                        <li><i class="fa-solid fa-circle-check"></i> {{ $feature }}</li>
                    @endforeach
                </ul>

                <!-- Size Selector -->
                <div class="size-selector-section">
                    <div class="section-header">
                        <h3>Select Size</h3>
                        <a href="#sizeGuideModal" class="size-guide-link" onclick="openSizeGuide()">Size Guide</a>
                    </div>
                    <div class="size-options">
                        <label class="size-chip">
                            <input type="radio" name="size" value="newborn" checked>
                            <span>New Born</span>
                        </label>
                        <label class="size-chip">
                            <input type="radio" name="size" value="1-2y">
                            <span>1-2 Years</span>
                        </label>
                        <label class="size-chip">
                            <input type="radio" name="size" value="2-3y">
                            <span>2-3 Years</span>
                        </label>
                        <label class="size-chip">
                            <input type="radio" name="size" value="3-4y">
                            <span>3-4 Years</span>
                        </label>
                    </div>
                </div>

                <!-- Quantity & Add to Cart -->
                <div class="purchase-actions">
                    <div class="quantity-selector">
                        <button type="button" onclick="adjustQty(-1)"><i class="fas fa-minus"></i></button>
                        <input type="number" id="productQty" value="1" min="1" max="10" readonly>
                        <button type="button" onclick="adjustQty(1)"><i class="fas fa-plus"></i></button>
                    </div>
                    <button class="add-to-cart-btn">
                        <i class="fas fa-shopping-bag"></i> Add to Bag
                    </button>
                </div>

                <!-- Accordion details -->
                <div class="product-accordions">
                    <details open>
                        <summary>Fabric & Care <i class="fas fa-chevron-down"></i></summary>
                        <div class="accordion-content">
                            <p>We use only the softest cotton blends suited perfectly for delicate baby skin. Heavy-weight loopback lining provides ideal insulation without overheating.</p>
                            <ul>
                                <li>Wash cold on gentle cycle</li>
                                <li>Do not bleach or tumble dry</li>
                                <li>Iron on low heat if needed</li>
                            </ul>
                        </div>
                    </details>
                    <details>
                        <summary>Shipping & Returns <i class="fas fa-chevron-down"></i></summary>
                        <div class="accordion-content">
                            <p>We deliver all across Pakistan within 3-5 working days. Cash on delivery is fully available. Returns and exchanges are accepted within 14 days of purchase in original packaging.</p>
                        </div>
                    </details>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        @if(count($related) > 0)
        <section class="related-products-section">
            <h2 class="section-subtitle-related">You May Also Like</h2>
            <div class="related-grid">
                @foreach($related as $relId => $relProd)
                <div class="related-card">
                    <div class="related-img-wrapper">
                        @if(isset($relProd['old_price']))
                            <span class="rel-discount">-{{ round((($relProd['old_price'] - $relProd['price']) / $relProd['old_price']) * 100) }}%</span>
                        @endif
                        <a href="{{ route('product.show', $relId) }}">
                            <img src="{{ asset($relProd['image_path']) }}" alt="{{ $relProd['name'] }}" class="rel-product-img">
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
    </div>
</div>

<!-- Size Guide Modal -->
<div id="sizeGuideModal" class="size-modal">
    <div class="size-modal-content">
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
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript for Gallery & Quantity -->
<script>
    function switchView(imageUrl, element) {
        const mainImg = document.getElementById('mainProductImage');
        mainImg.src = imageUrl;
        
        // Update active class on thumbnails
        document.querySelectorAll('.thumb-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        element.classList.add('active');
    }

    function adjustQty(amount) {
        const qtyInput = document.getElementById('productQty');
        let currentQty = parseInt(qtyInput.value);
        let newQty = currentQty + amount;
        
        if (newQty >= 1 && newQty <= 10) {
            qtyInput.value = newQty;
        }
    }

    function openSizeGuide() {
        document.getElementById('sizeGuideModal').classList.add('active');
    }

    function closeSizeGuide() {
        document.getElementById('sizeGuideModal').classList.remove('active');
    }

    // Close modal if user clicks outside of it
    window.onclick = function(event) {
        const modal = document.getElementById('sizeGuideModal');
        if (event.target == modal) {
            modal.classList.remove('active');
        }
    }
</script>
@endsection
