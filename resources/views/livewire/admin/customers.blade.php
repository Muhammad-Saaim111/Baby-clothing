<div>
    @section('header_title', 'Customer Management')

    <div class="card-premium">
        <h5 class="fw-bold mb-4">Registered Customers</h5>

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Joined At</th>
                        <th>Total Orders</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($customer->avatar)
                                        <img src="{{ $customer->avatar }}" class="rounded-circle me-2" width="35" height="35" alt="Avatar">
                                    @else
                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                            {{ substr($customer->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <span class="fw-medium">{{ $customer->name }}</span>
                                </div>
                            </td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $customer->orders_count }} Orders</span>
                            </td>
                            <td>
                                @if($customer->is_blocked)
                                    <span class="badge bg-danger">Blocked</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm {{ $customer->is_blocked ? 'btn-success' : 'btn-outline-danger' }} shadow-sm" wire:click="toggleBlock({{ $customer->id }})">
                                    @if($customer->is_blocked)
                                        <i class="fa-solid fa-unlock"></i> Unblock
                                    @else
                                        <i class="fa-solid fa-ban"></i> Block
                                    @endif
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $customers->links() }}
        </div>
    </div>
</div>
