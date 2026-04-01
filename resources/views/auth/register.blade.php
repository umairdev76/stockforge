<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | TaskForge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
        }

        .register-container {
            display: flex;
            width: 100%;
        }

        /* Left Side: Branding (Consistent with Login) */
        .brand-side {
            flex: 1;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-right: 1px solid #f3f4f6;
        }

        .brand-side .logo-icon {
            font-size: 80px;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .brand-side h1 {
            font-weight: 700;
            color: #1e293b;
            font-size: 3rem;
            margin-bottom: 5px;
        }

        .brand-side p {
            color: #64748b;
            font-size: 1.2rem;
        }

        /* Right Side: Form */
        .form-side {
            flex: 1;
            background-color: #f9fafb;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            overflow-y: auto;
        }

        .register-card {
            width: 100%;
            max-width: 450px;
        }

        .register-card h2 {
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .register-card p.subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        .input-group-text {
            background-color: white;
            border-right: none;
            color: #9ca3af;
        }

        .form-control {
            border-left: none;
            padding: 10px;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .input-group:focus-within {
            outline: 2px solid #10b981;
            border-radius: 8px;
        }

        .btn-register {
            background-color: #10b981;
            border: none;
            color: white;
            padding: 12px;
            font-weight: 600;
            border-radius: 30px;
            width: 100%;
            margin-top: 15px;
            transition: opacity 0.3s;
        }

        .btn-register:hover {
            opacity: 0.9;
            color: white;
        }

        .login-link {
            font-size: 0.9rem;
            color: #6b7280;
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .brand-side {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="register-container">
        <div class="brand-side">
            <div class="logo-icon"><i class="bi bi-stack"></i></div>
            <h1>TaskForge</h1>
            <p>Productivity, Forged.</p>
        </div>

        <div class="form-side">
            <div class="register-card">
                <h2>Create Account</h2>
                <p class="subtitle">Join TaskForge to start managing projects.</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                        </div>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" id="email" name="email" class="form-control" placeholder="john@example.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-register shadow-sm">Register</button>

                    <div class="login-link">
                        Already have an account? <a href="{{ route('login') }}">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>