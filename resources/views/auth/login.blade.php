<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | StockForge Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stockforge.css') }}">
</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            <div class="col-lg-6 d-none d-lg-flex bg-stock-gradient align-items-center justify-content-center text-white p-5">
                <div class="text-center">
                    <div class="mb-4">
                        <i class="bi bi-box-seam display-1 text-white-50"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-3">StockForge</h1>
                    <p class="lead text-white-50">Precision Inventory. Forged for Scale.</p>

                    <div class="mt-5 p-4 glass-card text-start">
                        <div class="d-flex align-items-center mb-3">
                            <div class="spinner-grow spinner-grow-sm text-warning me-2" role="status"></div>
                            <span class="small fw-bold uppercase">System Status: Active</span>
                        </div>
                        <div class="small opacity-75">Tracking 450+ Products across 8 Suppliers</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white p-4 p-md-5">
                <div class="w-100" style="max-width: 420px;">
                    <div class="mb-5 text-center d-lg-none">
                        <h2 class="fw-bold text-primary">StockForge</h2>
                    </div>

                    <div class="mb-4">
                        <h2 class="fw-bold">Sign In</h2>
                        <p class="text-muted">Welcome back! Please enter your details.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <div class="input-group border rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control border-0 py-2 @error('email') is-invalid @enderror" placeholder="manager@stockforge.com" value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label fw-semibold">Password</label>
                                <a href="{{ route('password.request') }}" class="text-decoration-none small fw-bold text-primary">Forgot?</a>
                            </div>
                            <div class="input-group border rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-shield-lock text-muted"></i></span>
                                <input type="password" name="password" id="password" class="form-control border-0 py-2 @error('password') is-invalid @enderror" placeholder="••••••••" required>
                                <button class="btn bg-light border-0 text-muted px-3" type="button" onclick="togglePassword()">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input shadow-none" id="remember" name="remember">
                                <label class="form-check-label small text-muted" for="remember">Stay logged in</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow-sm border-0">
                            Enter StockForge <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>

                    <div class="mt-5 text-center">
                        <p class="small text-muted mb-0">Production Environment v12.0.1</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>

</html>