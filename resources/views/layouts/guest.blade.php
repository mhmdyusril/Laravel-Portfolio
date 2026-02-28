<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.svg">
    <title>{{ config('app.name', 'Portfolio') }} — Admin</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(124,58,237,0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(37,99,235,0.08) 0%, transparent 50%);
        }
        .login-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
        }
        .gradient-text {
            background: linear-gradient(135deg, #a78bfa, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .form-control {
            background: rgba(255,255,255,0.05) !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            color: #e2e8f0 !important;
            border-radius: 12px !important;
            padding: 0.75rem 1rem !important;
        }
        .form-control:focus {
            border-color: rgba(124,58,237,0.5) !important;
            box-shadow: 0 0 0 3px rgba(124,58,237,0.1) !important;
        }
        .form-control::placeholder { color: #4a5568 !important; }
        .form-label { color: #94a3b8; font-size: 0.8rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; }
        .btn-login {
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(124,58,237,0.3);
            color: white;
        }
        .divider { border-color: rgba(255,255,255,0.08); }
        .text-muted-custom { color: #4a5568 !important; }
        .invalid-feedback { color: #f87171; font-size: 0.75rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none">
                <span class="fs-2 fw-black gradient-text">MY.</span>
            </a>
            <p class="mt-1 mb-0" style="color:#64748b;font-size:0.8rem">Admin Panel</p>
        </div>

        <hr class="divider mb-4">

        {{ $slot }}

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-decoration-none" style="color:#4a5568;font-size:0.8rem;">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Portfolio
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
