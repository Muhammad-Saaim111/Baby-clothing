<div class="write-review-card">
    <style>
        .write-review-card {
            background: #FFF;
            border: 1px solid rgba(226, 141, 117, 0.15);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(226, 141, 117, 0.04);
            margin-top: 3rem;
            font-family: 'Outfit', sans-serif;
        }
        
        .write-review-header {
            margin-bottom: 2rem;
        }

        .write-review-header h3 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #2D312E;
            margin: 0 0 0.5rem 0;
        }

        .write-review-header p {
            color: #6C726E;
            font-size: 0.95rem;
            margin: 0;
        }

        .review-form-group {
            margin-bottom: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .review-form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 768px) {
            .review-form-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        .review-label {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2D312E;
        }

        .review-label span.req {
            color: #E28D75;
            margin-left: 2px;
        }

        .review-input, .review-textarea {
            width: 100%;
            padding: 0.85rem 1.2rem;
            border: 1px solid rgba(226, 141, 117, 0.2);
            background: #FAF8F5;
            border-radius: 12px;
            font-size: 0.95rem;
            color: #2D312E;
            transition: all 0.3s ease;
            outline: none;
            font-family: inherit;
        }

        .review-input:focus, .review-textarea:focus {
            border-color: #E28D75;
            background: #FFF;
            box-shadow: 0 0 0 4px rgba(226, 141, 117, 0.15);
        }

        .review-input[readonly] {
            background: #EFEBE5;
            color: #8C8C8C;
            cursor: not-allowed;
            border-color: rgba(226, 141, 117, 0.1);
        }

        .stars-container {
            display: flex;
            gap: 0.6rem;
            font-size: 2.2rem;
            margin-top: 0.25rem;
        }

        .stars-container i {
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            color: #EFEBE5;
        }

        .stars-container i.active {
            color: #F5B041;
            text-shadow: 0 0 12px rgba(245, 176, 65, 0.35);
        }

        .stars-container i:hover {
            transform: scale(1.2);
        }

        .photo-upload-zone {
            border: 2px dashed rgba(226, 141, 117, 0.25);
            background: #FAF8F5;
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .photo-upload-zone:hover {
            border-color: #E28D75;
            background: #FFF;
        }

        .photo-upload-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }

        .upload-icon {
            font-size: 2.2rem;
            color: #E28D75;
            margin-bottom: 0.5rem;
            display: block;
        }

        .upload-text {
            font-size: 0.95rem;
            color: #6C726E;
            font-weight: 500;
            margin: 0;
        }

        .upload-previews {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .preview-img-wrapper {
            position: relative;
            width: 75px;
            height: 75px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(226, 141, 117, 0.15);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .preview-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .submit-review-btn {
            background: #2D312E;
            color: #FFF;
            border: none;
            padding: 1rem 2.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(45, 49, 46, 0.15);
            margin-top: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .submit-review-btn:hover {
            background: #E28D75;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(226, 141, 117, 0.25);
        }

        .submit-review-btn:disabled {
            background: #8C8C8C;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Alert Styling */
        .review-alert {
            padding: 1.25rem 1.5rem;
            border-radius: 16px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            border: none;
        }

        .review-alert-success {
            background: #E8F5E9;
            color: #2E7D32;
        }

        .review-alert-warning {
            background: #FFF3E0;
            color: #E65100;
            border: 1px solid rgba(230, 81, 0, 0.15);
        }

        .review-alert-danger {
            background: #FFEBEE;
            color: #C62828;
        }

        .error-message {
            color: #C62828;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 0.25rem;
        }
    </style>

    <div class="write-review-header">
        <h3>Write a Review</h3>
        <p>Share your thoughts on the <strong>{{ $product->name }}</strong></p>
    </div>

    @if($isSubmitted)
        <div class="review-alert review-alert-success">
            <i class="fa fa-check-circle" style="font-size: 1.2rem;"></i> 
            <span>Thank you! Your review has been submitted and is pending approval.</span>
        </div>
    @elseif(!$order)
        <div class="review-alert review-alert-warning">
            <i class="fa fa-exclamation-triangle" style="font-size: 1.2rem;"></i> 
            <span>You can only review products that you have purchased and received.</span>
        </div>
    @else
        @if($errorMessage)
            <div class="review-alert review-alert-danger">
                <i class="fa fa-times-circle" style="font-size: 1.2rem;"></i> 
                <span>{{ $errorMessage }}</span>
            </div>
        @endif

        <form wire:submit.prevent="submit">
            <!-- Star Rating -->
            <div class="review-form-group">
                <label class="review-label">Overall Rating<span class="req">*</span></label>
                <div class="stars-container">
                    @for($i = 1; $i <= 5; $i++)
                        <i wire:click="setRating({{ $i }})" class="fa fa-star {{ $i <= $rating ? 'active' : '' }}"></i>
                    @endfor
                </div>
                @error('rating') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="review-form-row">
                <div class="review-form-group">
                    <label class="review-label">Your Name<span class="req">*</span></label>
                    <input type="text" wire:model.defer="reviewer_name" class="review-input" {{ $order ? 'readonly' : '' }}>
                    @error('reviewer_name') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                <div class="review-form-group">
                    <label class="review-label">Email Address<span class="req">*</span></label>
                    <input type="email" wire:model.defer="reviewer_email" class="review-input" {{ $order ? 'readonly' : '' }}>
                    @error('reviewer_email') <span class="error-message">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="review-form-group">
                <label class="review-label">Review Title</label>
                <input type="text" wire:model.defer="review_title" class="review-input" placeholder="Summarize your experience">
                @error('review_title') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="review-form-group">
                <label class="review-label">Your Review<span class="req">*</span></label>
                <textarea wire:model.defer="review_text" class="review-textarea" rows="5" placeholder="What did you like or dislike? What should other shoppers know?"></textarea>
                @error('review_text') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="review-form-group">
                <label class="review-label">Add Photos (Optional, max 3)</label>
                <div class="photo-upload-zone">
                    <i class="fa-regular fa-image upload-icon"></i>
                    <p class="upload-text">Click or drag images here to upload</p>
                    <input type="file" wire:model="images" class="photo-upload-input" multiple accept="image/*">
                </div>
                @error('images.*') <span class="error-message">{{ $message }}</span> @enderror
                
                @if ($images)
                    <div class="upload-previews">
                        @foreach ($images as $img)
                            <div class="preview-img-wrapper">
                                <img src="{{ $img->temporaryUrl() }}">
                            </div>
                        @endforeach
                    </div>
                @endif
                <div wire:loading wire:target="images" class="error-message" style="color: #6C726E;">
                    <i class="fa fa-spinner fa-spin"></i> Uploading...
                </div>
            </div>

            <button type="submit" class="submit-review-btn" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit">Submit Review</span>
                <span wire:loading wire:target="submit"><i class="fa fa-spinner fa-spin"></i> Submitting...</span>
            </button>
        </form>
    @endif
</div>
