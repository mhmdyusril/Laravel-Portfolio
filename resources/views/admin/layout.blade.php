<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.svg">
    <title>Admin — @yield('title', 'Dashboard')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8f9fa; }
        .sidebar { width: 260px; min-height: 100vh; background: linear-gradient(160deg, #1e1b4b 0%, #312e81 50%, #1e3a8a 100%); position: fixed; top: 0; left: 0; z-index: 100; }
        .sidebar-brand { padding: 1.5rem 1.5rem 1rem; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-nav .nav-link { color: rgba(255,255,255,0.65); padding: 0.6rem 1.5rem; font-size: 0.875rem; font-weight: 500; border-radius: 0; transition: all 0.2s; display: flex; align-items: center; gap: 0.75rem; }
        .sidebar-nav .nav-link:hover, .sidebar-nav .nav-link.active { color: #fff; background: rgba(255,255,255,0.1); border-right: 3px solid #a78bfa; }
        .sidebar-nav .nav-section { padding: 1rem 1.5rem 0.25rem; color: rgba(255,255,255,0.3); font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; }
        .main-content { margin-left: 260px; min-height: 100vh; }
        .topbar { background: #fff; border-bottom: 1px solid #e9ecef; padding: 1rem 1.5rem; display: flex; align-items: center; justify-content: space-between; }
        .page-header { background: linear-gradient(135deg, #7c3aed, #2563eb); color: white; padding: 1.5rem 1.5rem; }
        .card { border: none; box-shadow: 0 1px 3px rgba(0,0,0,0.07); border-radius: 12px; }
        .stat-card { border-left: 4px solid; }
        .btn-primary { background: linear-gradient(135deg, #7c3aed, #2563eb); border: none; }
        .btn-primary:hover { background: linear-gradient(135deg, #6d28d9, #1d4ed8); }
        .badge-category { background: rgba(124,58,237,0.1); color: #7c3aed; border: 1px solid rgba(124,58,237,0.2); }
        @media (max-width: 768px) { .sidebar { transform: translateX(-100%); } .main-content { margin-left: 0; } }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}" class="text-decoration-none">
                <span class="fs-5 fw-bold text-white">MY.</span>
                <span class="text-white-50 ms-2 small">Admin Panel</span>
            </a>
        </div>
        <div class="sidebar-nav mt-2">
            <p class="nav-section">Main</p>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('home') }}" target="_blank" class="nav-link">
                <i class="bi bi-eye"></i> Lihat Portfolio
            </a>
            <p class="nav-section">Content</p>
            <a href="{{ route('admin.personal.edit') }}" class="nav-link {{ request()->routeIs('admin.personal.*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Personal Info
            </a>
            <a href="{{ route('admin.skills.index') }}" class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                <i class="bi bi-stars"></i> Skills
            </a>
            <a href="{{ route('admin.experiences.index') }}" class="nav-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                <i class="bi bi-briefcase"></i> Experience
            </a>
            <a href="{{ route('admin.educations.index') }}" class="nav-link {{ request()->routeIs('admin.educations.*') ? 'active' : '' }}">
                <i class="bi bi-mortarboard"></i> Education
            </a>
            <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <i class="bi bi-folder2-open"></i> Projects
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i> Messages
                @php $unread = \App\Models\Contact::where('is_read', false)->count(); @endphp
                @if($unread > 0)
                <span class="badge bg-danger ms-auto">{{ $unread }}</span>
                @endif
            </a>
            <p class="nav-section">Account</p>
            <a href="{{ route('admin.profile.edit') }}" class="nav-link">
                <i class="bi bi-gear"></i> Profile
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <span class="fw-semibold text-secondary small">@yield('breadcrumb', 'Dashboard')</span>
            <div class="d-flex align-items-center gap-2">
                <span class="small text-secondary">{{ auth()->user()->name ?? 'Admin' }}</span>
                <div class="w-8 h-8 rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width:32px;height:32px;background:linear-gradient(135deg,#7c3aed,#2563eb)!important;">
                    <span class="text-white small fw-bold">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h4 class="fw-bold mb-0">@yield('page-title', 'Dashboard')</h4>
            <p class="mb-0 opacity-75 small mt-1">@yield('page-subtitle', '')</p>
        </div>

        <!-- Content -->
        <div class="p-4">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
