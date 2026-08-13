@extends('layouts.app')

@section('title', $q ? "Search results for \"{$q}\"" : 'Search Products')

@section('content')
<div class="search-results-page">
    <div class="container">

        <!-- Search Hero Bar -->
        <div class="search-hero">
            <h1 class="search-title">
                @if($q)
                    Search results for <span class="search-query">"{{ $q }}"</span>
                @else
                    Search our collection
                @endif
            </h1>
            <form action="{{ route('search') }}" method="GET" class="search-form-inline">
                <div class="search-input-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" name="q" value="{{ $q }}" placeholder="Search for sweatshirts, boys, girls…" autofocus>
                    <button type="submit">Search</button>
                </div>
            </form>
        </div>

        @if($q)
            <p class="search-count">
                @if($products->count() > 0)
                    {{ $products->count() }} {{ Str::plural('result', $products->count()) }} found
                @else
                    No results found for <strong>"{{ $q }}"</strong>
                @endif
            </p>
        @endif

        @if($products->count() > 0)
        <div class="catalog-products-grid layout-4" style="margin-top: 32px;">
            @foreach($products as $product)
            <div class="ms-card product-item" data-id="{{ $product->id }}" data-price="{{ $product->price }}" data-name="{{ strtolower($product->name) }}" data-sizes="{{ implode(',', $product->sizes ?? []) }}">
                <div class="ms-img-wrapper" @if(in_array($product->id, [9, 16, 17])) style="aspect-ratio: 1 / 1; background: transparent;" @endif>
                    @if($product->stock <= 0)
                        <span class="ms-discount" style="background-color: var(--terracotta) !important; font-weight: 700; text-transform: uppercase; font-size: 0.68rem; letter-spacing: 0.5px; border-radius: 4px; padding: 4px 8px;">Out of Stock</span>
                    @elseif($product->old_price)
                        <span class="ms-discount">-{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%</span>
                    @endif
                    <button class="grid-wishlist-btn" data-id="{{ $product->id }}" title="Add to Wishlist" onclick="toggleWishlist(this, '{{ $product->id }}', '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ asset($product->image_path) }}')"><i class="fa-regular fa-heart"></i></button>
                    <button class="ms-quick-view" title="Quick View" data-id="{{ $product->id }}" data-title="{{ $product->name }}" data-price="{{ $product->price }}" data-old-price="{{ $product->old_price ?? '' }}" data-image="{{ asset($product->image_path) }}" data-category="{{ $product->category ?? 'Apparel' }}" onclick="openQuickView(this)"><i class="fa-regular fa-eye"></i></button>
                    <a href="{{ route('product.show', $product->id) }}">
                        <img class="real-product-img" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" @if(in_array($product->id, [9, 16, 17])) style="object-fit: contain !important; transform: scale(1.15);" @endif>
                    </a>
                    <div class="ms-quick-btn">
                        <a href="{{ route('product.show', $product->id) }}" class="quick-view-link">Quick View <i class="fa-solid fa-arrow-right"></i></a>
                    </div>

                    <!-- Quick Add Size/Qty Overlay -->
                    <div class="quick-add-overlay">
                        <div class="qa-sizes-title">Select Size</div>
                        <div class="qa-sizes-list">
                            @foreach($product->sizes ?? [] as $size)
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
                    <h4 class="ms-title"><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h4>
                    <div class="ms-price-row">
                        <div class="ms-price">
                            @if($product->old_price)
                                <span class="old-price">Rs. {{ number_format($product->old_price) }}</span>
                            @endif
                            <span class="new-price">Rs. {{ number_format($product->price) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="margin-top: 40px; display: flex; justify-content: center;">
            {{ $products->appends(['q' => $q])->links('pagination::bootstrap-4') }}
        </div>

        @elseif($q)
        <!-- Empty State -->
        <div class="search-empty-state">
            <div class="search-empty-icon">🔍</div>
            <h2>Nothing found for "{{ $q }}"</h2>
            <p>Try a different keyword like "sweatshirt", "boys", "girls" or "newborn".</p>
            <div class="search-suggestions">
                <span>Try:</span>
                <a href="{{ route('search', ['q' => 'sweatshirt']) }}">Sweatshirt</a>
                <a href="{{ route('search', ['q' => 'boys']) }}">Boys</a>
                <a href="{{ route('search', ['q' => 'girls']) }}">Girls</a>
                <a href="{{ route('search', ['q' => 'blue']) }}">Blue</a>
            </div>
        </div>
        @endif

    </div>
</div>

<style>
.search-results-page {
    padding: 50px 0 100px;
    background: var(--bg-cream);
    min-height: 60vh;
}

.search-hero {
    text-align: center;
    margin-bottom: 32px;
}

.search-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--dark-charcoal);
    margin-bottom: 24px;
}

.search-query {
    color: var(--primary-olive);
}

.search-form-inline {
    max-width: 600px;
    margin: 0 auto;
}

.search-input-wrap {
    display: flex;
    align-items: center;
    background: #fff;
    border: 1.5px solid var(--border-soft);
    border-radius: 50px;
    padding: 6px 8px 6px 20px;
    gap: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    transition: box-shadow 0.2s, border-color 0.2s;
}

.search-input-wrap:focus-within {
    border-color: var(--primary-olive);
    box-shadow: 0 4px 20px rgba(132,148,137,0.15);
}

.search-input-wrap i {
    color: var(--text-gray);
    font-size: 1rem;
    flex-shrink: 0;
}

.search-input-wrap input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 1rem;
    font-family: var(--font-main);
    background: transparent;
    color: var(--dark-charcoal);
}

.search-input-wrap button {
    background: var(--dark-charcoal);
    color: #fff;
    border: none;
    border-radius: 40px;
    padding: 10px 24px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
    font-family: var(--font-main);
}

.search-input-wrap button:hover {
    background: var(--primary-olive);
}

.search-count {
    font-size: 0.9rem;
    color: var(--text-gray);
    text-align: center;
}

/* Empty State */
.search-empty-state {
    text-align: center;
    padding: 80px 20px;
}

.search-empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
}

.search-empty-state h2 {
    font-size: 1.5rem;
    color: var(--dark-charcoal);
    margin-bottom: 10px;
}

.search-empty-state p {
    color: var(--text-gray);
    margin-bottom: 24px;
}

.search-suggestions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}

.search-suggestions span {
    font-weight: 600;
    color: var(--dark-charcoal);
}

.search-suggestions a {
    background: #fff;
    border: 1.5px solid var(--border-soft);
    color: var(--dark-charcoal);
    padding: 6px 16px;
    border-radius: 40px;
    font-size: 0.85rem;
    text-decoration: none;
    transition: border-color 0.2s, background 0.2s;
}

.search-suggestions a:hover {
    border-color: var(--primary-olive);
    background: var(--bg-cream);
}
</style>
@endsection
