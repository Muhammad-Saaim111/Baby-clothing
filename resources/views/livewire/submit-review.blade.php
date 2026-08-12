<div class="submit-review-container p-4 mt-5" style="background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 600;">Write a Review</h4>
    <p class="text-muted mb-4">Share your thoughts on the {{ $product->name }}</p>

    @if($isSubmitted)
        <div class="alert alert-success" style="background: #e8f5e9; color: #2e7d32; border: none; border-radius: 8px;">
            <i class="fa fa-check-circle me-2"></i> Thank you! Your review has been submitted and is pending approval.
        </div>
    @elseif(!$order)
        <div class="alert alert-warning" style="background: #fff3e0; color: #e65100; border: none; border-radius: 8px;">
            <i class="fa fa-exclamation-triangle me-2"></i> You can only review products that you have purchased and received.
        </div>
    @else
        @if($errorMessage)
            <div class="alert alert-danger" style="border-radius: 8px; border: none;">
                {{ $errorMessage }}
            </div>
        @endif

        <form wire:submit.prevent="submit">
            <!-- Star Rating -->
            <div class="mb-4">
                <label class="form-label fw-bold">Overall Rating <span class="text-danger">*</span></label>
                <div class="interactive-stars" style="font-size: 1.8rem; color: #ddd; cursor: pointer;">
                    @for($i = 1; $i <= 5; $i++)
                        <i wire:click="setRating({{ $i }})" class="fa {{ $i <= $rating ? 'fa-star text-warning' : 'fa-star' }}" style="transition: color 0.2s;"></i>
                    @endfor
                </div>
                @error('rating') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Your Name <span class="text-danger">*</span></label>
                    <input type="text" wire:model.defer="reviewer_name" class="form-control" {{ $order ? 'readonly' : '' }} style="border-radius: 6px;">
                    @error('reviewer_name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                    <input type="email" wire:model.defer="reviewer_email" class="form-control" {{ $order ? 'readonly' : '' }} style="border-radius: 6px;">
                    @error('reviewer_email') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Review Title</label>
                <input type="text" wire:model.defer="review_title" class="form-control" placeholder="Summarize your experience" style="border-radius: 6px;">
                @error('review_title') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Your Review <span class="text-danger">*</span></label>
                <textarea wire:model.defer="review_text" class="form-control" rows="4" placeholder="What did you like or dislike? What should other shoppers know?" style="border-radius: 6px;"></textarea>
                @error('review_text') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Add Photos (Optional, max 3)</label>
                <input type="file" wire:model="images" class="form-control" multiple accept="image/*" style="border-radius: 6px;">
                @error('images.*') <span class="text-danger small">{{ $message }}</span> @enderror
                
                @if ($images)
                    <div class="mt-2 d-flex gap-2">
                        @foreach ($images as $img)
                            <img src="{{ $img->temporaryUrl() }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                        @endforeach
                    </div>
                @endif
                <div wire:loading wire:target="images" class="small text-muted mt-1">Uploading...</div>
            </div>

            <button type="submit" class="btn btn-dark px-4 py-2" style="border-radius: 30px; font-weight: 500;" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit">Submit Review</span>
                <span wire:loading wire:target="submit"><i class="fa fa-spinner fa-spin"></i> Submitting...</span>
            </button>
        </form>
    @endif
</div>
