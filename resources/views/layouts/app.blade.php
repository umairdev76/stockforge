<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockForge - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body>
    <div class="bg-orb orb-1" aria-hidden="true"></div>
    <div class="bg-orb orb-2" aria-hidden="true"></div>

    <div class="app-shell">
        <div class="sidebar">
            <div class="logo">
                <span class="brand-badge"><i class="bi bi-stack"></i></span>
                <div class="brand-text">
                    <span class="brand-title">StockForge</span>
                    <span class="brand-subtitle">Inventory Studio</span>
                </div>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link active" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid-fill me-2"></i> Dashboard
                </a>

                <a class="nav-link" href="{{ route('product.index') }}">
                    <i class="bi bi-box-seam me-2"></i> Products
                </a>

                <a class="nav-link" href="{{ route('supplier.index') }}">
                    <i class="bi bi-truck me-2"></i> Suppliers
                </a>
                <a class="nav-link" href="{{ route('category.index') }}">
                    <i class="bi bi-truck me-2"></i> Categories
                </a>
                <a class="nav-link" href="{{ route('purchaseOrder.index') }}">
                    <i class="bi bi-cart-check me-2"></i> Purchase Orders
                </a>
                <a class="nav-link" href="">
                    <i class="bi bi-bar-chart-line me-2"></i> Reports
                </a>
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="bi bi-people me-2"></i> Users
                </a>
            </nav>
        </div>

        <div class="main-content">
            <div class="top-nav d-flex justify-content-between align-items-center">
                <div class="links">
                    <a href="#" class="pill-link active">Overview</a>
                    <a href="#" class="pill-link">Reports</a>
                </div>
                <div class="user-profile">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="profile-meta">
                        <span class="profile-name">{{ auth()->user()->name }}</span>
                        <span class="profile-role">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="profile-logout-form">
                        @csrf
                        <button type="submit" class="profile-logout-btn">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-4">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @yield('content')
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>