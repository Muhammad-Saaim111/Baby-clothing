<div>
    @section('header_title', 'Automated Marketing Funnel')
    
    <div class="card-premium">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Abandoned Carts (Drip Campaigns)</h5>
            <button class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm" onclick="alert('The funnel runs automatically every 15 minutes in the background.')">
                <i class="fa-solid fa-robot me-1"></i> Automation Active
            </button>
        </div>

        <div class="alert alert-info border-0 shadow-sm rounded-3">
            <strong><i class="fa-solid fa-circle-info me-1"></i> How it works:</strong>
            <ul class="mb-0 mt-2">
                <li><strong>Step 1 (1 hr):</strong> Send gentle reminder email.</li>
                <li><strong>Step 2 (2 hrs):</strong> Send "Greedy" discount (5% to 15% off) based on cart value.</li>
                <li><strong>Step 3 (3 hrs):</strong> Send FOMO Alert (offer expiring soon).</li>
                <li><strong>Cleared (3.5 hrs):</strong> Abandoned cart cleared.</li>
            </ul>
        </div>

        <div class="table-responsive mt-4" style="min-height: 300px;">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">Customer</th>
                        <th class="py-3">Cart Value</th>
                        <th class="py-3">Last Active</th>
                        <th class="py-3">Funnel Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($funnels as $funnel)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 40px; height: 40px; border: 1px solid #eaeaea;">
                                        {{ $funnel->email ? strtoupper(substr($funnel->email, 0, 1)) : '?' }}
                                    </div>
                                    <div>
                                        <span class="fw-medium text-dark">{{ $funnel->email }}</span><br>
                                        <small class="text-muted"><i class="fa-solid fa-cart-shopping me-1"></i>{{ count($funnel->cart_data ?? []) }} items</small>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-medium">Rs. {{ number_format($funnel->total_value, 2) }}</td>
                            <td>
                                <span class="text-muted"><i class="fa-regular fa-clock me-1"></i>{{ $funnel->last_active_at ? $funnel->last_active_at->diffForHumans() : 'Unknown' }}</span>
                            </td>
                            <td>
                                @if($funnel->funnel_step == 0)
                                    <span class="badge bg-light text-secondary border border-secondary px-3 py-2 rounded-pill">Active / Waiting</span>
                                @elseif($funnel->funnel_step == 1)
                                    <span class="badge bg-light text-primary border border-primary px-3 py-2 rounded-pill">Step 1: Reminder Sent</span>
                                @elseif($funnel->funnel_step == 2)
                                    <span class="badge bg-light text-warning border border-warning px-3 py-2 rounded-pill">Step 2: Greedy Discount</span>
                                @elseif($funnel->funnel_step == 3)
                                    <span class="badge bg-light text-danger border border-danger px-3 py-2 rounded-pill">Step 3: FOMO Alert</span>
                                @elseif($funnel->funnel_step == 4)
                                    <span class="badge bg-light text-dark border border-dark px-3 py-2 rounded-pill">Cleared</span>
                                @elseif($funnel->funnel_step == 5)
                                    <span class="badge bg-light text-success border border-success px-3 py-2 rounded-pill"><i class="fa-solid fa-check-double me-1"></i> Recovered!</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fa-regular fa-face-smile fa-3x mb-3 text-light"></i><br>
                                No abandoned carts yet. Automation is running.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
