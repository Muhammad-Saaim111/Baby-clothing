<div>
    @section('header_title', 'Product Management')

    <div class="card-premium">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Products List</h5>
            <button class="btn btn-primary btn-sm px-4 rounded-pill shadow-sm" wire:click="openModal">
                <i class="fa-solid fa-plus me-1"></i> Add New Product
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover; border: 1px solid #eaeaea;">
                            </td>
                            <td class="fw-medium text-truncate" style="max-width: 200px;" title="{{ $product->name }}">{{ $product->name }}</td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $product->category }}</span>
                                @if($product->subcategory)
                                    <br><small class="text-muted">{{ $product->subcategory }}</small>
                                @endif
                            </td>
                            <td>Rs. {{ number_format($product->price, 2) }}</td>
                            <td>
                                @if($product->stock > 10)
                                    <span class="text-success fw-bold">{{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span class="text-warning fw-bold">{{ $product->stock }}</span>
                                @else
                                    <span class="badge bg-danger">Out of Stock</span>
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" style="cursor: pointer;"
                                        {{ $product->is_active ? 'checked' : '' }}
                                        wire:click="toggleActive({{ $product->id }})">
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary shadow-sm" wire:click="edit({{ $product->id }})">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No products found. Start by adding one!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Product Modal -->
    @if($isModalOpen)
    <div class="modal fade show" tabindex="-1" style="display: block; background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <div class="modal-header border-bottom-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold">{{ $productId ? 'Edit Product' : 'Add New Product' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body px-4">
                    <form wire:submit.prevent="save">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Product Name</label>
                                <input type="text" class="form-control" wire:model="name" placeholder="e.g. Cute Bunny Romper">
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Category (Gender)</label>
                                <select class="form-select" wire:model="category">
                                    <option value="">Select Category</option>
                                    <option value="Little Boys">Little Boys</option>
                                    <option value="Little Girls">Little Girls</option>
                                    <option value="New Born">New Born</option>
                                    <option value="Accessories">Accessories</option>
                                </select>
                                @error('category') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Subcategory (Type)</label>
                                <select class="form-select" wire:model="subcategory">
                                    <option value="">Select Subcategory</option>
                                    <option value="Sweatshirts">Sweatshirts</option>
                                    <option value="Rompers">Rompers</option>
                                    <option value="Bodysuits">Bodysuits</option>
                                    <option value="Sweaters">Sweaters</option>
                                    <option value="Puffer Vests">Puffer Vests</option>
                                </select>
                                @error('subcategory') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Price (Rs.)</label>
                                <input type="number" step="0.01" class="form-control" wire:model="price">
                                @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Old Price (Optional)</label>
                                <input type="number" step="0.01" class="form-control" wire:model="old_price">
                                @error('old_price') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Stock Quantity</label>
                                <input type="number" class="form-control" wire:model="stock">
                                @error('stock') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea class="form-control" rows="3" wire:model="description"></textarea>
                                @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Available Sizes (Multi-select)</label>
                                <div class="d-flex flex-wrap gap-3 p-3 bg-light rounded border" style="border-color: rgba(108, 132, 119, 0.15) !important;">
                                    @foreach(['1-2Y', '2-3Y', '3-4Y', '4-5Y', '5-6Y', '6-7Y', '7-8Y'] as $size)
                                        <div class="form-check form-check-inline m-0">
                                            <input class="form-check-input" type="checkbox" id="size_{{ $size }}" value="{{ $size }}" wire:model="sizes" style="cursor: pointer;">
                                            <label class="form-check-label fw-semibold text-dark" for="size_{{ $size }}" style="cursor: pointer;">{{ $size }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Front View Image -->
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Front View (Main Image)</label>
                                <input type="file" class="form-control" wire:model="new_image" accept="image/*">
                                <div wire:loading wire:target="new_image" class="text-primary small mt-1">Uploading...</div>
                                @error('new_image') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-center justify-content-start">
                                @if ($new_image)
                                    <img src="{{ $new_image->temporaryUrl() }}" class="rounded shadow-sm" style="height: 50px;">
                                @elseif ($image_path)
                                    <img src="{{ asset($image_path) }}" class="rounded shadow-sm" style="height: 50px;">
                                @endif
                            </div>

                            <!-- Back View Image -->
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Back View (Optional)</label>
                                <input type="file" class="form-control" wire:model="new_back_image" accept="image/*">
                                <div wire:loading wire:target="new_back_image" class="text-primary small mt-1">Uploading...</div>
                                @error('new_back_image') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-center justify-content-start">
                                @if ($new_back_image)
                                    <img src="{{ $new_back_image->temporaryUrl() }}" class="rounded shadow-sm" style="height: 50px;">
                                @elseif ($back_image_path)
                                    <img src="{{ asset($back_image_path) }}" class="rounded shadow-sm" style="height: 50px;">
                                @endif
                            </div>

                            <!-- Lifestyle View Image -->
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Lifestyle Pic (Optional)</label>
                                <input type="file" class="form-control" wire:model="new_lifestyle_image" accept="image/*">
                                <div wire:loading wire:target="new_lifestyle_image" class="text-primary small mt-1">Uploading...</div>
                                @error('new_lifestyle_image') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-center justify-content-start">
                                @if ($new_lifestyle_image)
                                    <img src="{{ $new_lifestyle_image->temporaryUrl() }}" class="rounded shadow-sm" style="height: 50px;">
                                @elseif ($lifestyle_image_path)
                                    <img src="{{ asset($lifestyle_image_path) }}" class="rounded shadow-sm" style="height: 50px;">
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top text-end">
                            <button type="button" class="btn btn-light me-2 rounded-pill px-4" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                                <i class="fa-solid fa-save me-1"></i> Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
