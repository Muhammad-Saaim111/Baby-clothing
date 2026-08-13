<div class="reviews-section-container">
    <style>
        .reviews-section-container {
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 1px solid rgba(226, 141, 117, 0.15);
            font-family: 'Outfit', sans-serif;
        }

        .reviews-section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2D312E;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }

        .reviews-section-title::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 40px;
            height: 3px;
            background: #E28D75;
            border-radius: 2px;
        }

        /* Summary Dashboard */
        .reviews-dashboard {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            background: #FDFBF7;
            border: 1px solid rgba(226, 141, 117, 0.12);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2.5rem;
        }

        @media (min-width: 768px) {
            .reviews-dashboard {
                grid-template-columns: 220px 1fr;
                align-items: center;
                gap: 3rem;
            }
        }

        .score-card {
            text-align: center;
            padding: 2rem 1.5rem;
            background: #FFF;
            border-radius: 20px;
            border: 1px solid rgba(226, 141, 117, 0.08);
            box-shadow: 0 10px 30px rgba(226, 141, 117, 0.03);
        }

        .score-card h2 {
            font-size: 3.8rem;
            font-weight: 800;
            color: #2D312E;
            margin: 0 0 0.5rem 0;
            line-height: 1;
        }

        .score-stars {
            font-size: 1.2rem;
            color: #E28D75;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: center;
            gap: 3px;
        }

        .score-count {
            color: #8C8C8C;
            font-size: 0.9rem;
            font-weight: 500;
            margin: 0;
        }

        /* Distribution Bars */
        .rating-distribution {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .distribution-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.9rem;
            color: #4A4A4A;
            font-weight: 500;
        }

        .distribution-label {
            width: 55px;
            display: flex;
            align-items: center;
            gap: 4px;
            color: #4A4A4A;
        }

        .distribution-bar-wrapper {
            flex-grow: 1;
            height: 8px;
            background: #EFEBE5;
            border-radius: 10px;
            overflow: hidden;
        }

        .distribution-bar {
            height: 100%;
            background: #E28D75;
            border-radius: 10px;
            transition: width 0.6s cubic-bezier(0.1, 1, 0.1, 1);
        }

        .distribution-count {
            width: 35px;
            text-align: right;
            color: #8C8C8C;
            font-size: 0.85rem;
        }

        /* Filter controls */
        .filter-controls {
            margin-bottom: 2.5rem;
        }

        .filter-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2D312E;
            margin-bottom: 1rem;
        }

        .filter-pills {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .filter-pill {
            background: #FFF;
            border: 1px solid rgba(226, 141, 117, 0.2);
            color: #4A4A4A;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            outline: none;
        }

        .filter-pill:hover {
            border-color: #E28D75;
            color: #E28D75;
            transform: translateY(-1px);
        }

        .filter-pill.active {
            background: #E28D75;
            border-color: #E28D75;
            color: #FFF;
            box-shadow: 0 4px 12px rgba(226, 141, 117, 0.2);
        }

        /* Review Cards List */
        .reviews-grid-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .review-bubble {
            background: #FFF;
            border: 1px solid rgba(226, 141, 117, 0.08);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(108, 132, 119, 0.01);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .review-bubble:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(226, 141, 117, 0.05);
        }

        .review-bubble.has-images {
            display: block;
        }

        .review-slider-col {
            width: 100%;
            margin-top: 1.25rem;
            max-width: 480px;
        }

        .review-slider-container {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 10;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(226, 141, 117, 0.12);
            box-shadow: 0 8px 24px rgba(226, 141, 117, 0.05);
            background: #FDFBF7;
        }

        .review-slider-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #FDFBF7;
            padding: 4px;
        }

        .slider-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(226, 141, 117, 0.15);
            color: #2D312E;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            outline: none;
            z-index: 10;
        }

        .slider-nav-btn:hover {
            background: #E28D75;
            color: #FFF;
            border-color: #E28D75;
            transform: translateY(-50%) scale(1.05);
        }

        .slider-nav-btn.prev-btn {
            left: 12px;
        }

        .slider-nav-btn.next-btn {
            right: 12px;
        }

        .slider-counter {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(45, 49, 46, 0.75);
            color: #FFF;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            backdrop-filter: blur(4px);
        }

        .review-meta-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .reviewer-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .reviewer-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(226, 141, 117, 0.1);
            color: #E28D75;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            border: 2px solid #FFF;
            box-shadow: 0 4px 10px rgba(226, 141, 117, 0.15);
        }

        .reviewer-info h6 {
            margin: 0 0 2px 0;
            font-size: 0.95rem;
            font-weight: 700;
            color: #2D312E;
        }

        .verified-badge {
            font-size: 0.75rem;
            font-weight: 700;
            color: #2a9d8f;
            background: rgba(42, 157, 143, 0.08);
            padding: 3px 8px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .review-rating-block {
            text-align: right;
        }

        .review-stars-row {
            color: #E28D75;
            font-size: 0.9rem;
            margin-bottom: 4px;
            display: flex;
            justify-content: flex-end;
            gap: 2px;
        }

        .review-date-text {
            font-size: 0.8rem;
            color: #8C8C8C;
        }

        .review-title-text {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2D312E;
            margin-bottom: 0.75rem;
            display: block;
        }

        .review-body-text {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #6C726E;
            margin: 0 0 1.25rem 0;
        }

        /* Image Gallery */
        .review-media-gallery {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .gallery-thumb-wrapper {
            width: 75px;
            height: 75px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(226, 141, 117, 0.12);
            cursor: zoom-in;
            transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .gallery-thumb-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-thumb-wrapper:hover {
            transform: scale(1.06) rotate(1deg);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        /* Admin Reply */
        .admin-reply-box {
            margin-top: 1.5rem;
            background: #FAF8F5;
            border-left: 3px solid #E28D75;
            border-radius: 0 16px 16px 0;
            padding: 1.25rem 1.5rem;
        }

        .admin-reply-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            color: #E28D75;
            margin-bottom: 4px;
        }

        .admin-reply-text {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #6C726E;
            margin: 0;
        }

        /* Empty State */
        .empty-reviews-state {
            text-align: center;
            padding: 4rem 2rem;
            background: #FDFBF7;
            border: 1px dashed rgba(226, 141, 117, 0.2);
            border-radius: 24px;
        }

        .empty-state-icon {
            font-size: 2.8rem;
            color: rgba(226, 141, 117, 0.25);
            margin-bottom: 1rem;
        }

        .empty-state-text {
            font-size: 1rem;
            color: #8C8C8C;
            margin: 0;
        }
    </style>

    <h3 class="reviews-section-title">Customer Reviews</h3>
    
    <div class="reviews-dashboard">
        <div class="score-card">
            <h2>{{ number_format($averageRating, 1) }}</h2>
            <div class="score-stars">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= round($averageRating))
                        <i class="fa-solid fa-star"></i>
                    @else
                        <i class="fa-regular fa-star"></i>
                    @endif
                @endfor
            </div>
            <p class="score-count">{{ $totalReviews }} {{ Str::plural('Review', $totalReviews) }}</p>
        </div>
        
        <div class="rating-distribution">
            @foreach($distribution as $stars => $data)
                <div class="distribution-row">
                    <div class="distribution-label">
                        <span>{{ $stars }}</span>
                        <i class="fa-solid fa-star" style="font-size: 0.8rem; color: #E28D75;"></i>
                    </div>
                    <div class="distribution-bar-wrapper">
                        <div class="distribution-bar" style="width: {{ $data['percentage'] }}%;"></div>
                    </div>
                    <div class="distribution-count">{{ $data['count'] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="filter-controls">
        <p class="filter-title">Filter Reviews:</p>
        <div class="filter-pills">
            <button wire:click="setFilter(null)" class="filter-pill {{ is_null($filterRating) ? 'active' : '' }}">
                All Reviews
            </button>
            @for ($i = 5; $i >= 1; $i--)
                <button wire:click="setFilter({{ $i }})" class="filter-pill {{ $filterRating == $i ? 'active' : '' }}">
                    {{ $i }} Star ({{ $distribution[$i]['count'] }})
                </button>
            @endfor
        </div>
    </div>

    <div class="reviews-grid-list">
        @forelse($reviews as $review)
            <div class="review-bubble {{ $review->images ? 'has-images' : '' }}">
                <div class="review-content-col">
                    <div class="review-meta-header" style="justify-content: flex-start; gap: 1.5rem; margin-bottom: 1rem;">
                        <div class="reviewer-profile">
                            <div class="reviewer-avatar">
                                {{ strtoupper(substr($review->reviewer_name, 0, 1)) }}
                            </div>
                            <div class="reviewer-info">
                                <h6 style="margin: 0; font-size: 1rem; font-weight: 700; color: #2D312E;">{{ $review->reviewer_name }}</h6>
                                <div style="display: flex; align-items: center; gap: 8px; margin-top: 2px;">
                                    @if($review->is_verified)
                                        <span class="verified-badge">
                                            <i class="fa-solid fa-circle-check"></i> Verified Buyer
                                        </span>
                                    @endif
                                    <span class="review-date-text">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="review-rating-block" style="text-align: right; margin-left: auto;">
                            <div class="review-stars-row" style="justify-content: flex-end; margin-bottom: 0;">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $review->rating ? 'fa-solid' : 'fa-regular' }} fa-star" style="color: #F5B041;"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    
                    @if($review->review_title)
                        <strong class="review-title-text" style="font-size: 1.15rem; margin-top: 1.25rem; display: block; color: #2D312E;">{{ $review->review_title }}</strong>
                    @endif
                    <p class="review-body-text" style="font-size: 1rem; margin: 0.5rem 0 1.25rem 0; color: #6C726E; line-height: 1.6;">{{ $review->review_text }}</p>

                    @if($review->images)
                        <div class="review-slider-col" x-data="{ activeIndex: 0, images: {{ json_encode(array_map(fn($img) => asset('storage/' . $img), $review->images)) }} }">
                            <div class="review-slider-container">
                                <img :src="images[activeIndex]" class="review-slider-img" alt="Customer Review Image">
                                
                                <template x-if="images.length > 1">
                                    <button @click.prevent="activeIndex = (activeIndex - 1 + images.length) % images.length" class="slider-nav-btn prev-btn">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                </template>
                                <template x-if="images.length > 1">
                                    <button @click.prevent="activeIndex = (activeIndex + 1) % images.length" class="slider-nav-btn next-btn">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </template>

                                <div class="slider-counter" x-show="images.length > 1">
                                    <span x-text="(activeIndex + 1) + ' / ' + images.length"></span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($review->admin_reply)
                        <div class="admin-reply-box" style="margin-top: 1.5rem;">
                            <div class="admin-reply-header">
                                <i class="fa-solid fa-reply"></i>
                                <span>Aimee Response</span>
                            </div>
                            <p class="admin-reply-text">{{ $review->admin_reply }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-reviews-state">
                <div class="empty-state-icon">
                    <i class="fa-regular fa-comments"></i>
                </div>
                <p class="empty-state-text">No reviews matching this filter. Check back soon!</p>
            </div>
        @endforelse
    </div>

    <div class="mt-5">
        {{ $reviews->links() }}
    </div>
</div>
