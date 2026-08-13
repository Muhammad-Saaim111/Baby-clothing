@extends('layouts.app')

@section('content')
<style>
    /* Premium Profile Design System */
    .profile-wrapper {
        background-color: #faf8f5; /* Warm boutique cream-tinted background */
        min-height: calc(100vh - 120px);
        padding: 50px 0;
    }
    
    .profile-container {
        max-width: 1150px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 290px 1fr;
        gap: 35px;
    }
    
    @media (max-width: 992px) {
        .profile-container {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }
    
    /* Left Sidebar Card */
    .profile-sidebar {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 8px 30px rgba(163, 116, 88, 0.05);
        padding: 35px 25px;
        text-align: center;
        border: 1px solid var(--border-soft);
        height: fit-content;
        position: sticky;
        top: 20px;
        transition: all 0.3s ease;
    }
    
    .profile-sidebar:hover {
        box-shadow: 0 12px 40px rgba(163, 116, 88, 0.09);
        transform: translateY(-2px);
    }
    
    /* Avatar layout */
    .sidebar-avatar-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
    }
    
    .sidebar-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3.5px solid var(--luxury-gold);
        box-shadow: 0 6px 15px rgba(211, 158, 130, 0.15);
    }
    
    .sidebar-avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #fdf3eb;
        color: var(--accent-peach);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 700;
        border: 3.5px solid var(--luxury-gold);
        text-transform: uppercase;
        box-shadow: 0 6px 15px rgba(211, 158, 130, 0.1);
    }
    
    .sidebar-name {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--dark-charcoal);
        margin-bottom: 4px;
        letter-spacing: -0.3px;
    }
    
    .sidebar-email {
        font-size: 0.88rem;
        color: var(--slate-gray);
        margin-bottom: 20px;
        word-break: break-all;
    }
    
    .sidebar-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fdf5f0;
        color: var(--accent-peach);
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        border: 1px solid #fce8dd;
        margin-bottom: 15px;
    }
    
    .sidebar-badge.google-linked {
        background: #e8f0fe;
        color: #1967d2;
        border-color: #d2e3fc;
    }
    
    .sidebar-badge.google-linked img {
        width: 14px;
        height: 14px;
    }
    

    
    /* Sidebar stats layout */
    .sidebar-stats {
        margin-top: 20px;
        border-top: 1px solid #f6f3ee;
        padding-top: 20px;
        text-align: left;
        display: grid;
        gap: 10px;
    }
    
    .stat-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
    }
    
    .stat-row span {
        color: var(--slate-gray);
    }
    
    .stat-row strong {
        color: var(--dark-charcoal);
        font-weight: 600;
    }
    
    /* Right Main Layout */
    .profile-main {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    
    /* Main Page Header styling */
    .orders-header-block {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .orders-header-title h2 {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--dark-charcoal);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        letter-spacing: -0.3px;
    }
    
    .orders-header-title p {
        margin: 4px 0 0 0;
        font-size: 0.88rem;
        color: var(--slate-gray);
    }
    
    .orders-count-badge {
        background: #ffffff;
        color: var(--accent-peach);
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 0.85rem;
        border: 1px solid var(--border-soft);
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    
    /* Order Cards */
    .order-card {
        background: #ffffff;
        border: 1px solid var(--border-soft);
        border-radius: 20px;
        margin-bottom: 20px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 4px 20px rgba(163, 116, 88, 0.03);
    }
    
    .order-card:hover {
        box-shadow: 0 10px 30px rgba(163, 116, 88, 0.08);
        border-color: rgba(211, 158, 130, 0.25);
        transform: translateY(-2px);
    }
    
    /* Accordion Header styling */
    .order-summary-header {
        padding: 22px 28px;
        background: #faf8f5;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-soft);
        cursor: pointer;
        user-select: none;
        position: relative;
        border-top: 3px solid var(--accent-peach);
    }
    
    .order-card:nth-child(even) .order-summary-header {
        border-top-color: var(--luxury-gold);
    }
    
    .order-header-info {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        flex: 1;
        margin-right: 40px;
    }
    
    @media (max-width: 768px) {
        .order-header-info {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 30px;
            margin-right: 15px;
        }
    }
    
    .order-header-meta-block > span {
        display: block;
        font-size: 0.72rem;
        text-transform: uppercase;
        color: var(--slate-gray);
        letter-spacing: 0.8px;
        margin-bottom: 5px;
        font-weight: 600;
    }
    
    .order-header-meta-block strong {
        font-size: 0.95rem;
        color: var(--dark-charcoal);
        font-weight: 700;
    }
    
    .order-header-meta-block strong.order-price {
        color: var(--accent-peach);
    }
    
    /* Status Badges with Pulse Dots */
    .status-badge-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-badge.pending { background: #fffbeb; color: #b45309; border: 1px solid #fef3c7; }
    .status-badge.processing { background: #eff6ff; color: #1d4ed8; border: 1px solid #dbeafe; }
    .status-badge.completed { background: #f0fdf4; color: #15803d; border: 1px solid #dcfce7; }
    .status-badge.cancelled { background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2; }
    
    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
    }
    .status-badge.pending .status-dot { background-color: #d97706; animation: status-pulse 1.8s infinite; }
    .status-badge.processing .status-dot { background-color: #2563eb; animation: status-pulse 1.8s infinite; }
    .status-badge.completed .status-dot { background-color: #16a34a; }
    .status-badge.cancelled .status-dot { background-color: #dc2626; }
    
    .accordion-arrow {
        font-size: 0.95rem;
        color: var(--slate-gray);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-soft);
        box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    }
    
    .order-summary-header:hover .accordion-arrow {
        border-color: var(--accent-peach);
        color: var(--accent-peach);
    }
    
    /* Accordion Body details */
    .order-details-accordion {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.45s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.3s ease;
        opacity: 0;
    }
    
    .order-details-accordion.active {
        opacity: 1;
    }
    
    .order-details-body {
        padding: 28px;
        border-top: 1px solid #f6f3ee;
        background: #ffffff;
    }
    
    .order-items-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 25px;
    }
    
    .order-item-row {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f6f3ee;
    }
    
    .order-item-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .order-item-img-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        border: 1px solid var(--border-soft);
    }
    
    .order-item-img {
        width: 68px;
        height: 68px;
        object-fit: cover;
        background: #faf8f5;
        transition: transform 0.3s ease;
        display: block;
    }
    
    .order-item-row:hover .order-item-img {
        transform: scale(1.08);
    }
    
    .order-item-details {
        flex: 1;
    }
    
    .order-item-details h4 {
        font-size: 0.98rem;
        margin: 0 0 6px 0;
        font-weight: 600;
        color: var(--dark-charcoal);
    }
    
    .order-item-meta-pills {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .item-pill {
        display: inline-block;
        padding: 2px 10px;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 600;
        background: #fdf5f0;
        color: var(--accent-peach);
        border: 1px solid #fce8dd;
    }
    
    .item-pill.qty-pill {
        background: #f3f4f6;
        color: #4b5563;
        border-color: #e5e7eb;
    }
    
    .order-item-price {
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--dark-charcoal);
    }
    
    /* Footer layout (Address & Invoice) */
    .order-details-footer-row {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 30px;
        border-top: 1px solid #f6f3ee;
        padding-top: 25px;
    }
    
    @media (max-width: 768px) {
        .order-details-footer-row {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
    
    .order-ship-to-card {
        border: 1px dashed #e6e2dc;
        border-radius: 16px;
        padding: 22px;
        background: #fdfdfd;
        height: 100%;
    }
    
    .card-label-header {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: var(--dark-charcoal);
        font-weight: 600;
        margin-bottom: 12px;
        border-bottom: 1px solid #f6f3ee;
        padding-bottom: 8px;
    }
    
    .card-label-header i {
        color: var(--accent-peach);
    }
    
    .order-ship-to-card p {
        margin: 0 0 5px 0;
        font-size: 0.86rem;
        color: var(--slate-gray);
        line-height: 1.45;
    }
    
    .order-ship-to-card strong {
        color: var(--dark-charcoal);
        font-size: 0.92rem;
    }
    
    .order-financial-receipt {
        background: #faf8f5;
        border-radius: 16px;
        padding: 22px;
        border: 1px solid var(--border-soft);
        border-left: 3.5px solid var(--luxury-gold);
    }
    
    .receipt-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.88rem;
        margin-bottom: 8px;
        color: var(--slate-gray);
    }
    
    .receipt-row.discount-row {
        color: #dc2626;
    }
    
    .receipt-row.grand-total-row {
        font-weight: 700;
        font-size: 1.05rem;
        color: var(--dark-charcoal);
        border-top: 1px solid #e9e5de;
        padding-top: 12px;
        margin-top: 12px;
        margin-bottom: 0;
    }
    
    .receipt-row.grand-total-row span.gt-label {
        font-weight: 700;
    }
    
    .receipt-row.grand-total-row span.gt-amount {
        color: var(--dark-charcoal);
    }
    
    /* Instructions block */
    .special-instructions-card {
        border-left: 3px solid var(--accent-peach);
        background: #fff9f6;
        padding: 16px 20px;
        border-radius: 12px;
        margin-top: 20px;
        font-size: 0.86rem;
    }
    
    .special-instructions-card span {
        display: block;
        font-size: 0.72rem;
        text-transform: uppercase;
        color: var(--accent-peach);
        letter-spacing: 0.5px;
        margin-bottom: 4px;
        font-weight: 600;
    }
    
    .special-instructions-card p {
        margin: 0;
        font-style: italic;
        color: #4b5563;
    }
    
    /* Empty State */
    .empty-orders-state {
        text-align: center;
        padding: 80px 30px;
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid var(--border-soft);
        box-shadow: 0 8px 30px rgba(163, 116, 88, 0.04);
    }
    
    .empty-orders-state i {
        font-size: 4rem;
        color: var(--accent-peach);
        margin-bottom: 25px;
        opacity: 0.85;
        animation: wobble 2s infinite;
    }
    
    .empty-orders-state h3 {
        font-size: 1.4rem;
        margin-bottom: 12px;
        color: var(--dark-charcoal);
        font-weight: 700;
    }
    
    .empty-orders-state p {
        color: var(--slate-gray);
        margin-bottom: 30px;
        font-size: 0.98rem;
    }
    
    .empty-orders-state .btn-shop {
        background: var(--dark-charcoal);
        color: white;
        padding: 14px 40px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(28, 34, 30, 0.15);
    }
    
    .empty-orders-state .btn-shop:hover {
        background: var(--accent-peach);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(211, 158, 130, 0.25);
    }
    
    /* Animations */
    @keyframes heartbeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.15); }
        28% { transform: scale(1); }
        42% { transform: scale(1.15); }
        70% { transform: scale(1); }
    }
    
    @keyframes status-pulse {
        0% { box-shadow: 0 0 0 0 rgba(0,0,0,0.2); }
        70% { box-shadow: 0 0 0 5px rgba(0,0,0,0); }
        100% { box-shadow: 0 0 0 0 rgba(0,0,0,0); }
    }
    
    @keyframes wobble {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(-5deg); }
        75% { transform: rotate(5deg); }
    }
    
    /* Custom Pagination Styling */
    .orders-pagination-container {
        margin-top: 35px;
        display: flex;
        justify-content: center;
    }
    
    .orders-pagination-container .pagination {
        display: flex;
        list-style: none;
        padding-left: 0;
        border-radius: 30px;
        background: #ffffff;
        border: 1px solid var(--border-soft);
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(163, 116, 88, 0.03);
    }
    
    .orders-pagination-container .page-item {
        margin: 0;
    }
    
    .orders-pagination-container .page-link {
        position: relative;
        display: block;
        padding: 10px 18px;
        color: var(--dark-charcoal);
        text-decoration: none;
        background-color: transparent;
        border: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.25s ease;
    }
    
    .orders-pagination-container .page-item.active .page-link {
        z-index: 3;
        color: #ffffff;
        background-color: var(--accent-peach);
    }
    
    .orders-pagination-container .page-item.disabled .page-link {
        color: #d1d5db;
        pointer-events: none;
        background-color: transparent;
    }
    
    .orders-pagination-container .page-link:hover {
        z-index: 2;
        color: var(--accent-peach);
        background-color: #fdf5f0;
    }
    
    .orders-pagination-container .page-item:not(:last-child) {
        border-right: 1px solid var(--border-soft);
    }
</style>

<div class="profile-wrapper">
    <div class="profile-container">
        
        <!-- Sidebar Card -->
        <div class="profile-sidebar">
            <div class="sidebar-avatar-wrapper">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="User Avatar" class="sidebar-avatar">
                @else
                    <div class="sidebar-avatar-placeholder">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
            </div>
            
            <h2 class="sidebar-name">{{ $user->name }}</h2>
            <p class="sidebar-email">{{ $user->email }}</p>
            
            @if($user->google_id)
                <span class="sidebar-badge google-linked">
                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"> Google Account
                </span>
            @else
                <span class="sidebar-badge">
                    <i class="fa-regular fa-envelope"></i> Email Verified
                </span>
            @endif
            
            <div class="sidebar-stats">
                <div class="stat-row">
                    <span>Member Since</span>
                    <strong>{{ $user->created_at->format('M Y') }}</strong>
                </div>
                <div class="stat-row">
                    <span>Total Orders</span>
                    <strong>{{ count($orders) }}</strong>
                </div>
            </div>
        </div>

        <!-- Main Form Content -->
        <div class="profile-main">
            
            <!-- Order History Header -->
            <div class="orders-header-block">
                <div class="orders-header-title">
                    <h2><i class="fa-solid fa-box-open" style="color: var(--accent-peach);"></i> Order History</h2>
                    <p>Track, manage, and view details of all your shopping orders.</p>
                </div>
                <span class="orders-count-badge">
                    Total: {{ count($orders) }} {{ count($orders) === 1 ? 'Order' : 'Orders' }}
                </span>
            </div>

            <!-- Tab Panel 2: Order History -->
            <div class="tab-panel active" id="ordersPanel">
                @if(count($orders) === 0)
                    <div class="empty-orders-state animate-fade-in">
                        <i class="fa-solid fa-box-open"></i>
                        <h3>No Orders Found</h3>
                        <p>You haven't placed any orders with us yet.</p>
                        <a href="/" class="btn-shop">Start Shopping</a>
                    </div>
                @else
                    @foreach($orders as $order)
                        <div class="order-card">
                            <!-- Accordion Header -->
                            <div class="order-summary-header" onclick="toggleOrderAccordion(this)">
                                <div class="order-header-info">
                                    <div class="order-header-meta-block">
                                        <span>Order Number</span>
                                        <strong>#{{ $order->order_number }}</strong>
                                    </div>
                                    <div class="order-header-meta-block">
                                        <span>Date Placed</span>
                                        <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                                    </div>
                                    <div class="order-header-meta-block">
                                        <span>Total Amount</span>
                                        <strong class="order-price">Rs. {{ number_format($order->total) }}.00</strong>
                                    </div>
                                    <div class="order-header-meta-block">
                                        <span>Status</span>
                                        <div class="status-badge-container">
                                            <span class="status-badge {{ $order->status }}">
                                                <span class="status-dot"></span>
                                                {{ $order->status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-arrow">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>

                            <!-- Accordion Body -->
                            <div class="order-details-accordion">
                                <div class="order-details-body">
                                    
                                    <!-- Order Items List -->
                                    <div class="order-items-list">
                                        @foreach($order->items as $item)
                                            @php
                                                // Get the actual product image if the product still exists in the database
                                                if ($item->product && $item->product->image_path) {
                                                    $img = $item->product->image_path;
                                                } else {
                                                    // Fallback mock images based on name or default fallback
                                                    $path = 'assets/images/products/';
                                                    if (str_contains(strtolower($item->product_name), 'tractor')) $img = $path . 'boys_sweatshirt_tractor_front.jpg';
                                                    elseif (str_contains(strtolower($item->product_name), 'geometric')) $img = $path . 'boys_sweatshirt_geometric_front.jpg';
                                                    elseif (str_contains(strtolower($item->product_name), 'butterfly')) $img = $path . 'girls_sweatshirt_butterfly_front.jpg';
                                                    elseif (str_contains(strtolower($item->product_name), 'little things')) $img = $path . 'girls_sweatshirt_littlethings_front.jpg';
                                                    elseif (str_contains(strtolower($item->product_name), 'bunny')) $img = $path . 'newborn_romper_bunny_front.jpg';
                                                    elseif (str_contains(strtolower($item->product_name), 'striped')) $img = $path . 'newborn_romper_striped_front.jpg';
                                                    elseif (str_contains(strtolower($item->product_name), 'bear')) $img = $path . 'newborn_bodysuit_bear_front.jpg';
                                                    elseif (str_contains(strtolower($item->product_name), 'waffle')) $img = $path . 'newborn_bodysuit_waffle_front.jpg';
                                                    else $img = 'https://images.unsplash.com/photo-1622290291468-a28f7a7dc6a8?auto=format&fit=crop&w=400&q=80';
                                                }
                                            @endphp
                                            <div class="order-item-row">
                                                <div class="order-item-img-wrapper">
                                                    <img src="{{ asset($img) }}" alt="{{ $item->product_name }}" class="order-item-img" onerror="this.src='https://images.unsplash.com/photo-1622290291468-a28f7a7dc6a8?auto=format&fit=crop&w=400&q=80'">
                                                </div>
                                                <div class="order-item-details">
                                                    <h4>{{ $item->product_name }}</h4>
                                                    <div class="order-item-meta-pills">
                                                        <span class="item-pill">Size: {{ $item->size }}</span>
                                                        <span class="item-pill qty-pill">Qty: {{ $item->quantity }}</span>
                                                    </div>
                                                </div>
                                                <div class="order-item-price">
                                                    Rs. {{ number_format($item->price * $item->quantity) }}.00
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Bottom Row (Address & Summary) -->
                                    <div class="order-details-footer-row">
                                        <div class="order-ship-to-card">
                                            <div class="card-label-header">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span>Delivery Address</span>
                                            </div>
                                            <p><strong>{{ $order->first_name }} {{ $order->last_name }}</strong></p>
                                            <p>{{ $order->address }}</p>
                                            @if($order->apartment)
                                                <p>{{ $order->apartment }}</p>
                                            @endif
                                            <p>{{ $order->city }}, {{ $order->postal_code }}</p>
                                            <p style="margin-top: 10px;"><strong style="color: var(--slate-gray); font-size: 0.82rem;">Phone:</strong> {{ $order->phone }}</p>
                                        </div>

                                        <div class="order-financial-receipt">
                                            <div class="receipt-row">
                                                <span>Subtotal</span>
                                                <strong>Rs. {{ number_format($order->subtotal) }}.00</strong>
                                            </div>
                                            @if($order->discount > 0)
                                                <div class="receipt-row discount-row">
                                                    <span>Discount ({{ $order->coupon_code }})</span>
                                                    <strong>-Rs. {{ number_format($order->discount) }}.00</strong>
                                                </div>
                                            @endif
                                            <div class="receipt-row">
                                                <span>Shipping</span>
                                                <strong>{{ $order->shipping > 0 ? 'Rs. ' . number_format($order->shipping) . '.00' : 'Free' }}</strong>
                                            </div>
                                            <div class="receipt-row grand-total-row">
                                                <span class="gt-label">Grand Total</span>
                                                <span class="gt-amount">Rs. {{ number_format($order->total) }}.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($order->special_instructions)
                                        <div class="special-instructions-card">
                                            <span>Special Order Instructions</span>
                                            <p>"{{ $order->special_instructions }}"</p>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Pagination Links -->
                    <div class="orders-pagination-container">
                        {{ $orders->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>

<script>
    // Toggle Order Details Accordion
    function toggleOrderAccordion(headerEl) {
        const card = headerEl.closest('.order-card');
        const accordion = card.querySelector('.order-details-accordion');
        const icon = headerEl.querySelector('.accordion-arrow i');
        
        const isActive = accordion.classList.contains('active');
        
        // Close all other accordions
        document.querySelectorAll('.order-details-accordion').forEach(acc => {
            acc.classList.remove('active');
            acc.style.maxHeight = '0px';
        });
        document.querySelectorAll('.accordion-arrow i').forEach(i => {
            i.style.transform = 'rotate(0deg)';
        });
        
        if (!isActive) {
            accordion.classList.add('active');
            // Allow dynamic fitting for content height
            accordion.style.maxHeight = accordion.scrollHeight + 'px';
            if (icon) icon.style.transform = 'rotate(180deg)';
        }
    }


</script>
@endsection
