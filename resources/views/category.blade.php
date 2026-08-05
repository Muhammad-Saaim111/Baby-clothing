@extends('layouts.app')

@section('title', $category . ' Collection')

@section('content')
<div class="category-page">
    <!-- Category Hero Header (Primebeds Style) -->
    <div class="category-hero" style="background-image: url('{{ ($gender_slug === 'little-boys' || $gender_slug === 'little boys') ? 'https://images.unsplash.com/photo-1758782213532-bbb5fd89885e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80' : asset('assets/images/little_girls_banner.png') }}'); background-position: {{ ($gender_slug === 'little-boys' || $gender_slug === 'little boys') ? 'center 30%' : 'center 20%' }};">
        <div class="hero-overlay"></div>
        <div class="category-hero-content">
            <h1>& {{ $category }}</h1>
            <p>Handcrafted for comfort, designed for style. Find your perfect fit.</p>
            <div class="hero-breadcrumbs">
                <a href="/">Home</a> / <span>{{ $category }}</span>
            </div>
        </div>
    </div>

    <div class="container main-catalog-container">
        <!-- Sidebar Filter (Left Side) -->
        <aside class="catalog-sidebar">
            <!-- Shop Categories Box -->
            <div class="sidebar-box">
                <h3 class="box-title">Shop Categories <i class="fas fa-chevron-down"></i></h3>
                <div class="box-content">
                    <div class="search-category-input">
                        <input type="text" placeholder="Search products..." id="searchInput">
                        <i class="fas fa-search"></i>
                    </div>
                    <ul class="sidebar-category-list">
                        <li><a href="{{ route('category.show', 'shirts') }}" class="{{ $gender_slug === 'shirts' ? 'active' : '' }}">All Shirts</a></li>
                        <li><a href="{{ route('category.show', 'little-boys') }}" class="{{ $gender_slug === 'little-boys' ? 'active' : '' }}">Little Boys Collection</a></li>
                        <li><a href="{{ route('category.show', 'little-girls') }}" class="{{ $gender_slug === 'little-girls' ? 'active' : '' }}">Little Girls Collection</a></li>
                        <li><a href="#">New Born Wear</a></li>
                        <li><a href="#">Accessories</a></li>
                    </ul>
                </div>
            </div>

            <!-- Filter by Price Box -->
            <div class="sidebar-box">
                <h3 class="box-title">Filter by Price</h3>
                <div class="box-content">
                    <div class="price-range-slider-wrapper">
                        <input type="range" min="0" max="5000" value="5000" class="range-slider" id="priceRange">
                        <div class="price-range-values">
                            <span>0</span>
                            <span id="priceValueText">5,000</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter by Size Box -->
            <div class="sidebar-box">
                <h3 class="box-title">Filter by Size</h3>
                <div class="box-content">
                    <div class="size-filter-grid" id="sizeFilterGrid">
                        <button class="size-btn active" data-size="all">All</button>
                        <button class="size-btn" data-size="1-2Y">1-2Y</button>
                        <button class="size-btn" data-size="2-3Y">2-3Y</button>
                        <button class="size-btn" data-size="3-4Y">3-4Y</button>
                        <button class="size-btn" data-size="4-5Y">4-5Y</button>
                        <button class="size-btn" data-size="5-6Y">5-6Y</button>
                        <button class="size-btn" data-size="6-7Y">6-7Y</button>
                        <button class="size-btn" data-size="7-8Y">7-8Y</button>
                    </div>
                </div>
            </div>

            <!-- Need Help Box -->
            <div class="sidebar-box help-box">
                <div class="help-box-inner">
                    <i class="fa-solid fa-headset help-icon"></i>
                    <h4>Need Help?</h4>
                    <p>Our support team is ready to help you find the perfect size & fabric.</p>
                    <a href="#" class="help-btn">Contact Us</a>
                </div>
            </div>
        </aside>

        <!-- Right Side: Products Grid -->
        <main class="catalog-main-content">
            <!-- Toolbar / Filter Bar (Primebeds style) -->
            <div class="catalog-toolbar">
                <div class="toolbar-left">

                    <div class="quick-tags" id="quickTags">
                        <button class="tag-btn active" data-tag="all">All</button>
                        <button class="tag-btn" data-tag="featured">Featured</button>
                        <button class="tag-btn" data-tag="bestsellers">Best Sellers</button>
                        <button class="tag-btn" data-tag="toprated">Top Rated</button>
                        <button class="tag-btn" data-tag="new">New Arrival</button>
                    </div>
                </div>
                <div class="toolbar-right">
                    <select class="catalog-sort-select" id="sortSelect">
                        <option value="default">Default Sorting</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="newest">Newest First</option>
                    </select>
                    <span class="results-count" id="resultsCount">Showing 1-{{ count($products) }} of {{ count($products) }}</span>
                    <div class="grid-layout-btns">
                        <button class="layout-btn active" onclick="setGridLayout(3)"><i class="fas fa-th-large"></i></button>
                        <button class="layout-btn" onclick="setGridLayout(4)"><i class="fas fa-th"></i></button>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="catalog-products-grid layout-3" id="productsGrid">
                @foreach($products as $prodId => $prod)
                <div class="ms-card product-item" data-id="{{ $prodId }}" data-price="{{ $prod['price'] }}" data-name="{{ strtolower($prod['name']) }}" data-sizes="{{ implode(',', $prod['sizes'] ?? []) }}">
                    <div class="ms-img-wrapper">
                        @if(isset($prod['old_price']))
                            <span class="ms-discount">-{{ round((($prod['old_price'] - $prod['price']) / $prod['old_price']) * 100) }}%</span>
                        @endif
                        <a href="{{ route('product.show', $prodId) }}">
                            <img class="real-product-img" src="{{ asset($prod['image_path']) }}" alt="{{ $prod['name'] }}" @if($prodId == 16) style="object-fit: contain !important; transform: scale(1.3);" @endif>
                        </a>
                        <button class="grid-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
                    </div>
                    <div class="ms-details">
                        <h4 class="ms-title"><a href="{{ route('product.show', $prodId) }}">{{ $prod['name'] }}</a></h4>
                        <div class="ms-price">
                            @if(isset($prod['old_price']))
                                <span class="old-price">Rs. {{ number_format($prod['old_price']) }}</span>
                            @endif
                            <span class="new-price">Rs. {{ number_format($prod['price']) }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>
</div>

<script>
    function setGridLayout(columns) {
        const grid = document.getElementById('productsGrid');
        const buttons = document.querySelectorAll('.grid-layout-btns .layout-btn');
        
        if (columns === 4) {
            grid.classList.remove('layout-3');
            grid.classList.add('layout-4');
            buttons[0].classList.remove('active');
            buttons[1].classList.add('active');
        } else {
            grid.classList.remove('layout-4');
            grid.classList.add('layout-3');
            buttons[1].classList.remove('active');
            buttons[0].classList.add('active');
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

        function filterAndSortProducts() {
            const searchTerm = searchInput.value.toLowerCase();
            const maxPrice = parseInt(priceRange.value);
            const sortOption = sortSelect.value;
            
            let visibleCount = 0;
            
            // First filter
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
                
                // Tag filter (simulated logic)
                if (activeTag === 'featured' && id % 2 !== 0) isMatch = false;
                if (activeTag === 'bestsellers' && id % 3 !== 0) isMatch = false;
                if (activeTag === 'toprated' && id > 10) isMatch = false;
                if (activeTag === 'new' && id < 10) isMatch = false;

                // Size filter
                if (activeSize !== 'all') {
                    const sizes = product.getAttribute('data-sizes') || '';
                    if (!sizes.includes(activeSize)) isMatch = false;
                }
                
                if (isMatch) {
                    product.classList.remove('hidden');
                    visibleCount++;
                } else {
                    product.classList.add('hidden');
                }
            });
            
            // Then sort the visible elements
            const visibleProducts = products.filter(p => !p.classList.contains('hidden'));
            
            visibleProducts.sort((a, b) => {
                const priceA = parseInt(a.getAttribute('data-price'));
                const priceB = parseInt(b.getAttribute('data-price'));
                const idA = parseInt(a.getAttribute('data-id'));
                const idB = parseInt(b.getAttribute('data-id'));
                
                if (sortOption === 'price_asc') return priceA - priceB;
                if (sortOption === 'price_desc') return priceB - priceA;
                if (sortOption === 'newest') return idB - idA;
                
                // Default sorting (by ID ascending)
                return idA - idB;
            });
            
            // Re-append sorted elements to the DOM
            visibleProducts.forEach(product => productsGrid.appendChild(product));
            
            // Update results count
            if(visibleCount > 0) {
                resultsCount.innerText = `Showing 1-${visibleCount} of ${products.length}`;
            } else {
                resultsCount.innerText = `No products found`;
            }
        }
        
        // Event Listeners
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

        // Size filter buttons
        sizeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                sizeBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                activeSize = this.getAttribute('data-size');
                filterAndSortProducts();
            });
        });
    });
</script>
@endsection
