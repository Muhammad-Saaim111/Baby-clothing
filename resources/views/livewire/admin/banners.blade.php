<div>
    @section('header_title', 'UI Settings & Banners')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 bg-success-subtle text-success fw-semibold rounded-3 mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        
        <!-- Home Banner Card -->
        <div class="col-12">
            <div class="card-premium">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Home Page Banner</h5>
                        <p class="text-muted small mb-0">Main hero image shown on the homepage.</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2">Exact Size: 1920 x 1024</span>
                </div>
                
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p class="fw-semibold small text-muted mb-2">Current Banner Preview:</p>
                        <!-- Appending time() to avoid browser cache issues when image is replaced -->
                        <div class="rounded-3 overflow-hidden border" style="background: #f8f9fa;">
                            <img src="{{ asset('assets/images/untitled_design.jpg') }}?t={{ time() }}" alt="Home Banner" class="img-fluid" style="width: 100%; height: auto; object-fit: contain; display: block;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form wire:submit.prevent="updateHomeBanner">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Upload New Banner</label>
                                <input type="file" class="form-control" wire:model="homeBanner" accept="image/*" required>
                                @error('homeBanner') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                                
                                <!-- Preview newly selected file -->
                                @if ($homeBanner)
                                    <div class="mt-2 text-success small fw-semibold">
                                        <i class="fa-solid fa-check-circle"></i> File selected. Click Update to save.
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled" wire:target="homeBanner, updateHomeBanner">
                                <span wire:loading.remove wire:target="updateHomeBanner">Update Home Banner</span>
                                <span wire:loading wire:target="updateHomeBanner"><i class="fa-solid fa-spinner fa-spin"></i> Uploading...</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Little Boys Category Banner Card -->
        <div class="col-12">
            <div class="card-premium">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Little Boys Category Banner</h5>
                        <p class="text-muted small mb-0">Hero image shown on the Little Boys collection page.</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2">Exact Size: 6688 x 3764</span>
                </div>
                
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p class="fw-semibold small text-muted mb-2">Current Banner Preview:</p>
                        <div class="rounded-3 overflow-hidden border" style="background: #f8f9fa;">
                            <img src="{{ asset('assets/images/Aimee_Boys_Banner_High_Quality.png') }}?t={{ time() }}" alt="Boys Banner" class="img-fluid" style="width: 100%; height: auto; object-fit: contain; display: block;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form wire:submit.prevent="updateBoysBanner">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Upload New Banner</label>
                                <input type="file" class="form-control" wire:model="boysBanner" accept="image/*" required>
                                @error('boysBanner') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled" wire:target="boysBanner, updateBoysBanner">
                                <span wire:loading.remove wire:target="updateBoysBanner">Update Boys Banner</span>
                                <span wire:loading wire:target="updateBoysBanner"><i class="fa-solid fa-spinner fa-spin"></i> Uploading...</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Little Girls Category Banner Card -->
        <div class="col-12">
            <div class="card-premium">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Little Girls Category Banner</h5>
                        <p class="text-muted small mb-0">Hero image shown on the Little Girls collection page.</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2">Exact Size: 6688 x 3764</span>
                </div>
                
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p class="fw-semibold small text-muted mb-2">Current Banner Preview:</p>
                        <div class="rounded-3 overflow-hidden border" style="background: #f8f9fa;">
                            <img src="{{ asset('assets/images/Aimee_Girls_Banner_High_Quality.png') }}?t={{ time() }}" alt="Girls Banner" class="img-fluid" style="width: 100%; height: auto; object-fit: contain; display: block;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form wire:submit.prevent="updateGirlsBanner">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Upload New Banner</label>
                                <input type="file" class="form-control" wire:model="girlsBanner" accept="image/*" required>
                                @error('girlsBanner') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled" wire:target="girlsBanner, updateGirlsBanner">
                                <span wire:loading.remove wire:target="updateGirlsBanner">Update Girls Banner</span>
                                <span wire:loading wire:target="updateGirlsBanner"><i class="fa-solid fa-spinner fa-spin"></i> Uploading...</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
