<div>
    @section('header_title', 'Order Management')
    
    <div class="card-premium">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">All Orders</h5>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="table-responsive" style="min-height: 300px; overflow: visible;">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">Order ID</th>
                        <th class="py-3">Customer</th>
                        <th class="py-3">Amount</th>
                        <th class="py-3">Date</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="fw-bold text-secondary">#{{ $order->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 40px; height: 40px; border: 1px solid #eaeaea;">
                                        {{ strtoupper(substr($order->first_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="fw-medium text-dark">{{ $order->first_name }} {{ $order->last_name }}</span><br>
                                        <small class="text-muted"><i class="fa-regular fa-envelope me-1"></i>{{ $order->email ?? '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-medium">Rs. {{ number_format($order->total ?? 0, 2) }}</td>
                            <td><span class="text-muted"><i class="fa-regular fa-calendar me-1"></i>{{ $order->created_at->format('M d, Y h:i A') }}</span></td>
                            <td>
                                @if($order->status === 'pending')
                                    <span class="badge bg-light text-warning border border-warning px-3 py-2 rounded-pill"><i class="fa-regular fa-clock me-1"></i> Pending</span>
                                @elseif($order->status === 'processing')
                                    <span class="badge bg-light text-primary border border-primary px-3 py-2 rounded-pill"><i class="fa-solid fa-spinner fa-spin me-1"></i> Processing</span>
                                @elseif($order->status === 'delivered')
                                    <span class="badge bg-light text-success border border-success px-3 py-2 rounded-pill"><i class="fa-solid fa-check-double me-1"></i> Delivered</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-end pe-2">
                                    <button class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm" wire:click="openViewModal({{ $order->id }})">
                                        <i class="fa-solid fa-eye me-1"></i> View
                                    </button>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Update Status
                                        </button>
                                        <ul class="dropdown-menu shadow border-0">
                                            <li><button class="dropdown-item" wire:click="updateStatus({{ $order->id }}, 'pending')"><i class="fa-regular fa-clock me-2 text-warning"></i>Pending</button></li>
                                            <li><button class="dropdown-item" wire:click="updateStatus({{ $order->id }}, 'processing')"><i class="fa-solid fa-spinner me-2 text-primary"></i>Processing</button></li>
                                            <li><button class="dropdown-item" wire:click="updateStatus({{ $order->id }}, 'delivered')"><i class="fa-solid fa-check-double me-2 text-success"></i>Delivered</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- View Order Modal -->
    @if($isViewModalOpen && $viewingOrder)
    <div class="modal fade show" tabindex="-1" style="display: block; background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <div class="modal-header border-bottom-0 pt-4 px-4 bg-light rounded-top">
                    <h5 class="modal-title fw-bold">Order #{{ $viewingOrder->id }} Details</h5>
                    <button type="button" class="btn-close" wire:click="closeViewModal"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-muted mb-2">Customer Info</h6>
                            <div class="p-3 bg-light rounded">
                                <p class="mb-1 fw-bold">{{ $viewingOrder->first_name }} {{ $viewingOrder->last_name }}</p>
                                <p class="mb-1"><i class="fa-solid fa-envelope me-2 text-muted"></i>{{ $viewingOrder->email }}</p>
                                <p class="mb-0"><i class="fa-solid fa-phone me-2 text-muted"></i>{{ $viewingOrder->phone }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold text-muted mb-2">Shipping Address</h6>
                            <div class="p-3 bg-light rounded h-100">
                                <p class="mb-1">{{ $viewingOrder->address }}</p>
                                @if($viewingOrder->apartment)
                                    <p class="mb-1">{{ $viewingOrder->apartment }}</p>
                                @endif
                                <p class="mb-0">{{ $viewingOrder->city }}, {{ $viewingOrder->postal_code }}</p>
                            </div>
                        </div>
                    </div>

                    <h6 class="fw-bold text-muted mb-2">Order Items</h6>
                    <div class="table-responsive mb-4">
                        <table class="table table-sm table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th>Size/Color</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewingOrder->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? 'Unknown Product' }}</td>
                                        <td>
                                            @if($item->size) Size: {{ $item->size }}<br> @endif
                                            @if($item->color) Color: {{ $item->color }} @endif
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">Rs. {{ number_format($item->price, 2) }}</td>
                                        <td class="text-end fw-medium">Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-muted mb-2">Payment Details</h6>
                            <div class="p-3 bg-light rounded">
                                <p class="mb-1"><strong>Method:</strong> {{ strtoupper($viewingOrder->payment_method) }}</p>
                                <p class="mb-1"><strong>Status:</strong> 
                                    @if($viewingOrder->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($viewingOrder->status === 'processing')
                                        <span class="badge bg-info text-dark">Processing</span>
                                    @elseif($viewingOrder->status === 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($viewingOrder->status) }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded text-end">
                                <p class="mb-1">Subtotal: Rs. {{ number_format($viewingOrder->subtotal, 2) }}</p>
                                <p class="mb-1 text-danger">Discount: -Rs. {{ number_format($viewingOrder->discount, 2) }}</p>
                                <p class="mb-2 border-bottom pb-2">Shipping: Rs. {{ number_format($viewingOrder->shipping, 2) }}</p>
                                <h5 class="fw-bold mb-0">Total: Rs. {{ number_format($viewingOrder->total, 2) }}</h5>
                            </div>
                        </div>
                    </div>

                    @if($viewingOrder->special_instructions)
                        <div class="mt-4">
                            <h6 class="fw-bold text-muted mb-2">Order Notes</h6>
                            <div class="p-3 bg-warning bg-opacity-10 rounded border border-warning">
                                {{ $viewingOrder->special_instructions }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" wire:click="closeViewModal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
