<div>
    @section('header_title', 'Dashboard Overview')

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card-premium h-100 d-flex flex-column justify-content-center">
                <div class="text-muted fw-semibold mb-2">Total Sales</div>
                <h2 class="fw-bold mb-0 text-success">Rs. {{ number_format($totalSales, 2) }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-premium h-100 d-flex flex-column justify-content-center">
                <div class="text-muted fw-semibold mb-2">Total Orders</div>
                <h2 class="fw-bold mb-0 text-primary">{{ number_format($totalOrders) }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-premium h-100 d-flex flex-column justify-content-center">
                <div class="text-muted fw-semibold mb-2">Total Customers</div>
                <h2 class="fw-bold mb-0 text-warning">{{ number_format($totalCustomers) }}</h2>
            </div>
        </div>
    </div>

    <div class="card-premium">
        <h5 class="fw-bold mb-3">Recent Orders</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'Guest' }}</td>
                            <td>Rs. {{ number_format($order->total ?? 0, 2) }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($order->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($order->status === 'processing')
                                    <span class="badge bg-info text-dark">Processing</span>
                                @elseif($order->status === 'delivered')
                                    <span class="badge bg-success">Delivered</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
