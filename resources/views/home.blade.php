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
    <section class="category-showcase" style="position: relative; z-index: 1;">
        <!-- Left Side Doodles -->
        <div class="category-doodle-left">
            <!-- Sketchy Cloud -->
            <svg width="65" height="45" viewBox="0 0 65 45" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: rotate(-10deg);">
                <path d="M18 33C12.5 33 6 29 6 22.5C6 16 11.5 11.5 18 11.5C20 11.5 22 12 24.5 13C27.5 7.5 33.5 4 40 4C49 4 56 10.5 57 18.5C61.5 19.5 65 24 65 29.5C65 36 59.5 40.5 53 40.5H18" stroke="#5E9ED6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <!-- Orange Handdrawn Star -->
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L14.85 8.36L21.82 8.91L16.55 13.44L18.18 20.27L12 16.55L5.82 20.27L7.45 13.44L2.18 8.91L9.15 8.36L12 2Z" stroke="#F3B356" stroke-width="2" stroke-linejoin="round" fill="none"/>
            </svg>
        </div>

        <!-- Right Side Doodles -->
        <div class="category-doodle-right">
            <!-- Sketchy Cloud -->
            <svg width="65" height="45" viewBox="0 0 65 45" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: scaleX(-1) rotate(-5deg);">
                <path d="M18 33C12.5 33 6 29 6 22.5C6 16 11.5 11.5 18 11.5C20 11.5 22 12 24.5 13C27.5 7.5 33.5 4 40 4C49 4 56 10.5 57 18.5C61.5 19.5 65 24 65 29.5C65 36 59.5 40.5 53 40.5H18" stroke="#5E9ED6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <!-- Yellow Star -->
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L14.85 8.36L21.82 8.91L16.55 13.44L18.18 20.27L12 16.55L5.82 20.27L7.45 13.44L2.18 8.91L9.15 8.36L12 2Z" stroke="#82A392" stroke-width="2" stroke-linejoin="round" fill="none"/>
            </svg>
            <!-- Orange Star -->
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L14.85 8.36L21.82 8.91L16.55 13.44L18.18 20.27L12 16.55L5.82 20.27L7.45 13.44L2.18 8.91L9.15 8.36L12 2Z" stroke="#F3B356" stroke-width="2" stroke-linejoin="round" fill="none"/>
            </svg>
        </div>

        <div class="container">
            <div class="section-title text-center" style="margin-bottom: 40px;">
                <span class="section-tagline" style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: var(--accent-red); letter-spacing: 1.5px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa-regular fa-heart" style="font-size: 0.85rem;"></i> EXPLORE OUR COLLECTIONS <i class="fa-regular fa-heart" style="font-size: 0.85rem;"></i>
                </span>
                <h2 style="font-family: 'Fredoka', sans-serif; font-size: 2.4rem; font-weight: 700; color: #1e2c3b; margin-top: 8px; display: flex; align-items: center; justify-content: center; gap: 15px; text-transform: none; letter-spacing: 0.5px;">
                    <!-- Left Sparkle Doodle -->
                    <svg width="35" height="24" viewBox="0 0 35 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.85;">
                        <path d="M25 6L5 2" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M28 12L2 12" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M25 18L5 22" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    Find Their Perfect Style
                    <!-- Right Sparkle Doodle -->
                    <svg width="35" height="24" viewBox="0 0 35 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.85; transform: scaleX(-1);">
                        <path d="M25 6L5 2" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M28 12L2 12" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M25 18L5 22" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </h2>
                <div class="title-divider"></div>
            </div>
            
            <div class="deals-slider-container">
                <div class="slider-wrapper">
                    <div class="slider-track category-track stagger-children" id="catTrack">
                        <!-- Category 1: New Born -->
                        <a href="{{ route('category.show', 'new-born') }}" class="showcase-card-dome card-theme-blue">
                            <div class="showcase-bg-dome" style="background-image: url('{{ asset('assets/images/products/category_newborn_mockup.png') }}');"></div>
                            <div class="category-cloud-dome">
                                <h3>New Born</h3>
                                <span>0 - 2 Years</span>
                                <span class="category-pill-btn-new btn-theme-blue">Shop Now <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem; margin-left: 2px;"></i></span>
                            </div>
                        </a>
                        
                        <!-- Category 2: Boys -->
                        <a href="{{ route('category.show', 'little-boys') }}" class="showcase-card-dome card-theme-green">
                            <div class="showcase-bg-dome" style="background-image: url('{{ asset('assets/images/products/media__1785749452186_lifestyle.jpg') }}'); background-position: top center;"></div>
                            <div class="category-cloud-dome">
                                <h3>Boys</h3>
                                <span>2 - 8 Years</span>
                                <span class="category-pill-btn-new btn-theme-green">Shop Now <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem; margin-left: 2px;"></i></span>
                            </div>
                        </a>
                        
                        <!-- Category 3: Girls -->
                        <a href="{{ route('category.show', 'little-girls') }}" class="showcase-card-dome card-theme-pink">
                            <div class="showcase-bg-dome" style="background-image: url('{{ asset('assets/images/products/media__1785749519451_lifestyle.jpg') }}'); background-position: top center;"></div>
                            <div class="category-cloud-dome">
                                <h3>Girls</h3>
                                <span>2 - 8 Years</span>
                                <span class="category-pill-btn-new btn-theme-pink">Shop Now <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem; margin-left: 2px;"></i></span>
                            </div>
                        </a>
                        
                        <!-- Category 4: Accessories -->
                        <a href="#" class="showcase-card-dome card-theme-yellow">
                            <div class="showcase-bg-dome" style="background-image: url('{{ asset('assets/images/products/category_accessories.jpg') }}');"></div>
                            <div class="category-cloud-dome">
                                <h3>Accessories</h3>
                                <span>Complete the Look</span>
                                <span class="category-pill-btn-new btn-theme-yellow">Shop Now <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem; margin-left: 2px;"></i></span>
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
                    <span class="section-tagline">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 4px;"><path d="M12 2L15 9L22 12L15 15L12 22L9 15L2 12L9 9Z" fill="#F3B356"/></svg>
                        Limited Time Offers
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 4px;"><path d="M12 2L15 9L22 12L15 15L12 22L9 15L2 12L9 9Z" fill="#F3B356"/></svg>
                    </span>
                    <h2 style="font-family: 'Fredoka', sans-serif; font-size: 2.4rem; font-weight: 700; color: #1e2c3b; margin-top: 8px; display: flex; align-items: center; justify-content: center; gap: 15px; text-transform: none; letter-spacing: 0.5px;">
                        <!-- Left Sparkle Doodle -->
                        <svg width="35" height="24" viewBox="0 0 35 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.85;">
                            <path d="M25 6L5 2" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M28 12L2 12" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M25 18L5 22" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                        Deals Of The Week
                        <!-- Right Sparkle Doodle -->
                        <svg width="35" height="24" viewBox="0 0 35 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.85; transform: scaleX(-1);">
                            <path d="M25 6L5 2" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M28 12L2 12" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M25 18L5 22" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </h2>
                    <div class="heart-divider">
                        <span class="line"></span>
                        <span class="heart">❤</span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>
            <div class="deals-slider-container" style="margin-top: 35px;">
                <div class="slider-wrapper">
                    <div class="deals-grid slider-track deals-track stagger-children" id="dealsTrack">
                        @if(isset($deals) && count($deals) > 0)
                            @foreach($deals as $deal)
                                @php
                                    $isEven = $loop->index % 2 == 0;
                                    $themeClass = $isEven ? 'card-theme-blue' : 'card-theme-yellow';
                                @endphp
                                <div class="deal-card-new {{ $themeClass }}">
                                    <!-- Left Text Column -->
                                    <div class="deal-text-col">
                                        <!-- Cotton branch SVG at bottom-left -->
                                        <div class="doodle-cotton">
                                            <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 55Q25 45 30 28M30 28Q26 22 20 27M30 28Q36 24 33 17" class="doodle-stroke-primary" stroke-width="2" stroke-linecap="round"/>
                                                <circle cx="27" cy="24" r="7" fill="#FFFFFF" class="doodle-stroke-primary" stroke-width="1.5"/>
                                                <circle cx="19" cy="32" r="6" fill="#FFFFFF" class="doodle-stroke-primary" stroke-width="1.5"/>
                                                <circle cx="33" cy="31" r="6.5" fill="#FFFFFF" class="doodle-stroke-primary" stroke-width="1.5"/>
                                                <circle cx="23" cy="19" r="5" fill="#FFFFFF" class="doodle-stroke-primary" stroke-width="1.5"/>
                                            </svg>
                                        </div>
                                        <!-- Leaf branch SVG at bottom-right -->
                                        <div class="doodle-leaf-bottom">
                                            <svg width="65" height="70" viewBox="0 0 60 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <!-- Stem -->
                                                <path d="M30 65 Q 32 40 30 15" stroke="#9E7056" stroke-width="2.5" stroke-linecap="round"/>
                                                <!-- Bottom Left Leaf -->
                                                <path d="M31 52 Q 10 46 16 34 Q 28 40 31 52" fill="#A2C3E5" opacity="0.95"/>
                                                <!-- Bottom Right Leaf -->
                                                <path d="M31 48 Q 50 42 44 30 Q 32 36 31 48" fill="#A2C3E5" opacity="0.95"/>
                                                <!-- Middle Left Leaf -->
                                                <path d="M31 35 Q 12 28 20 18 Q 30 24 31 35" fill="#A2C3E5" opacity="0.95"/>
                                                <!-- Middle Right Leaf -->
                                                <path d="M30 31 Q 48 24 40 14 Q 31 20 30 31" fill="#A2C3E5" opacity="0.95"/>
                                                <!-- Top Leaf -->
                                                <path d="M30 15 Q 22 2 30 2 Q 38 2 30 15" fill="#A2C3E5" opacity="0.95"/>
                                            </svg>
                                        </div>
                                        <!-- Top right cloud outline -->
                                        <div class="doodle-cloud-top">
                                            <svg width="60" height="42" viewBox="0 0 60 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 35C10 35 5 31 5 25C5 18 11 14 17 14C19 14 21 15 23 16C26 9 32 5 39 5C48 5 55 12 55 21C55 22 55 23 54.8 24C57.5 25 59 28 59 31C59 36 55 40 49 40H15" class="doodle-stroke-primary" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>

                                        <!-- Dotted Swirl Loop in the middle -->
                                        <div class="doodle-swirl-mid">
                                            <svg width="85" height="60" viewBox="0 0 90 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M 10,40 C 25,15 55,15 60,30 C 65,45 45,55 40,40 C 35,20 60,10 80,20" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="5 5"/>
                                            </svg>
                                        </div>
                                        
                                        <span class="deal-discount-blob">{!! str_replace(' ', '<br>', $deal->discount) !!}</span>
                                        <h3>{{ $deal->title }}</h3>
                                        <p>{{ $deal->description }}</p>
                                        <a href="#" class="btn-shop-deal">Shop Deal <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                    
                                    <!-- Right Image Column -->
                                    <div class="deal-img-col" style="background-image: url('{{ asset($deal->image_path) }}?t={{ time() }}');">
                                        <!-- Cute Teddy Bear on bottom right of Card 2 -->
                                        @if(!$isEven)
                                            <div class="doodle-teddy">
                                                <svg width="90" height="95" viewBox="0 0 80 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <ellipse cx="40" cy="48" rx="28" ry="24" fill="#D39E82" stroke="#B07D62" stroke-width="2"/>
                                                    <circle cx="18" cy="28" r="10" fill="#D39E82" stroke="#B07D62" stroke-width="2"/>
                                                    <circle cx="18" cy="28" r="6" fill="#F9C5D1"/>
                                                    <circle cx="62" cy="28" r="10" fill="#D39E82" stroke="#B07D62" stroke-width="2"/>
                                                    <circle cx="62" cy="28" r="6" fill="#F9C5D1"/>
                                                    <ellipse cx="40" cy="54" rx="10" ry="7" fill="#FDF3F5" stroke="#B07D62" stroke-width="1.5"/>
                                                    <path d="M37 52Q40 49 43 52M40 54V58" stroke="#5E4E42" stroke-width="2" stroke-linecap="round"/>
                                                    <polygon points="38,52 42,52 40,55" fill="#5E4E42"/>
                                                    <circle cx="29" cy="44" r="3.5" fill="#3A2D23"/>
                                                    <circle cx="29.5" cy="42.5" r="1" fill="#FFFFFF"/>
                                                    <circle cx="51" cy="44" r="3.5" fill="#3A2D23"/>
                                                    <circle cx="51.5" cy="42.5" r="1" fill="#FFFFFF"/>
                                                    <circle cx="22" cy="49" r="3.5" fill="#FFA5B5" opacity="0.6"/>
                                                    <circle cx="58" cy="49" r="3.5" fill="#FFA5B5" opacity="0.6"/>
                                                    <path d="M68 55Q75 60 76 68M72 62Q78 61 79 57" stroke="#E89878" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted p-4">No deals currently available.</p>
                        @endif
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
        .deals-track .deal-card-new {
            flex: 0 0 calc(50% - 15px) !important;
            display: flex !important;
        }
        .category-track .showcase-card {
            flex: 0 0 calc(33.333% - 20px) !important;
            display: flex !important;
            height: 450px;
        }
        @media (max-width: 992px) {
            .deals-track .deal-card-new {
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
            display: flex;
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
            top: 15px !important;
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
        .absolute-quickview {
            position: absolute !important;
            top: 55px !important;
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
        .ms-img-wrapper:hover .absolute-quickview {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        .absolute-quickview:hover {
            color: #C7AE8D !important;
            border-color: #C7AE8D !important;
        }
        .absolute-cart {
            position: absolute !important;
            top: 125px !important;
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
        .ms-img-wrapper:hover .absolute-cart {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        .absolute-cart:hover {
            color: var(--accent-peach) !important;
            border-color: var(--accent-peach) !important;
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
                return Math.round((containerWidth + 30) / (cardWidth + 30)) || 1;
            }
            
            function updateSlider() {
                const itemWidth = cards[0].offsetWidth;
                const gap = 30; 
                const moveAmount = itemWidth + gap;
                track.style.transform = `translateX(-${currentIndex * moveAmount}px)`;
            }
            
            function nextSlide() {
                const itemsPerView = getItemsPerView();
                if (currentIndex < cards.length - itemsPerView) {
                    currentIndex++;
                } else {
                    currentIndex = 0; 
                }
                updateSlider();
            }
            
            function startInterval() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, intervalTime);
            }
            
            startInterval();
            
            track.addEventListener('mouseenter', () => {
                clearInterval(slideInterval);
            });
            
            track.addEventListener('mouseleave', () => {
                startInterval();
            });
            
            window.addEventListener('resize', updateSlider);
        }

        function initInteractiveSlider(trackId, prevBtnClass, nextBtnClass, intervalTime) {
            const track = document.getElementById(trackId);
            if (!track) return null;
            const container = track.closest('.slider-container');
            const prevBtn = container.querySelector(prevBtnClass);
            const nextBtn = container.querySelector(nextBtnClass);
            
            let currentIndex = 0;
            let slideInterval;
            
            function getVisibleCards() {
                return Array.from(track.children).filter(card => card.style.display !== 'none');
            }
            
            function getItemsPerView() {
                const visibleCards = getVisibleCards();
                if (!visibleCards.length) return 1;
                const containerWidth = track.parentElement.offsetWidth;
                const cardWidth = visibleCards[0].offsetWidth;
                return Math.round((containerWidth + 30) / (cardWidth + 30)) || 1;
            }
            
            function updateSlider() {
                const visibleCards = getVisibleCards();
                if (!visibleCards.length) {
                    track.style.transform = `translateX(0)`;
                    return;
                }
                const itemWidth = visibleCards[0].offsetWidth;
                const gap = 30; 
                const moveAmount = itemWidth + gap;
                track.style.transform = `translateX(-${currentIndex * moveAmount}px)`;
            }
            
            function nextSlide() {
                const visibleCards = getVisibleCards();
                const itemsPerView = getItemsPerView();
                if (currentIndex < visibleCards.length - itemsPerView) {
                    currentIndex++;
                } else {
                    currentIndex = 0; 
                }
                updateSlider();
            }
            
            function prevSlide() {
                const visibleCards = getVisibleCards();
                const itemsPerView = getItemsPerView();
                if (currentIndex > 0) {
                    currentIndex--;
                } else {
                    currentIndex = Math.max(0, visibleCards.length - itemsPerView);
                }
                updateSlider();
            }
            
            function startInterval() {
                if (intervalTime) {
                    clearInterval(slideInterval);
                    slideInterval = setInterval(nextSlide, intervalTime);
                }
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    clearInterval(slideInterval);
                    prevSlide();
                    startInterval();
                });
            }
            
            if (nextBtn) {
                nextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    clearInterval(slideInterval);
                    nextSlide();
                    startInterval();
                });
            }
            
            startInterval();
            
            track.addEventListener('mouseenter', () => {
                clearInterval(slideInterval);
            });
            
            track.addEventListener('mouseleave', () => {
                startInterval();
            });
            
            window.addEventListener('resize', updateSlider);
            
            return {
                reset: () => {
                    currentIndex = 0;
                    updateSlider();
                    startInterval();
                },
                update: () => {
                    updateSlider();
                }
            };
        }

        let msSliderInstance;
        window.filterMostSelling = function(category, tabElement) {
            const tabs = document.querySelectorAll('.ms-tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            tabElement.classList.add('active');
            
            const track = document.getElementById('msTrack');
            const cards = track.children;
            
            for (let i = 0; i < cards.length; i++) {
                const card = cards[i];
                const cardCategory = card.getAttribute('data-category');
                if (category === 'all' || cardCategory === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            }
            
            if (msSliderInstance) {
                msSliderInstance.reset();
            }
        };

        window.triggerQuickAdd = function(btn, prodId, event) {
            event.preventDefault();
            event.stopPropagation();
            const card = btn.closest('.ms-card');
            const overlay = card.querySelector('.quick-add-overlay');
            if (overlay) {
                overlay.classList.add('active');
                const floatingBtn = card.querySelector('.ms-cart-btn-floating');
                if (floatingBtn) {
                    floatingBtn.style.opacity = '0';
                    floatingBtn.style.pointerEvents = 'none';
                }
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            // Init Sliders
            initSlider('dealsTrack', 2500);
            initSlider('catTrack', 2500);
            msSliderInstance = initInteractiveSlider('msTrack', '.ms-prev-btn', '.ms-next-btn', 4000);
            
            // Init Featured Categories Tab Sliders
            initSlider('fcTrack1', 4000);
            initSlider('fcTrack2', 4000);
            initSlider('fcTrack3', 4000);
        });
    </script>





    <!-- Most Selling Products -->
    <section class="most-selling" style="margin-top: -60px; position: relative; z-index: 10;">
        <div class="bg-blob blob-gold" style="top: 5%; left: -90px;"></div>
        <div class="bg-blob blob-olive" style="bottom: 5%; right: -100px;"></div>
        <div class="container">
            <!-- Redesigned Section Header -->
            <div class="section-title text-center" style="margin-bottom: 35px;">
                <div class="tagline-badge">
                    <i class="fa-solid fa-trophy"></i> PARENT FAVORITES
                </div>
                <h2 style="font-family: 'Fredoka', sans-serif; font-size: 2.4rem; font-weight: 700; color: #1e2c3b; margin-top: 8px; display: flex; align-items: center; justify-content: center; gap: 15px; text-transform: none; letter-spacing: 0.5px;">
                    <!-- Left Sparkle Doodle -->
                    <svg width="35" height="24" viewBox="0 0 35 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.85;">
                        <path d="M25 6L5 2" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M28 12L2 12" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M25 18L5 22" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    Most Selling Products
                    <!-- Right Sparkle Doodle -->
                    <svg width="35" height="24" viewBox="0 0 35 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.85; transform: scaleX(-1);">
                        <path d="M25 6L5 2" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M28 12L2 12" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M25 18L5 22" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </h2>
                <div class="sub-heart-divider">
                    <span class="heart-dot"></span>
                    <span class="heart-icon">❤</span>
                    <span class="heart-dot"></span>
                </div>
                <p class="most-selling-subtitle">Top picks loved by parents & little ones this week.</p>
            </div>


            
            <div class="slider-container" style="position: relative;">
                
                <div class="slider-wrapper" style="overflow: hidden;">
                    <div class="slider-track ms-track stagger-children" id="msTrack">
                        @foreach($products as $prodId => $prod)
                        @php
                            $ageRange = $prod->age_range ?? '2 - 6 Years';
                            $stars = $prod->rating ?? 5.0;
                            $reviews = $prod->review_count ?? 0;
                            $discountPct = isset($prod->old_price) ? round((($prod->old_price - $prod->price) / $prod->old_price) * 100) : 0;
                        @endphp
                        <div class="ms-card" data-id="{{ $prodId }}" data-category="{{ $prod->category ?? 'Little Boys' }}" data-sizes="{{ implode(',', $prod->sizes ?? []) }}">
                            <div class="ms-img-wrapper">
                                @if($prod->stock <= 0)
                                    <span class="ms-badge badge-outofstock">Out of Stock</span>
                                @elseif(isset($prod->old_price))
                                    <span class="ms-badge badge-discount">-{{ $discountPct }}%</span>
                                @elseif($prodId % 2 == 0)
                                    <span class="ms-badge badge-bestseller"><i class="fa-solid fa-star" style="font-size: 0.65rem; margin-right: 2px;"></i> BESTSELLER</span>
                                @else
                                    <span class="ms-badge badge-new">NEW ARRIVAL</span>
                                @endif

                                <button class="ms-wishlist absolute-wishlist" data-id="{{ $prodId }}" title="Add to Wishlist" onclick="toggleWishlist(this, '{{ $prodId }}', '{{ addslashes($prod->name) }}', {{ $prod->price }}, '{{ asset($prod->image_path) }}')"><i class="fa-regular fa-heart"></i></button>
                                <button class="absolute-quickview" title="Quick View" data-id="{{ $prodId }}" data-title="{{ $prod->name }}" data-price="{{ $prod->price }}" data-old-price="{{ $prod->old_price ?? '' }}" data-image="{{ asset($prod->image_path) }}" data-category="{{ $prod->category ?? 'Little Boys' }}" onclick="openQuickView(this)"><i class="fa-regular fa-eye"></i></button>
                                <button class="ms-cart-btn-floating" title="Add to Cart" onclick="triggerQuickAdd(this, '{{ $prodId }}', event)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" style="width: 19px; height: 19px;">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </button>
                                
                                <a href="{{ route('product.show', $prodId) }}">
                                    <img class="real-product-img primary-img" src="{{ asset($prod->image_path) }}" alt="{{ $prod->name }}">
                                    <img class="real-product-img lifestyle-img" src="{{ asset(str_replace('_front.jpg', '_lifestyle.jpg', $prod->image_path)) }}" alt="{{ $prod->name }}">
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
                                <div class="ms-rating-row">
                                    <div class="ms-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $stars)
                                                <i class="fa-solid fa-star"></i>
                                            @elseif($i - 0.5 <= $stars)
                                                <i class="fa-solid fa-star-half-stroke"></i>
                                            @else
                                                <i class="fa-regular fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="ms-review-count">({{ $reviews }})</span>
                                </div>

                                <h4 class="ms-title"><a href="{{ route('product.show', $prodId) }}">{{ $prod['name'] }}</a></h4>
                                
                                <span class="ms-age-limit">{{ $ageRange }}</span>

                                <div class="ms-price-row-new">
                                    <div class="ms-prices-new">
                                        @if(isset($prod['old_price']))
                                            <span class="old-price-new">Rs. {{ number_format($prod['old_price']) }}</span>
                                        @endif
                                        <span class="new-price-new">Rs. {{ number_format($prod['price']) }}</span>
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




    <!-- Testimonials Section (Primebeds Style) -->
    <section class="testimonials-section">
        <div class="bg-blob blob-peach" style="top: 15%; right: -70px;"></div>
        <div class="bg-blob blob-gold" style="bottom: 15%; left: -110px;"></div>
        <div class="container">
            <div class="section-title text-center testimonials-header-container">
                <h2 class="testimonials-heading">
                    <!-- Left Sparkle Doodle -->
                    <svg class="doodle-left" width="35" height="24" viewBox="0 0 35 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.85;">
                        <path d="M25 6L5 2" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M28 12L2 12" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M25 18L5 22" stroke="#82A392" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    What Parents Say About Us
                    <!-- Right Sparkle Doodle -->
                    <span class="doodle-right" style="display: inline-block;">
                        <svg width="35" height="24" viewBox="0 0 35 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.85; transform: scaleX(-1); display: block;">
                            <path d="M25 6L5 2" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M28 12L2 12" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M25 18L5 22" stroke="#F3B356" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>
                    </span>
                </h2>
                <div class="sub-heart-divider">
                    <!-- Heart Doodle -->
                    <svg class="doodle-bottom" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 13S1 8.5 1 4C1 2 2.5 0.5 4.5 0.5C5.7 0.5 6.8 1.2 7.4 2.2C7.7 2.7 8.3 2.7 8.6 2.2C9.2 1.2 10.3 0.5 11.5 0.5C13.5 0.5 15 2 15 4C15 8.5 8 13 8 13Z" fill="#ff7a59"/>
                    </svg>
                </div>
            </div>

            <div class="testimonials-grid stagger-children">
                <!-- Review 1 -->
                <div class="testimonial-card">
                    <div class="quote-bg-icon">99</div>
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="review-text">"The cotton is unbelievably soft! It washes incredibly well and doesn't lose its shape or softness. Highly recommend to all other parents."</p>
                    <div class="reviewer-info">
                        <div class="reviewer-profile">
                            <img src="{{ asset('assets/images/avatar_sarah.png') }}" class="reviewer-avatar-img" alt="Sarah M.">
                            <div class="reviewer-meta">
                                <span class="reviewer-name">Sarah M.</span>
                                <span class="verified-badge"><i class="fa-solid fa-circle-check"></i> Verified Buyer</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="testimonial-card">
                    <div class="quote-bg-icon">99</div>
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="review-text">"Absolutely love the design aesthetic. Very minimal, elegant, and fits my baby perfectly. The packaging was beautiful too."</p>
                    <div class="reviewer-info">
                        <div class="reviewer-profile">
                            <img src="{{ asset('assets/images/avatar_emma.png') }}" class="reviewer-avatar-img" alt="Emma R.">
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
