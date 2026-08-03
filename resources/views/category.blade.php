@extends('layouts.app')

@section('title', $category . ' Collection')

@section('content')
<div class="category-page">
    <!-- Category Hero Header (Primebeds Style) -->
    <div class="category-hero" style="background-image: url('{{ $gender_slug === 'little-boys' ? 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80' : 'https://images.unsplash.com/photo-1596870230751-ebdfce98ec42?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80' }}')">
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
                        <input type="text" placeholder="Search categories...">
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
                        <input type="range" min="0" max="5000" value="3000" class="range-slider" id="priceRange">
                        <div class="price-range-values">
                            <span>0</span>
                            <span>5,000</span>
                        </div>
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
                    <button class="filter-toggle-btn"><i class="fa-solid fa-sliders"></i> Filter</button>
                    <div class="quick-tags">
                        <button class="tag-btn active">All</button>
                        <button class="tag-btn">Featured</button>
                        <button class="tag-btn">Best Sellers</button>
                        <button class="tag-btn">Top Rated</button>
                        <button class="tag-btn">New Arrival</button>
                    </div>
                </div>
                <div class="toolbar-right">
                    <select class="catalog-sort-select">
                        <option>Default Sorting</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                    <span class="results-count">Showing 1-{{ count($products) }} of {{ count($products) }}</span>
                    <div class="grid-layout-btns">
                        <button class="layout-btn active" onclick="setGridLayout(3)"><i class="fas fa-th-large"></i></button>
                        <button class="layout-btn" onclick="setGridLayout(4)"><i class="fas fa-th"></i></button>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="catalog-products-grid layout-3" id="productsGrid">
                @foreach($products as $prodId => $prod)
                <div class="ms-card">
                    <div class="ms-img-wrapper">
                        @if(isset($prod['old_price']))
                            <span class="ms-discount">-{{ round((($prod['old_price'] - $prod['price']) / $prod['old_price']) * 100) }}%</span>
                        @endif
                        <a href="{{ route('product.show', $prodId) }}">
                            <img class="real-product-img" src="{{ asset($prod['image_path']) }}" alt="{{ $prod['name'] }}">
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
</script>
@endsection
