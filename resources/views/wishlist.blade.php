@extends('layouts.app')

@section('title', 'Your Wishlist')

@section('content')
<div class="wishlist-page-container">
    <div class="container main-wishlist-container">
        <!-- Title -->
        <h1 class="wishlist-page-title">Your Saved Items</h1>

        <div id="wishlistPageContainer">
            <!-- Dynamically populated by JS -->
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        renderWishlistPage();
    });

    function getWishlist() {
        try {
            return JSON.parse(localStorage.getItem('aim_wishlist')) || [];
        } catch(e) {
            return [];
        }
    }

    function removeWishlistItem(id, name) {
        let wishlist = getWishlist();
        wishlist = wishlist.filter(item => String(item.id) !== String(id));
        localStorage.setItem('aim_wishlist', JSON.stringify(wishlist));
        
        // Update header count
        if (typeof updateWishlistUI === 'function') updateWishlistUI();
        
        // Re-render
        renderWishlistPage();
        
        if (typeof showToast === 'function') {
            showToast("Removed", `${name} has been removed from your wishlist.`);
        }
    }

    function renderWishlistPage() {
        const wishlist = getWishlist();
        const container = document.getElementById('wishlistPageContainer');

        if (wishlist.length === 0) {
            container.innerHTML = `
                <div class="wishlist-empty-state">
                    <div class="wishlist-empty-icon">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <h2>Your Wishlist is Empty</h2>
                    <p>Tap the heart icon on any product while browsing our collections to save your favorite items here!</p>
                    <a href="/" class="wishlist-shop-btn">Explore Collections</a>
                </div>
            `;
            return;
        }

        const centerClass = wishlist.length === 1 ? 'single-item-center' : '';
        let gridHtml = `<div class="catalog-products-grid layout-4 ${centerClass}" style="margin-top: 30px;">`;
        
        wishlist.forEach(item => {
            const price = Number(item.price) || 0;
            
            gridHtml += `
                <div class="ms-card product-item" id="wishlist-card-${item.id}">
                    <div class="ms-img-wrapper">
                        <button class="wishlist-delete-btn" onclick="removeWishlistItem('${item.id}', '${item.name.replace(/'/g, "\\'")}')" title="Remove"><i class="fa-solid fa-xmark"></i></button>
                        <img class="real-product-img" src="${item.image}" alt="${item.name}">
                    </div>
                    <div class="ms-details">
                        <h4 class="ms-title"><a href="/product/${item.id}">${item.name}</a></h4>
                        <div class="ms-price-row">
                            <div class="ms-price">
                                <span class="new-price">Rs. ${price.toLocaleString()}.00</span>
                            </div>
                        </div>
                        <button class="wishlist-action-btn" 
                                data-id="${item.id}" 
                                data-title="${item.name}" 
                                data-price="${price}" 
                                data-image="${item.image}" 
                                data-category="Apparel" 
                                onclick="openQuickView(this)">
                            SELECT OPTIONS
                        </button>
                    </div>
                </div>
            `;
        });

        gridHtml += '</div>';
        container.innerHTML = gridHtml;
    }
</script>
@endsection
