<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio Muhamad Yusril - Full Stack Software Developer dengan keahlian Laravel, PostgreSQL, dan REST API.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="shortcut icon" href="/favicon.svg">
    <title>@yield('title', 'Muhamad Yusril — Full Stack Developer')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: { 500: '#7c3aed', 600: '#6d28d9', 400: '#a78bfa' },
                        accent:  { 500: '#2563eb', 400: '#60a5fa' },
                    },
                }
            }
        }
    </script>

    <style>
        /* ===== CSS VARIABLES ===== */
        :root {
            --bg:          #0a0a0a;
            --bg-2:        rgba(255,255,255,0.05);
            --bg-3:        rgba(0,0,0,0.4);
            --border:      rgba(255,255,255,0.1);
            --border-dim:  rgba(255,255,255,0.05);
            --text:        #e2e8f0;
            --text-muted:  #94a3b8;
            --text-dim:    #4a5568;
        }
        html[data-theme="light"] {
            --bg:          #f8fafc;
            --bg-2:        rgba(0,0,0,0.04);
            --bg-3:        rgba(255,255,255,0.8);
            --border:      rgba(0,0,0,0.1);
            --border-dim:  rgba(0,0,0,0.06);
            --text:        #1e293b;
            --text-muted:  #475569;
            --text-dim:    #94a3b8;
        }

        /* ===== BASE ===== */
        body { font-family:'Inter',sans-serif; background:var(--bg); color:var(--text); transition:background 0.3s, color 0.3s; }
        .glass        { background:var(--bg-2); backdrop-filter:blur(12px); border:1px solid var(--border); }
        .glass-dark   { background:var(--bg-3); backdrop-filter:blur(12px); border:1px solid var(--border); }
        .gradient-text{ background:linear-gradient(135deg,#a78bfa,#60a5fa); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .gradient-bg  { background:linear-gradient(135deg,#7c3aed,#2563eb); background-size:200% 200%; animation:gradient 6s ease infinite; }
        .hero-bg      {
            background: radial-gradient(ellipse at 20% 50%, rgba(124,58,237,0.15) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 20%, rgba(37,99,235,0.1) 0%, transparent 50%), var(--bg);
        }
        html[data-theme="light"] .hero-bg {
            background: radial-gradient(ellipse at 20% 50%, rgba(124,58,237,0.08) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 20%, rgba(37,99,235,0.06) 0%, transparent 50%), var(--bg);
        }
        .reveal { opacity:0; transform:translateY(30px); transition:all 0.7s ease; }
        .reveal.visible { opacity:1; transform:translateY(0); }
        .tech-badge  { background:rgba(124,58,237,0.15); border:1px solid rgba(124,58,237,0.3); color:#a78bfa; padding:0.25rem 0.75rem; border-radius:9999px; font-size:0.75rem; font-weight:500; }
        .skill-badge { background:rgba(37,99,235,0.1); border:1px solid rgba(37,99,235,0.25); color:#93c5fd; padding:0.375rem 1rem; border-radius:9999px; font-size:0.875rem; transition:all 0.3s; }
        .skill-badge:hover { background:rgba(37,99,235,0.25); transform:translateY(-2px); }
        html[data-theme="light"] .skill-badge { background:rgba(37,99,235,0.08); color:#1d4ed8; border-color:rgba(37,99,235,0.2); }
        html[data-theme="light"] .tech-badge  { background:rgba(124,58,237,0.08); color:#7c3aed; border-color:rgba(124,58,237,0.25); }
        .timeline-line::before { content:''; position:absolute; left:7px; top:0; bottom:0; width:2px; background:linear-gradient(to bottom,#7c3aed,#2563eb,transparent); }

        /* ===== SECTION TEXT COLORS IN LIGHT MODE ===== */
        html[data-theme="light"] .text-slate-300 { color:#334155 !important; }
        html[data-theme="light"] .text-slate-400 { color:#475569 !important; }
        html[data-theme="light"] .text-slate-500 { color:#64748b !important; }
        html[data-theme="light"] .text-slate-600 { color:#94a3b8 !important; }
        html[data-theme="light"] .text-white     { color:#0f172a !important; }
        html[data-theme="light"] .glass { box-shadow:0 1px 4px rgba(0,0,0,0.06); }

        /* ===== NAV CONTROLS (lang + theme) ===== */
        .nav-ctrl-btn {
            display:inline-flex; align-items:center; gap:4px;
            padding:4px 10px; border-radius:9999px; font-size:0.75rem; font-weight:600;
            border:1px solid var(--border); background:var(--bg-2);
            color:var(--text-muted); cursor:pointer; transition:all 0.2s;
        }
        .nav-ctrl-btn:hover { background:rgba(124,58,237,0.15); border-color:rgba(124,58,237,0.4); color:#a78bfa; }
        .nav-ctrl-btn.active-lang { color:#a78bfa; border-color:rgba(124,58,237,0.4); }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width:6px; }
        ::-webkit-scrollbar-track { background:var(--bg); }
        ::-webkit-scrollbar-thumb { background:#7c3aed; border-radius:3px; }

        @keyframes gradient { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
        .float-anim { animation:float 4s ease-in-out infinite; }
    </style>

    @stack('styles')
</head>
<body class="antialiased">

    <!-- ===== NAVBAR ===== -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" style="background:transparent;">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Brand -->
            <a href="#hero" class="font-bold text-xl gradient-text">MY.</a>

            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-center gap-6 text-sm font-medium" style="color:var(--text-muted)">
                <a href="#about"      class="hover:text-purple-400 transition-colors">{{ __('portfolio.nav_about') }}</a>
                <a href="#skills"     class="hover:text-purple-400 transition-colors">{{ __('portfolio.nav_skills') }}</a>
                <a href="#experience" class="hover:text-purple-400 transition-colors">{{ __('portfolio.nav_experience') }}</a>
                <a href="#projects"   class="hover:text-purple-400 transition-colors">{{ __('portfolio.nav_projects') }}</a>
                <a href="#education"  class="hover:text-purple-400 transition-colors">{{ __('portfolio.nav_education') }}</a>
                <a href="#contact"    class="hover:text-purple-400 transition-colors">{{ __('portfolio.nav_contact') }}</a>
            </div>

            <!-- Controls: Lang + Theme + Mobile Burger -->
            <div class="flex items-center gap-2">
                <!-- Language Switcher -->
                <div class="flex items-center rounded-full overflow-hidden" style="border:1px solid var(--border); background:var(--bg-2);">
                    <a href="{{ route('locale.switch', 'id') }}"
                       class="px-3 py-1 text-xs font-bold transition-all duration-200 {{ app()->getLocale() === 'id' ? 'gradient-bg text-white' : '' }}"
                       style="{{ app()->getLocale() !== 'id' ? 'color:var(--text-dim)' : '' }}">ID</a>
                    <span style="color:var(--border); font-size:0.7rem">|</span>
                    <a href="{{ route('locale.switch', 'en') }}"
                       class="px-3 py-1 text-xs font-bold transition-all duration-200 {{ app()->getLocale() === 'en' ? 'gradient-bg text-white' : '' }}"
                       style="{{ app()->getLocale() !== 'en' ? 'color:var(--text-dim)' : '' }}">EN</a>
                </div>

                <!-- Dark / Light Toggle -->
                <button id="theme-toggle" class="nav-ctrl-btn" title="Toggle theme" onclick="toggleTheme()">
                    <span id="theme-icon">🌙</span>
                </button>

                <!-- Mobile Burger -->
                <button id="burger" class="md:hidden nav-ctrl-btn">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden glass-dark mx-4 mb-2 rounded-xl p-4">
            <div class="flex flex-col gap-3 text-sm font-medium" style="color:var(--text-muted)">
                <a href="#about"      onclick="closeMobile()">{{ __('portfolio.nav_about') }}</a>
                <a href="#skills"     onclick="closeMobile()">{{ __('portfolio.nav_skills') }}</a>
                <a href="#experience" onclick="closeMobile()">{{ __('portfolio.nav_experience') }}</a>
                <a href="#projects"   onclick="closeMobile()">{{ __('portfolio.nav_projects') }}</a>
                <a href="#education"  onclick="closeMobile()">{{ __('portfolio.nav_education') }}</a>
                <a href="#contact"    onclick="closeMobile()">{{ __('portfolio.nav_contact') }}</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="py-8 text-center text-sm" style="border-top:1px solid var(--border-dim); color:var(--text-dim)">
        <p>© {{ date('Y') }} <span style="color:var(--text-muted); font-weight:500">Muhamad Yusril</span>. {{ __('portfolio.footer') }}</p>
    </footer>

    <script>
        // ===== THEME =====
        (function() {
            const saved = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', saved);
            const icon = document.getElementById('theme-icon');
            if (icon) icon.textContent = saved === 'dark' ? '🌙' : '☀️';
        })();

        function toggleTheme() {
            const html = document.documentElement;
            const current = html.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            document.getElementById('theme-icon').textContent = next === 'dark' ? '🌙' : '☀️';
        }

        // ===== NAVBAR SCROLL =====
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                navbar.style.background = isDark ? 'rgba(10,10,10,0.92)' : 'rgba(248,250,252,0.92)';
                navbar.style.backdropFilter = 'blur(12px)';
                navbar.style.borderBottom = '1px solid var(--border-dim)';
            } else {
                navbar.style.background = 'transparent';
                navbar.style.backdropFilter = 'none';
                navbar.style.borderBottom = 'none';
            }
        });

        // ===== MOBILE MENU =====
        document.getElementById('burger').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        function closeMobile() { document.getElementById('mobile-menu').classList.add('hidden'); }

        // ===== SCROLL REVEAL =====
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
        }, { threshold: 0.1 });
        reveals.forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>
