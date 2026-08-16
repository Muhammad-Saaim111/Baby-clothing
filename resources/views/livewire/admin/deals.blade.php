<div>
    @section('header_title', 'Deals of the Week Settings')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 bg-success-subtle text-success fw-semibold rounded-3 mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @foreach($deals as $deal)
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
                <img src="{{ asset($deal->image_path) }}?t={{ time() }}" class="card-img-top" alt="Deal Image" style="height: 180px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge bg-danger mb-2">{{ $deal->discount }}</span>
                    <h6 class="card-title fw-bold mb-2">{{ $deal->title }}</h6>
                    <p class="card-text small text-muted mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $deal->description }}
                    </p>
                </div>
                <div class="card-footer bg-white border-top-0 pb-3">
                    <button class="btn btn-sm btn-outline-primary w-100 rounded-pill" wire:click="editDeal({{ $deal->id }})">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit Deal
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Edit Modal -->
    @if($isEditModalOpen)
    <div class="modal fade show" tabindex="-1" style="display: block; background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit Deal</h5>
                    <button type="button" class="btn-close" wire:click="closeEditModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateDeal">
                    <div class="modal-body pt-3">
                        
                        <div class="mb-3 text-center">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label fw-semibold small mb-0">Current Image</label>
                                <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.75rem;">Exact Size: 1264 x 848</span>
                            </div>
                            <img src="{{ asset($current_image_path) }}?t={{ time() }}" class="rounded-3 shadow-sm" style="max-height: 120px; object-fit: cover;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Upload New Image (Optional)</label>
                            <input type="file" class="form-control form-control-sm" wire:model="edit_image" accept="image/*">
                            @error('edit_image') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Discount Badge Text</label>
                            <input type="text" class="form-control" wire:model="edit_discount" placeholder="e.g. 20% OFF">
                            @error('edit_discount') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Title</label>
                            <input type="text" class="form-control" wire:model="edit_title" placeholder="e.g. Organic Jumpsuits">
                            @error('edit_title') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small">Description</label>
                            <textarea class="form-control" wire:model="edit_description" rows="3"></textarea>
                            @error('edit_description') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                    </div>
                    <div class="modal-footer border-top-0 bg-light rounded-bottom-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" wire:click="closeEditModal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled" wire:target="updateDeal, edit_image">
                            <span wire:loading.remove wire:target="updateDeal">Save Changes</span>
                            <span wire:loading wire:target="updateDeal"><i class="fa-solid fa-spinner fa-spin"></i> Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
