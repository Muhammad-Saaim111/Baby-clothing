<div>
    @section('header_title', 'Coupon Management')

    <div class="card-premium">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Discount Codes</h5>
            <button class="btn btn-primary btn-sm px-4 rounded-pill shadow-sm" wire:click="openModal">
                <i class="fa-solid fa-plus me-1"></i> Add New Coupon
            </button>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Min. Order</th>
                        <th>Usage</th>
                        <th>Expires At</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coupon)
                        <tr>
                            <td><span class="badge bg-dark text-white fs-6">{{ $coupon->code }}</span></td>
                            <td><span class="badge bg-light text-dark border">{{ ucfirst($coupon->type) }}</span></td>
                            <td class="fw-bold text-success">
                                {{ $coupon->type === 'percentage' ? rtrim(rtrim($coupon->value, '0'), '.') . '%' : 'Rs. ' . number_format($coupon->value, 2) }}
                            </td>
                            <td>Rs. {{ number_format($coupon->min_order_amount, 2) }}</td>
                            <td>
                                {{ $coupon->used_count }} / {{ $coupon->max_uses ?: '∞' }}
                            </td>
                            <td>
                                @if($coupon->expires_at)
                                    @if(\Carbon\Carbon::parse($coupon->expires_at)->isPast())
                                        <span class="text-danger"><i class="fa-solid fa-circle-exclamation me-1"></i>Expired</span>
                                    @else
                                        {{ \Carbon\Carbon::parse($coupon->expires_at)->format('M d, Y h:i A') }}
                                    @endif
                                @else
                                    <span class="text-muted">Never expires</span>
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" style="cursor: pointer;"
                                        {{ $coupon->is_active ? 'checked' : '' }}
                                        wire:click="toggleActive({{ $coupon->id }})">
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary shadow-sm" wire:click="edit({{ $coupon->id }})">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No coupons found. Create your first discount code!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $coupons->links() }}
        </div>
    </div>

    <!-- Coupon Modal -->
    @if($isModalOpen)
    <div class="modal fade show" tabindex="-1" style="display: block; background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <div class="modal-header border-bottom-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold">{{ $couponId ? 'Edit Coupon' : 'Create New Coupon' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body px-4">
                    <form wire:submit.prevent="save">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Coupon Code</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-ticket"></i></span>
                                    <input type="text" class="form-control text-uppercase" wire:model="code" placeholder="e.g. SUMMER50">
                                </div>
                                @error('code') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Discount Type</label>
                                <select class="form-select" wire:model="type">
                                    <option value="percentage">Percentage (%)</option>
                                    <option value="fixed">Fixed Amount (Rs.)</option>
                                </select>
                                @error('type') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Discount Value</label>
                                <input type="number" step="0.01" class="form-control" wire:model="value" placeholder="e.g. 15 or 500">
                                @error('value') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Min. Order Amount (Rs.)</label>
                                <input type="number" step="0.01" class="form-control" wire:model="min_order_amount">
                                @error('min_order_amount') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Max Uses (Optional)</label>
                                <input type="number" class="form-control" wire:model="max_uses" placeholder="Leave empty for unlimited">
                                @error('max_uses') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Expiry Date (Optional)</label>
                                <input type="datetime-local" class="form-control" wire:model="expires_at">
                                @error('expires_at') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top text-end">
                            <button type="button" class="btn btn-light me-2 rounded-pill px-4" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                                <i class="fa-solid fa-save me-1"></i> Save Coupon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
