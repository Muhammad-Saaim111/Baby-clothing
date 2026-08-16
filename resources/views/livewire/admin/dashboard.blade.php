<div>
    @section('header_title', 'Dashboard Overview')

    <style>
        /* Custom Premium KPI Cards */
        .card-kpi-premium {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid rgba(108, 132, 119, 0.08);
            box-shadow: 0 10px 30px rgba(108, 132, 119, 0.03);
            padding: 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-kpi-premium:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(108, 132, 119, 0.08);
            border-color: rgba(214, 125, 101, 0.2);
        }
        .kpi-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }
        .card-kpi-premium:hover .kpi-icon-box {
            transform: scale(1.1) rotate(6deg);
        }
        
        /* Pulse Animation for Warning Cards */
        @keyframes pulse-subtle {
            0%, 100% { border-color: rgba(220, 53, 69, 0.2); }
            50% { border-color: rgba(220, 53, 69, 0.5); }
        }
        .animate-pulse-warning {
            animation: pulse-subtle 2s infinite;
        }

        /* Chart card styling */
        .chart-container {
            position: relative;
            height: 320px;
            width: 100%;
        }

        /* Playful hover animations for sidebar & widgets */
        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }
        .wiggle-hover:hover i {
            animation: wiggle 0.4s ease-in-out;
        }

        /* Premium Badge Colors */
        .badge-pending {
            background-color: #fffbeb !important;
            color: #d97706 !important;
            border: 1px solid rgba(217, 119, 6, 0.15);
        }
        .badge-processing {
            background-color: #eff6ff !important;
            color: #2563eb !important;
            border: 1px solid rgba(37, 99, 235, 0.15);
        }
        .badge-delivered {
            background-color: #ecfdf5 !important;
            color: #059669 !important;
            border: 1px solid rgba(5, 150, 105, 0.15);
        }
        .badge-cancelled {
            background-color: #fef2f2 !important;
            color: #dc2626 !important;
            border: 1px solid rgba(220, 38, 38, 0.15);
        }
    </style>

    <!-- KPI Cards Row -->
    <div class="row g-3 mb-4">
        <!-- Total Sales -->
        <div class="col-xl-3 col-md-6">
            <div class="card-kpi-premium wiggle-hover">
                <div>
                    <div class="text-muted fw-semibold small mb-1">Total Sales</div>
                    <h3 class="fw-bold mb-0 text-success">Rs. {{ number_format($totalSales, 2) }}</h3>
                </div>
                <div class="kpi-icon-box bg-success-subtle text-success">
                    <i class="fa-solid fa-coins fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-xl-2 col-md-6">
            <div class="card-kpi-premium wiggle-hover">
                <div>
                    <div class="text-muted fw-semibold small mb-1">Total Orders</div>
                    <h3 class="fw-bold mb-0 text-primary">{{ number_format($totalOrders) }}</h3>
                </div>
                <div class="kpi-icon-box bg-primary-subtle text-primary">
                    <i class="fa-solid fa-shopping-bag fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="col-xl-2 col-md-6">
            <div class="card-kpi-premium wiggle-hover">
                <div>
                    <div class="text-muted fw-semibold small mb-1">Customers</div>
                    <h3 class="fw-bold mb-0 text-warning">{{ number_format($totalCustomers) }}</h3>
                </div>
                <div class="kpi-icon-box bg-warning-subtle text-warning">
                    <i class="fa-solid fa-users fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="col-xl-3 col-md-6">
            <div class="card-kpi-premium wiggle-hover">
                <div>
                    <div class="text-muted fw-semibold small mb-1">Pending/Processing</div>
                    <h3 class="fw-bold mb-0 text-info">{{ number_format($pendingOrders) }}</h3>
                </div>
                <div class="kpi-icon-box bg-info-subtle text-info">
                    <i class="fa-solid fa-clock-rotate-left fs-4"></i>
                </div>
            </div>
        </div>

        <!-- Low Stock Items -->
        <div class="col-xl-2 col-md-6">
            <a href="/admin/products" class="text-decoration-none">
                <div class="card-kpi-premium wiggle-hover {{ $lowStockCount > 0 ? 'border-danger-subtle bg-danger-subtle bg-opacity-10 animate-pulse-warning' : '' }}">
                    <div>
                        <div class="text-muted fw-semibold small mb-1">Low Stock</div>
                        <h3 class="fw-bold mb-0 {{ $lowStockCount > 0 ? 'text-danger' : 'text-secondary' }}">{{ number_format($lowStockCount) }}</h3>
                    </div>
                    <div class="kpi-icon-box {{ $lowStockCount > 0 ? 'bg-danger-subtle text-danger' : 'bg-light text-secondary' }}">
                        <i class="fa-solid fa-triangle-exclamation fs-4"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Sales Trends Chart Card -->
    <div class="card-premium mb-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h5 class="fw-bold mb-1 text-dark">Sales & Orders Trend</h5>
                <p class="text-muted small mb-0">Visual summary of sales revenue and order volumes over the past 30 days</p>
            </div>
            <div class="badge bg-light text-dark border p-2 px-3 rounded-pill">Last 30 Days</div>
        </div>
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Split Leaderboard and Recent Orders Section -->
    <div class="row g-4">
        <!-- Top Products Leaderboard -->
        <div class="col-lg-7">
            <div class="card-premium h-100">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Top Selling Products</h5>
                        <p class="text-muted small mb-0">Leaderboard of best-performing products by volume</p>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-semibold">Best Sellers</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th class="text-center">Sold</th>
                                <th class="text-end">Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topProducts as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            @if($item->product && $item->product->image_path)
                                                <img src="{{ asset($item->product->image_path) }}" alt="{{ $item->product_name }}" class="rounded-3" style="width: 45px; height: 45px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted" style="width: 45px; height: 45px;">
                                                    <i class="fa-solid fa-image"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold text-dark">{{ $item->product_name }}</div>
                                                <div class="text-muted small">ID: #{{ $item->product_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->product->category ?? 'N/A' }}</td>
                                    <td class="text-center fw-bold text-dark">{{ $item->qty_sold }}</td>
                                    <td class="text-end fw-semibold text-success">Rs. {{ number_format($item->revenue, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">No sales data recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Orders & Stock Warnings -->
        <div class="col-lg-5">
            <div class="d-flex flex-column gap-4 h-100">
                
                <!-- Stock Warning Panel -->
                @if($lowStockCount > 0)
                    <div class="card-premium border-danger-subtle bg-danger-subtle bg-opacity-10 py-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold mb-0 text-danger d-flex align-items-center gap-2">
                                <i class="fa-solid fa-triangle-exclamation text-danger fs-5 animate-pulse"></i>
                                Low Stock Warning ({{ $lowStockCount }})
                            </h6>
                            <a href="/admin/products" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 fw-bold text-decoration-none" style="font-size: 0.8rem;">Restock Items</a>
                        </div>
                        <div class="list-group list-group-flush rounded-3 bg-white p-1">
                            @foreach($lowStockProducts as $p)
                                <div class="list-group-item d-flex align-items-center justify-content-between py-2 border-0 border-bottom">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($p->image_path)
                                            <img src="{{ asset($p->image_path) }}" alt="{{ $p->name }}" class="rounded" style="width: 32px; height: 32px; object-fit: cover;">
                                        @endif
                                        <span class="fw-semibold text-dark small text-truncate" style="max-width: 180px;">{{ $p->name }}</span>
                                    </div>
                                    <span class="badge bg-danger text-white rounded-pill">{{ $p->stock }} left</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Recent Orders -->
                <div class="card-premium flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="fw-bold mb-1">Recent Orders</h5>
                            <p class="text-muted small mb-0">Latest orders placed on store</p>
                        </div>
                        <a href="/admin/orders" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold text-dark">#{{ $order->id }}</div>
                                            <div class="text-muted small">{{ $order->created_at->format('M d') }}</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-medium">{{ $order->user->name ?? 'Guest' }}</div>
                                        </td>
                                        <td class="fw-semibold text-dark">Rs. {{ number_format($order->total ?? 0, 2) }}</td>
                                        <td>
                                            @if($order->status === 'pending')
                                                <span class="badge badge-pending">Pending</span>
                                            @elseif($order->status === 'processing')
                                                <span class="badge badge-processing">Processing</span>
                                            @elseif($order->status === 'delivered')
                                                <span class="badge badge-delivered">Delivered</span>
                                            @elseif($order->status === 'cancelled')
                                                <span class="badge badge-cancelled">Cancelled</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">No orders found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Chart.js CDN and initialization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            initChart();
        });

        document.addEventListener('DOMContentLoaded', () => {
            initChart();
        });

        function initChart() {
            const ctx = document.getElementById('salesChart');
            if (!ctx) return;
            
            // Destroy any existing chart instances to prevent duplicate rendering issues during spa navigation
            if (window.mySalesChart) {
                window.mySalesChart.destroy();
            }

            const rawData = @json($trends);
            const labels = rawData.map(item => {
                const d = new Date(item.date);
                return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
            });
            const salesData = rawData.map(item => parseFloat(item.sales || 0));
            const ordersData = rawData.map(item => parseInt(item.count || 0));

            window.mySalesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Sales Revenue (Rs.)',
                            data: salesData,
                            borderColor: '#d67d65', // Peach accent color from variables
                            backgroundColor: 'rgba(214, 125, 101, 0.05)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Number of Orders',
                            data: ordersData,
                            borderColor: '#6c8477', // Olive primary color
                            backgroundColor: 'rgba(108, 132, 119, 0.05)',
                            borderWidth: 3,
                            fill: false,
                            tension: 0.4,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    family: 'Outfit',
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#3a3f3b',
                            titleFont: { family: 'Outfit' },
                            bodyFont: { family: 'Outfit' }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: 'Outfit'
                                }
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            grid: {
                                color: 'rgba(108, 132, 119, 0.05)'
                            },
                            ticks: {
                                font: {
                                    family: 'Outfit'
                                },
                                callback: function(value) {
                                    return 'Rs. ' + value.toLocaleString();
                                }
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false
                            },
                            ticks: {
                                font: {
                                    family: 'Outfit'
                                },
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
    </script>
</div>
