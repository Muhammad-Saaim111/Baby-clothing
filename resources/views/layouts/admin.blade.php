<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Aimee</title>
    
    <!-- Google Fonts: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Livewire Styles -->
    @livewireStyles

    <style>
        :root {
            --primary-olive: #6c8477;
            --accent-peach: #d67d65;
            --accent-peach-light: rgba(214, 125, 101, 0.1);
            --text-dark: #3a3f3b;
            --bg-light: #FAF8F5;
            --gold-luxury: #d4af37;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
            font-size: 0.95rem;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 260px;
            background-color: #ffffff;
            border-right: 1px solid rgba(108, 132, 119, 0.08);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(108, 132, 119, 0.02);
        }

        .sidebar-brand {
            padding: 24px 25px;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--accent-peach);
            text-decoration: none;
            border-bottom: 1px solid rgba(108, 132, 119, 0.05);
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.5px;
        }

        .sidebar-brand i {
            transition: transform 0.3s ease;
        }

        .sidebar-brand:hover i {
            transform: rotate(-15deg) scale(1.1);
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 15px;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-menu li {
            margin-bottom: 8px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            color: #606662;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-menu a i {
            font-size: 1.1rem;
            transition: transform 0.2s ease;
        }

        .sidebar-menu a:hover {
            background-color: var(--accent-peach-light);
            color: var(--accent-peach);
            transform: translateX(4px);
        }

        .sidebar-menu a:hover i {
            transform: scale(1.1);
        }

        .sidebar-menu a.active {
            background-color: var(--accent-peach);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(214, 125, 101, 0.25);
        }

        .sidebar-menu a.active i {
            color: #ffffff;
        }

        .admin-main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: var(--bg-light);
        }

        .admin-header {
            background-color: #ffffff;
            height: 75px;
            border-bottom: 1px solid rgba(108, 132, 119, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
            box-shadow: 0 4px 20px rgba(108, 132, 119, 0.01);
        }

        .admin-content {
            padding: 35px;
            flex-grow: 1;
        }

        .card-premium {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid rgba(108, 132, 119, 0.06);
            box-shadow: 0 10px 30px rgba(108, 132, 119, 0.03);
            padding: 28px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-premium:hover {
            box-shadow: 0 12px 35px rgba(108, 132, 119, 0.05);
        }

        /* Form Controls Style */
        .form-control, .form-select {
            border: 1.5px solid rgba(108, 132, 119, 0.15);
            border-radius: 10px;
            padding: 10px 14px;
            transition: all 0.2s ease;
            color: var(--text-dark);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-peach);
            box-shadow: 0 0 0 3px var(--accent-peach-light);
            outline: none;
        }

        .form-label {
            color: #505652;
            font-size: 0.9rem;
            margin-bottom: 6px;
        }

        /* Buttons Style */
        .btn-primary {
            background-color: var(--accent-peach);
            border-color: var(--accent-peach);
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 30px;
            transition: all 0.25s ease;
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: #be6b54 !important;
            border-color: #be6b54 !important;
            box-shadow: 0 4px 12px rgba(214, 125, 101, 0.2) !important;
            transform: translateY(-1px);
        }

        .btn-outline-primary {
            color: var(--accent-peach);
            border-color: var(--accent-peach);
            font-weight: 600;
            border-radius: 30px;
            padding: 6px 16px;
            transition: all 0.2s ease;
        }

        .btn-outline-primary:hover {
            background-color: var(--accent-peach);
            border-color: var(--accent-peach);
            color: #ffffff;
        }

        /* Tables style */
        .table {
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .table tr {
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.01);
        }

        .table th {
            border: none;
            color: #8c928e;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            padding: 12px 16px;
        }

        .table td {
            border: none;
            padding: 16px;
            background: #ffffff;
        }

        .table tr td:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .table tr td:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        /* Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <a href="/" class="sidebar-brand">
                <i class="fa-solid fa-baby-carriage"></i> Aimee Admin
            </a>
            <ul class="sidebar-menu">
                <li>
                    <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="/admin/products" class="{{ request()->is('admin/products*') ? 'active' : '' }}">
                        <i class="fa-solid fa-tags"></i> Products
                    </a>
                </li>
                <li>
                    <a href="/admin/coupons" class="{{ request()->is('admin/coupons*') ? 'active' : '' }}">
                        <i class="fa-solid fa-ticket"></i> Coupons
                    </a>
                </li>
                <li>
                    <a href="/admin/customers" class="{{ request()->is('admin/customers*') ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i> Customers
                    </a>
                </li>
                <li>
                    <a href="/admin/orders" class="{{ request()->is('admin/orders*') ? 'active' : '' }}">
                        <i class="fa-solid fa-box-open"></i> Orders
                    </a>
                </li>
                <li>
                    <a href="/admin/reviews" class="{{ request()->is('admin/reviews*') ? 'active' : '' }}">
                        <i class="fa-solid fa-star"></i> Reviews
                    </a>
                </li>
                <li>
                    <a href="/" target="_blank">
                        <i class="fa-solid fa-store"></i> View Store
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <div>
                    <h5 class="m-0 fw-bold text-dark">@yield('header_title', 'Dashboard')</h5>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 32px; height: 32px; font-size: 0.85rem; font-weight: 600; background-color: var(--accent-peach);">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <span class="fw-semibold text-dark">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                    <div class="vr" style="height: 20px; opacity: 0.15;"></div>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1" onclick="logoutAdmin(event)">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                    </button>
                </div>
            </header>

            <div class="admin-content">
                {{ $slot ?? '' }}
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Logout Admin Script -->
    <script>
        function logoutAdmin(e) {
            e.preventDefault();
            if(confirm('Are you sure you want to logout?')) {
                fetch('/logout/ajax', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        window.location.href = '/';
                    }
                });
            }
        }
    </script>
</body>
</html>
