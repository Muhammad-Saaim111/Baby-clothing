@extends('layouts.app')

@section('title', $category . ' Collection')

@section('content')

@if($category === 'New Born' || $category === 'Accessories')
<div class="coming-soon-wrapper" style="text-align: center; padding: 120px 20px; background: #fffdfd; margin-top: 20px;">
    <i class="fa-solid fa-wand-magic-sparkles" style="font-size: 4rem; color: #ff8a8a; margin-bottom: 25px;"></i>
    <h2 style="font-family: 'Outfit', sans-serif; font-size: 3.5rem; color: #2d3748; margin-bottom: 15px;">Coming Soon!</h2>
    <p style="font-size: 1.2rem; color: #718096; max-width: 600px; margin: 0 auto 35px auto; line-height: 1.6;">We're currently stitching together something beautiful for this collection. Check back soon for our adorable new arrivals!</p>
    <a href="/" style="display: inline-block; background-color: #2d3748; color: white; padding: 14px 32px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 1rem; transition: background-color 0.3s ease;">Keep Exploring</a>
</div>
@else

@php
    $gender = $gender_slug ?? 'little-boys';
    $banner_img = ($gender === 'little-girls') ? 'assets/images/Aimee_Girls_Banner_High_Quality.png' : 'assets/images/Aimee_Boys_Banner_High_Quality.png';
@endphp

<div class="category-page">
    <!-- Premium Category Hero Header (Original Designed Banners with Rounded Corners and Spacing) -->
    <div class="category-banner-container">
        <div class="category-banner-bg" style="background-image: url('{{ asset($banner_img) }}'); aspect-ratio: 1717 / 916; min-height: auto; padding: 0;">
        </div>
    </div>

    <!-- Category Subnavigation Tabs Row -->
    <div class="category-subnav">
        <a href="{{ route('category.show', 'little-boys') }}" class="subnav-item {{ $gender === 'little-boys' ? 'active' : '' }}">
            <img src="{{ asset('assets/images/products/category_boys_mockup.png') }}" class="subnav-avatar" alt="Little Boys">
            <span>Little Boys</span>
        </a>
        <a href="{{ route('category.show', 'little-girls') }}" class="subnav-item {{ $gender === 'little-girls' ? 'active' : '' }}">
            <img src="{{ asset('assets/images/products/category_girls_mockup.png') }}" class="subnav-avatar" alt="Little Girls">
            <span>Little Girls</span>
        </a>
        <a href="{{ route('category.show', 'new-born') }}" class="subnav-item {{ $gender === 'new-born' ? 'active' : '' }}">
            <img src="{{ asset('assets/images/products/category_newborn_mockup.png') }}" class="subnav-avatar" alt="New Born">
            <span>New Born</span>
        </a>
        <a href="{{ route('category.show', 'accessories') }}" class="subnav-item {{ $gender === 'accessories' ? 'active' : '' }}">
            <img src="{{ asset('assets/images/products/category_accessories.jpg') }}" class="subnav-avatar" alt="Accessories">
            <span>Accessories</span>
        </a>
    </div>

    <!-- Main Catalog Container -->
    <div class="container main-catalog-container" id="catalog-start">
        
        <!-- Collapsible Filters & Header Toolbar -->
        <main class="catalog-main-content">
            
            <!-- Heading and Sub-details Row -->
            <div class="catalog-header-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
                <div class="catalog-header-info">
                    <h2 style="font-family: 'Fredoka', sans-serif; font-size: 2.2rem; font-weight: 700; color: #0c213d; margin: 0 0 5px;">{{ $category }} Collection</h2>
                    <p style="font-family: 'Outfit', sans-serif; font-size: 1rem; color: #718096; margin: 0;">Stylish, soft & made for little adventures.</p>
                </div>
                <div class="catalog-header-controls" style="display: flex; align-items: center; gap: 20px;">
                    <span class="results-count" id="resultsCount" style="font-family: 'Outfit', sans-serif; font-size: 0.95rem; font-weight: 600; color: #4a5568;">{{ count($products) }} Products</span>
                    
                    <div class="custom-sort-wrapper">
                        <span class="sort-label">Sort by:</span>
                        <select class="catalog-sort-select" id="sortSelect">
                            <option value="featured" selected>Featured</option>
                            <option value="relevant">Most relevant</option>
                            <option value="bestselling">Best selling</option>
                            <option value="price_asc">Price, low to high</option>
                            <option value="price_desc">Price, high to low</option>
                        </select>
                    </div>
                    
                    <div class="grid-switch-capsule">
                        <button class="layout-btn active" id="gridBtn4" onclick="setGridLayout(4)"><i class="fa-solid fa-table-cells-large"></i></button>
                        <button class="layout-btn" id="gridBtn3" onclick="setGridLayout(3)"><i class="fa-solid fa-bars"></i></button>
                    </div>
                </div>
            </div>

            <!-- Filters Toggle and Active Pills Row (Toolbar bar style matching mockup) -->
            <div class="filters-toolbar-bar">
                <button class="filter-toggle-btn" id="filterToggleBtn" onclick="toggleFiltersDrawer()">
                    <i class="fa-solid fa-bars" id="filterToggleIcon"></i>
                    <span>FILTERS</span>
                </button>
                
                <!-- Active Filters Pills container -->
                <div class="active-filters-scroll" id="activeFiltersBar">
                </div>
                
                <a class="clear-all-link" id="clearAllBtn" onclick="clearAllFilters()">Clear All</a>
            </div>

            <!-- Filters Collapsible Drawer Panel -->
            <div class="filters-drawer" id="filtersDrawer" style="display: none; height: 0; overflow: hidden; opacity: 0; padding: 0; margin-bottom: 0;">
                <div class="drawer-grid">
                    <!-- Col 1: Price Slider -->
                    <div class="drawer-col">
                        <h4>Filter by Price</h4>
                        <div class="price-range-slider-wrapper" style="padding-top: 10px;">
                            <input type="range" min="0" max="5000" value="5000" class="range-slider" id="priceRange" style="width: 100%; accent-color: #ff6f61;">
                            <div class="price-range-values" style="display: flex; justify-content: space-between; margin-top: 10px; font-family: 'Outfit', sans-serif; font-size: 0.9rem; color: #718096; font-weight: 500;">
                                <span>Rs. 0</span>
                                <span>Under Rs. <span id="priceValueText" style="font-weight: 700; color: #ff6f61;">5,000</span></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Col 2: Size Grid -->
                    <div class="drawer-col">
                        <h4>Filter by Size</h4>
                        <div class="size-filter-grid" id="sizeFilterGrid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px;">
                            <button class="size-btn active" data-size="all">All</button>
                            @if($category !== 'Little Boys' && $category !== 'Little Girls')
                                <button class="size-btn" data-size="1-2Y">1-2Y</button>
                            @endif
                            <button class="size-btn" data-size="2-3Y">2-3Y</button>
                            <button class="size-btn" data-size="3-4Y">3-4Y</button>
                            <button class="size-btn" data-size="4-5Y">4-5Y</button>
                            <button class="size-btn" data-size="5-6Y">5-6Y</button>
                            <button class="size-btn" data-size="6-7Y">6-7Y</button>
                            <button class="size-btn" data-size="7-8Y">7-8Y</button>
                        </div>
                    </div>
                    
                    <!-- Col 3: Tags Filter -->
                    <div class="drawer-col">
                        <h4>Filter by Type</h4>
                        <div class="quick-tags" id="quickTags" style="display: flex; flex-direction: column; gap: 8px;">
                            <button class="tag-btn active" data-tag="all">All Collection</button>
                            <button class="tag-btn" data-tag="featured">Featured Items</button>
                            <button class="tag-btn" data-tag="bestsellers">Best Sellers</button>
                            <button class="tag-btn" data-tag="new">New Arrivals</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Catalog Grid -->
            <div class="catalog-products-grid layout-4 stagger-children" id="productsGrid">
                @forelse($products as $prod)
                <div class="ms-card product-item" data-id="{{ $prod['id'] }}" data-price="{{ $prod['price'] }}" data-name="{{ strtolower($prod['name']) }}" data-sizes="{{ implode(',', $prod['sizes'] ?? []) }}">
                    <div class="ms-img-wrapper">
                        @if($prod['stock'] <= 0)
                            <span class="ms-discount" style="background-color: var(--terracotta) !important; font-weight: 700; text-transform: uppercase; font-size: 0.68rem; letter-spacing: 0.5px; border-radius: 4px; padding: 4px 8px;">Out of Stock</span>
                        @elseif(isset($prod['old_price']))
                            <span class="ms-discount">-{{ round((($prod['old_price'] - $prod['price']) / $prod['old_price']) * 100) }}%</span>
                        @endif
                        <button class="grid-wishlist-btn" data-id="{{ $prod['id'] }}" title="Add to Wishlist" onclick="toggleWishlist(this, '{{ $prod['id'] }}', '{{ addslashes($prod['name']) }}', {{ $prod['price'] }}, '{{ asset($prod['image_path']) }}')"><i class="fa-regular fa-heart"></i></button>
                        <button class="ms-quick-view" title="Quick View" data-id="{{ $prod['id'] }}" data-title="{{ $prod['name'] }}" data-price="{{ $prod['price'] }}" data-old-price="{{ $prod['old_price'] ?? '' }}" data-image="{{ asset($prod['image_path']) }}" data-category="{{ $prod['category'] ?? 'Apparel' }}" onclick="openQuickView(this)"><i class="fa-regular fa-eye"></i></button>
                        <a href="{{ route('product.show', $prod['id']) }}">
                            <img class="real-product-img" src="{{ asset($prod['image_path']) }}" alt="{{ $prod['name'] }}">
                        </a>
                        <div class="ms-quick-btn">
                            <a href="{{ route('product.show', $prod['id']) }}" class="quick-view-link">Quick View <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        
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
                        <div>
                            <!-- Star Rating -->
                            @php
                                $approvedReviews = $prod->reviews->where('status', 'approved');
                                $rating = $approvedReviews->avg('rating') ?: 0.0;
                                $reviews = $approvedReviews->count();
                            @endphp
                            <div class="ms-rating-row" style="display: flex; align-items: center; gap: 6px; margin-bottom: 6px;">
                                <div class="ms-stars" style="color: #FFA800; font-size: 0.78rem; display: flex; gap: 2px;">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $rating)
                                            <i class="fa-solid fa-star"></i>
                                        @elseif($i - 0.5 <= $rating)
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                        @else
                                            <i class="fa-regular fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="ms-review-count" style="font-size: 0.75rem; color: #9C8D89; font-weight: 500;">{{ number_format($rating, 1) }} ({{ $reviews }})</span>
                            </div>
                            
                            <h4 class="ms-title"><a href="{{ route('product.show', $prod['id']) }}">{{ $prod['name'] }}</a></h4>
                            
                            <!-- Price Row -->
                            <div class="ms-price-row">
                                <div class="ms-price">
                                    <span class="new-price">Rs. {{ number_format($prod['price']) }}</span>
                                    @if(isset($prod['old_price']))
                                        <span class="old-price" style="text-decoration: line-through; color: #a0aec0; font-size: 0.85rem; margin-left: 8px;">Rs. {{ number_format($prod['old_price']) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #718096; background: #f7fafc; border-radius: 12px; font-family: 'Outfit', sans-serif;">
                    <i class="fa-solid fa-box-open" style="font-size: 2.5rem; color: #cbd5e0; margin-bottom: 15px;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 10px; color: #4a5568;">No products found</h3>
                    <p>We couldn't find any products in this category right now.</p>
                </div>
                @endforelse
            </div>
        </main>
    </div>

    <!-- Bottom Adventures Promotional Banner -->
    <div class="bottom-promo-banner">
        <div class="bottom-promo-bg" style="background-image: url('{{ asset('assets/images/little_adventures_banner.jpg') }}');">
            <div class="bottom-promo-content">
                <h3>Little Adventures Start Here</h3>
                <p>Cozy layers for every little explorer.</p>

            </div>
        </div>
    </div>

    <!-- Trust Badges Bar Row -->
    <div class="trust-badges-bar">
        <div class="trust-badges-container">
            <div class="trust-badge-item">
                <i class="fa-solid fa-leaf"></i>
                <div class="trust-badge-text">
                    <strong>Premium Comfort</strong>
                    <span>Soft fabrics for delicate skin</span>
                </div>
            </div>
            <div class="trust-badge-item">
                <i class="fa-regular fa-face-smile"></i>
                <div class="trust-badge-text">
                    <strong>Parent Approved</strong>
                    <span>Loved by parents, worn by kids</span>
                </div>
            </div>
            <div class="trust-badge-item">
                <i class="fa-solid fa-truck-fast"></i>
                <div class="trust-badge-text">
                    <strong>Fast Delivery</strong>
                    <span>Quick & reliable shipping</span>
                </div>
            </div>
            <div class="trust-badge-item">
                <i class="fa-solid fa-rotate-left"></i>
                <div class="trust-badge-text">
                    <strong>Easy Returns</strong>
                    <span>Hassle-free 7-day returns</span>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    function setGridLayout(columns) {
        const grid = document.getElementById('productsGrid');
        const buttons = document.querySelectorAll('.grid-switch-capsule .layout-btn');
        
        if (columns === 3) {
            grid.classList.remove('layout-4');
            grid.classList.add('layout-3');
            if (buttons.length >= 2) {
                buttons[0].classList.remove('active');
                buttons[1].classList.add('active');
            }
        } else {
            grid.classList.remove('layout-3');
            grid.classList.add('layout-4');
            if (buttons.length >= 2) {
                buttons[1].classList.remove('active');
                buttons[0].classList.add('active');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const priceRange = document.getElementById('priceRange');
        const priceValueText = document.getElementById('priceValueText');
        const sortSelect = document.getElementById('sortSelect');
        const tagBtns = document.querySelectorAll('.tag-btn');
        const sizeBtns = document.querySelectorAll('.size-btn');
        const productsGrid = document.getElementById('productsGrid');
        const resultsCount = document.getElementById('resultsCount');
        
        // Convert NodeList to Array for easier sorting
        let products = Array.from(document.querySelectorAll('.product-item'));
        
        let activeTag = 'all';
        let activeSize = 'all';

        // Toggling filters panel
        window.toggleFiltersDrawer = function() {
            const drawer = document.getElementById('filtersDrawer');
            if (drawer.style.display === 'none') {
                drawer.style.display = 'block';
                // Trigger reflow
                drawer.offsetHeight;
                drawer.style.height = 'auto';
                drawer.style.opacity = '1';
                drawer.style.padding = '25px 35px';
                drawer.style.marginBottom = '25px';
            } else {
                drawer.style.height = '0';
                drawer.style.opacity = '0';
                drawer.style.padding = '0';
                drawer.style.marginBottom = '0';
                setTimeout(() => {
                    drawer.style.display = 'none';
                }, 400);
            }
        };

        // Active Filter Pills Generator
        function updateActiveFilterPills() {
            const activeFiltersBar = document.getElementById('activeFiltersBar');
            const clearAllBtn = document.getElementById('clearAllBtn');
            activeFiltersBar.innerHTML = '';
            
            let hasActiveFilters = false;
            
            // Price Filter
            const maxPrice = parseInt(priceRange.value);
            if (maxPrice < 5000) {
                hasActiveFilters = true;
                const pill = document.createElement('div');
                pill.className = 'filter-pill';
                pill.innerHTML = `
                    <span>Under Rs. ${maxPrice.toLocaleString()}</span>
                    <button class="remove-pill-btn" onclick="resetPriceFilter()">&times;</button>
                `;
                activeFiltersBar.appendChild(pill);
            }
            
            // Size Filter
            if (activeSize !== 'all') {
                hasActiveFilters = true;
                const pill = document.createElement('div');
                pill.className = 'filter-pill';
                pill.innerHTML = `
                    <span>Size: ${activeSize}</span>
                    <button class="remove-pill-btn" onclick="resetSizeFilter()">&times;</button>
                `;
                activeFiltersBar.appendChild(pill);
            }
            
            // Tag Filter
            if (activeTag !== 'all') {
                hasActiveFilters = true;
                const pill = document.createElement('div');
                pill.className = 'filter-pill';
                const labels = {
                    'featured': 'Featured',
                    'bestsellers': 'Best Sellers',
                    'new': 'New Arrivals'
                };
                pill.innerHTML = `
                    <span>Type: ${labels[activeTag] || activeTag}</span>
                    <button class="remove-pill-btn" onclick="resetTagFilter()">&times;</button>
                `;
                activeFiltersBar.appendChild(pill);
            }
            
            // Search Filter
            const searchTerm = searchInput ? searchInput.value.trim() : '';
            if (searchTerm) {
                hasActiveFilters = true;
                const pill = document.createElement('div');
                pill.className = 'filter-pill';
                pill.innerHTML = `
                    <span>Search: "${searchTerm}"</span>
                    <button class="remove-pill-btn" onclick="resetSearchFilter()">&times;</button>
                `;
                activeFiltersBar.appendChild(pill);
            }
            
            // Toggle Clear All Link visibility
            if (clearAllBtn) {
                if (hasActiveFilters) {
                    clearAllBtn.style.display = 'inline-block';
                } else {
                    clearAllBtn.style.display = 'none';
                }
            }
        }

        // Resets
        window.resetPriceFilter = function() {
            priceRange.value = 5000;
            priceValueText.innerText = '5,000';
            filterAndSortProducts();
        };
        
        window.resetSizeFilter = function() {
            sizeBtns.forEach(b => b.classList.remove('active'));
            const allSizeBtn = document.querySelector('.size-btn[data-size="all"]');
            if (allSizeBtn) allSizeBtn.classList.add('active');
            activeSize = 'all';
            filterAndSortProducts();
        };
        
        window.resetTagFilter = function() {
            tagBtns.forEach(b => b.classList.remove('active'));
            const allTagBtn = document.querySelector('.tag-btn[data-tag="all"]');
            if (allTagBtn) allTagBtn.classList.add('active');
            activeTag = 'all';
            filterAndSortProducts();
        };

        window.resetSearchFilter = function() {
            if (searchInput) searchInput.value = '';
            filterAndSortProducts();
        };
        
        window.clearAllFilters = function() {
            if (searchInput) searchInput.value = '';
            if (priceRange) {
                priceRange.value = 5000;
                priceValueText.innerText = '5,000';
            }
            sizeBtns.forEach(b => b.classList.remove('active'));
            const allSizeBtn = document.querySelector('.size-btn[data-size="all"]');
            if (allSizeBtn) allSizeBtn.classList.add('active');
            activeSize = 'all';
            
            tagBtns.forEach(b => b.classList.remove('active'));
            const allTagBtn = document.querySelector('.tag-btn[data-tag="all"]');
            if (allTagBtn) allTagBtn.classList.add('active');
            activeTag = 'all';
            
            filterAndSortProducts();
        };

        // Filter and Sort core logic
        function filterAndSortProducts() {
            const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const maxPrice = parseInt(priceRange.value);
            const sortOption = sortSelect.value;
            
            let visibleCount = 0;
            
            products.forEach(product => {
                const name = product.getAttribute('data-name');
                const price = parseInt(product.getAttribute('data-price'));
                const id = parseInt(product.getAttribute('data-id'));
                
                let isMatch = true;
                
                // Search filter
                if (searchTerm && !name.includes(searchTerm)) {
                    isMatch = false;
                }
                
                // Price filter
                if (price > maxPrice) {
                    isMatch = false;
                }
                
                // Tag filter
                if (activeTag === 'featured' && id % 2 !== 0) isMatch = false;
                if (activeTag === 'bestsellers' && id % 3 !== 0) isMatch = false;
                if (activeTag === 'new' && id < 10) isMatch = false;

                // Size filter
                if (activeSize !== 'all') {
                    const sizes = product.getAttribute('data-sizes') || '';
                    if (!sizes.includes(activeSize)) isMatch = false;
                }
                
                if (isMatch) {
                    product.style.display = 'flex';
                    visibleCount++;
                } else {
                    product.style.display = 'none';
                }
            });
            
            // Sorting visible elements
            const visibleProducts = products.filter(p => p.style.display !== 'none');
            
            visibleProducts.sort((a, b) => {
                const priceA = parseInt(a.getAttribute('data-price'));
                const priceB = parseInt(b.getAttribute('data-price'));
                const idA = parseInt(a.getAttribute('data-id'));
                const idB = parseInt(b.getAttribute('data-id'));
                const nameA = a.getAttribute('data-name') || '';
                const nameB = b.getAttribute('data-name') || '';
                
                if (sortOption === 'price_asc') return priceA - priceB;
                if (sortOption === 'price_desc') return priceB - priceA;
                if (sortOption === 'featured') return (idA % 2) - (idB % 2) || idA - idB;
                
                if (sortOption === 'bestselling') {
                    const discountA = a.querySelector('.ms-discount') ? 1 : 0;
                    const discountB = b.querySelector('.ms-discount') ? 1 : 0;
                    return discountB - discountA || idB - idA;
                }
                
                return idA - idB; // 'relevant' default
            });
            
            // Re-append sorted elements to the DOM grid
            visibleProducts.forEach(product => productsGrid.appendChild(product));
            
            // Update counts & pills
            if (visibleCount > 0) {
                resultsCount.innerText = `${visibleCount} Products`;
            } else {
                resultsCount.innerText = `0 Products`;
            }
            
            updateActiveFilterPills();
        }

        // Event listeners
        if (searchInput) {
            searchInput.addEventListener('input', filterAndSortProducts);
        }
        
        if (priceRange) {
            priceRange.addEventListener('input', function() {
                priceValueText.innerText = parseInt(this.value).toLocaleString();
                filterAndSortProducts();
            });
        }
        
        if (sortSelect) {
            sortSelect.addEventListener('change', filterAndSortProducts);
        }
        
        tagBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                tagBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                activeTag = this.getAttribute('data-tag');
                filterAndSortProducts();
            });
        });

        sizeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                sizeBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                activeSize = this.getAttribute('data-size');
                filterAndSortProducts();
            });
        });

        // Initialize active pills
        updateActiveFilterPills();
    });
</script>
@endif
@endsection
