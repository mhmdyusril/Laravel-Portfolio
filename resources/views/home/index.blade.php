@extends('layouts.app')

@section('title', ($personal->name ?? 'Portfolio') . ' — Full Stack Developer')

@section('content')

{{-- ================= HERO ================= --}}
<section id="hero" class="min-h-screen hero-bg flex items-center pt-20">
    <div class="max-w-6xl mx-auto px-6 py-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-sm font-semibold tracking-widest uppercase mb-4 reveal" style="color:#a78bfa">{{ __('portfolio.hello') }}</p>
                <h1 class="text-5xl md:text-6xl font-black mb-3 reveal" style="transition-delay:0.1s">
                    <span class="gradient-text">{{ $personal->name ?? 'Muhamad Yusril' }}</span>
                </h1>
                <p class="text-2xl font-semibold mb-6 reveal" style="transition-delay:0.2s; color:var(--text-muted)">
                    {{ $personal->tagline ?? 'Software Developer (Full Stack)' }}
                </p>
                <p class="text-lg leading-relaxed mb-8 reveal" style="transition-delay:0.3s; color:var(--text-muted)">
                    📍 {{ $personal->location ?? 'Jakarta, Indonesia' }}
                </p>
                <div class="flex flex-wrap gap-4 reveal" style="transition-delay:0.4s">
                    <a href="#contact" class="gradient-bg text-white font-semibold px-8 py-3 rounded-full hover:shadow-lg hover:shadow-purple-500/25 transition-all duration-300 hover:-translate-y-1">
                        {{ __('portfolio.contact_me') }}
                    </a>
                    <a href="{{ $personal->github ?? '#' }}" target="_blank" class="glass font-semibold px-8 py-3 rounded-full hover:bg-white/10 transition-all duration-300 hover:-translate-y-1" style="color:var(--text-muted)">
                        GitHub →
                    </a>
                </div>
                <div class="flex gap-4 mt-8 reveal" style="transition-delay:0.5s">
                    @if($personal && $personal->github)
                    <a href="{{ $personal->github }}" target="_blank" class="transition-colors text-sm" style="color:var(--text-dim)">
                        github.com/mhbmdyusril
                    </a>
                    @endif
                    @if($personal && $personal->linkedin)
                    <span style="color:var(--border)">·</span>
                    <a href="{{ $personal->linkedin }}" target="_blank" class="transition-colors text-sm" style="color:var(--text-dim)">
                        LinkedIn
                    </a>
                    @endif
                </div>
            </div>

            <div class="hidden md:flex justify-center items-center reveal" style="transition-delay:0.3s">
                <div class="relative">
                    <div class="w-64 h-64 rounded-full gradient-bg opacity-10 absolute inset-0 blur-3xl animate-pulse"></div>
                    <div class="w-56 h-56 glass rounded-3xl flex flex-col items-center justify-center float-anim relative z-10">
                        <div class="text-6xl mb-3">💻</div>
                        <p class="text-sm font-medium" style="color:var(--text-muted)">{{ __('portfolio.years_exp') }}</p>
                        <p class="gradient-text font-bold">{{ __('portfolio.full_stack_dev') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-16 reveal" style="transition-delay:0.6s">
            <a href="#about" class="flex flex-col items-center gap-2 transition-colors" style="color:var(--text-dim)">
                <span class="text-xs tracking-widest uppercase">{{ __('portfolio.scroll') }}</span>
                <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ================= ABOUT ================= --}}
<section id="about" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="reveal">
            <p class="text-sm font-semibold tracking-widest uppercase mb-2" style="color:#a78bfa">{{ __('portfolio.about_tag') }}</p>
            <h2 class="text-4xl font-bold mb-12">{{ __('portfolio.about_title') }} <span class="gradient-text">{{ __('portfolio.about_title_hl') }}</span></h2>
        </div>
        <div class="glass rounded-3xl p-8 md:p-12 reveal">
            <p class="text-lg leading-loose" style="color:var(--text-muted)">{{ $personal->bio ?? '' }}</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-10 pt-10" style="border-top:1px solid var(--border-dim)">
                <div class="text-center">
                    <p class="text-3xl font-black gradient-text">3+</p>
                    <p class="text-sm mt-1" style="color:var(--text-dim)">{{ __('portfolio.years') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black gradient-text">{{ $projects->count() }}+</p>
                    <p class="text-sm mt-1" style="color:var(--text-dim)">{{ __('portfolio.projects_lbl') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black gradient-text">{{ $skills->flatten()->count() }}+</p>
                    <p class="text-sm mt-1" style="color:var(--text-dim)">{{ __('portfolio.technologies') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-black gradient-text">{{ $experiences->count() }}</p>
                    <p class="text-sm mt-1" style="color:var(--text-dim)">{{ __('portfolio.companies') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= SKILLS ================= --}}
<section id="skills" class="py-24" style="background: radial-gradient(ellipse at 50% 0%, rgba(124,58,237,0.08) 0%, transparent 60%);">
    <div class="max-w-6xl mx-auto px-6">
        <div class="reveal">
            <p class="text-sm font-semibold tracking-widest uppercase mb-2" style="color:#a78bfa">{{ __('portfolio.skills_tag') }}</p>
            <h2 class="text-4xl font-bold mb-12">{{ __('portfolio.skills_title') }} <span class="gradient-text">{{ __('portfolio.skills_title_hl') }}</span></h2>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($skills as $category => $categorySkills)
            <div class="glass rounded-2xl p-6 reveal hover:border-purple-500/30 transition-all duration-300">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-2 h-2 rounded-full gradient-bg"></div>
                    <h3 class="font-semibold" style="color:var(--text)">{{ $category }}</h3>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($categorySkills as $skill)
                    <span class="skill-badge">{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= EXPERIENCE ================= --}}
<section id="experience" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="reveal">
            <p class="text-sm font-semibold tracking-widest uppercase mb-2" style="color:#a78bfa">{{ __('portfolio.exp_tag') }}</p>
            <h2 class="text-4xl font-bold mb-12">{{ __('portfolio.exp_title') }} <span class="gradient-text">{{ __('portfolio.exp_title_hl') }}</span></h2>
        </div>
        <div class="relative timeline-line pl-8 flex flex-col gap-8">
            @foreach($experiences as $exp)
            <div class="glass rounded-2xl p-6 md:p-8 reveal hover:border-purple-500/30 transition-all duration-300 relative">
                <div class="absolute -left-10 top-8 w-4 h-4 rounded-full gradient-bg border-2 border-purple-900 shadow-lg shadow-purple-500/30"></div>
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3 mb-5">
                    <div>
                        <h3 class="text-xl font-bold" style="color:var(--text)">{{ $exp->position }}</h3>
                        <p class="font-semibold" style="color:#a78bfa">{{ $exp->company }}</p>
                    </div>
                    <span class="glass px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap self-start" style="color:var(--text-muted)">
                        {{ $exp->start_date }} — {{ $exp->is_current ? __('portfolio.present') : $exp->end_date }}
                        @if($exp->is_current) <span class="ml-2 w-1.5 h-1.5 bg-green-400 rounded-full inline-block animate-pulse"></span> @endif
                    </span>
                </div>
                <ul class="space-y-3">
                    @foreach($exp->descriptions as $desc)
                    <li class="flex gap-3 text-sm leading-relaxed" style="color:var(--text-muted)">
                        <span class="mt-0.5 flex-shrink-0" style="color:#a78bfa">▸</span>
                        <span>{{ $desc }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PROJECTS ================= --}}
<section id="projects" class="py-24" style="background: radial-gradient(ellipse at 80% 50%, rgba(37,99,235,0.08) 0%, transparent 60%);">
    <div class="max-w-6xl mx-auto px-6">
        <div class="reveal">
            <p class="text-sm font-semibold tracking-widest uppercase mb-2" style="color:#a78bfa">{{ __('portfolio.proj_tag') }}</p>
            <h2 class="text-4xl font-bold mb-12">{{ __('portfolio.proj_title') }} <span class="gradient-text">{{ __('portfolio.proj_title_hl') }}</span></h2>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            @forelse($projects as $project)
            <div class="glass rounded-2xl p-6 md:p-8 reveal hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-start justify-between gap-4 mb-4">
                    <div>
                        <h3 class="text-xl font-bold" style="color:var(--text)">{{ $project->title }}</h3>
                        @if($project->role)
                        <p class="text-sm font-medium mt-1" style="color:#60a5fa">{{ $project->role }}</p>
                        @endif
                    </div>
                    @if($project->is_featured)
                    <span class="tech-badge flex-shrink-0">⭐ Featured</span>
                    @endif
                </div>
                <p class="text-sm leading-relaxed mb-4" style="color:var(--text-muted)">{{ $project->description }}</p>
                @if($project->impact)
                <div class="glass-dark rounded-xl p-4 mb-4">
                    <p class="text-xs font-semibold uppercase tracking-wide mb-1" style="color:#a78bfa">{{ __('portfolio.impact') }}</p>
                    <p class="text-sm leading-relaxed" style="color:var(--text)">{{ $project->impact }}</p>
                </div>
                @endif
                <div class="flex flex-wrap gap-2 mb-5">
                    @foreach($project->technologies as $tech)
                    <span class="tech-badge">{{ trim($tech) }}</span>
                    @endforeach
                </div>
                <div class="flex gap-3">
                    @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="text-xs transition-colors flex items-center gap-1" style="color:var(--text-muted)">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        GitHub
                    </a>
                    @endif
                    @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" class="text-xs transition-colors flex items-center gap-1" style="color:var(--text-muted)">
                        🔗 Demo
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <p class="col-span-2" style="color:var(--text-dim)">{{ __('portfolio.no_projects') }}</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ================= EDUCATION ================= --}}
<section id="education" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="reveal">
            <p class="text-sm font-semibold tracking-widest uppercase mb-2" style="color:#a78bfa">{{ __('portfolio.edu_tag') }}</p>
            <h2 class="text-4xl font-bold mb-12"><span class="gradient-text">{{ __('portfolio.edu_title') }}</span></h2>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            @foreach($educations as $edu)
            <div class="glass rounded-2xl p-6 md:p-8 reveal flex gap-5">
                <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center text-xl flex-shrink-0">🎓</div>
                <div>
                    <h3 class="font-bold text-lg" style="color:var(--text)">{{ $edu->degree }}</h3>
                    <p class="font-medium" style="color:#a78bfa">{{ $edu->field }}</p>
                    <p class="text-sm mt-1" style="color:var(--text-dim)">{{ $edu->institution }}</p>
                    <span class="inline-block mt-3 text-xs glass px-3 py-1 rounded-full" style="color:var(--text-muted)">{{ $edu->start_year }} — {{ $edu->end_year }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Soft Skills -->
        <div class="mt-10 glass rounded-2xl p-8 reveal">
            <h3 class="font-bold text-lg mb-5" style="color:var(--text)">{{ __('portfolio.soft_skills') }}</h3>
            <div class="flex flex-wrap gap-3">
                @foreach(['Analytical Problem Solving & Technical Troubleshooting', 'Collaborative Teamwork in Institutional Environments', 'Professional Communication & Time Management'] as $soft)
                <span class="skill-badge">{{ $soft }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ================= CONTACT ================= --}}
<section id="contact" class="py-24" style="background: radial-gradient(ellipse at 20% 100%, rgba(124,58,237,0.1) 0%, transparent 50%);">
    <div class="max-w-6xl mx-auto px-6">
        <div class="reveal">
            <p class="text-sm font-semibold tracking-widest uppercase mb-2" style="color:#a78bfa">{{ __('portfolio.contact_tag') }}</p>
            <h2 class="text-4xl font-bold mb-12">{{ __('portfolio.contact_title') }} <span class="gradient-text">{{ __('portfolio.contact_title_hl') }}</span></h2>
        </div>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Contact Info -->
            <div class="reveal">
                <p class="text-lg leading-relaxed mb-8" style="color:var(--text-muted)">{{ __('portfolio.contact_desc') }}</p>
                <div class="space-y-5">
                    <a href="mailto:{{ $personal->email ?? '' }}" class="flex items-center gap-4 glass rounded-xl p-4 hover:border-purple-500/30 transition-all duration-300 group">
                        <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">✉️</div>
                        <div>
                            <p class="text-xs uppercase tracking-wide" style="color:var(--text-dim)">Email</p>
                            <p class="font-medium" style="color:var(--text)">{{ $personal->email ?? 'muh.yusril098@gmail.com' }}</p>
                        </div>
                    </a>
                    <a href="tel:{{ $personal->phone ?? '' }}" class="flex items-center gap-4 glass rounded-xl p-4 hover:border-purple-500/30 transition-all duration-300 group">
                        <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">📱</div>
                        <div>
                            <p class="text-xs uppercase tracking-wide" style="color:var(--text-dim)">Phone</p>
                            <p class="font-medium" style="color:var(--text)">{{ $personal->phone ?? '+62 812 8499 3957' }}</p>
                        </div>
                    </a>
                    @if($personal && $personal->linkedin)
                    <a href="{{ $personal->linkedin }}" target="_blank" class="flex items-center gap-4 glass rounded-xl p-4 hover:border-blue-500/30 transition-all duration-300 group">
                        <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">💼</div>
                        <div>
                            <p class="text-xs uppercase tracking-wide" style="color:var(--text-dim)">LinkedIn</p>
                            <p class="font-medium" style="color:var(--text)">linkedin.com/in/muhamad-yusril/</p>
                        </div>
                    </a>
                    @endif
                </div>
            </div>

            <div class="glass rounded-2xl p-8 reveal">
                @if(session('success'))
                <div class="mb-6 px-4 py-3 rounded-xl text-sm" style="background:rgba(52,211,153,0.1);border:1px solid rgba(52,211,153,0.3);color:#34d399;">
                    ✅ {{ session('success') }}
                </div>
                @endif
                <form id="contact-form" action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs uppercase tracking-wide block mb-2" style="color:var(--text-dim)">{{ __('portfolio.form_name') }}</label>
                            <input type="text" name="name" id="name" required placeholder="{{ __('portfolio.ph_name') }}"
                                   class="w-full glass bg-transparent rounded-xl px-4 py-3 text-sm outline-none placeholder-opacity-30 transition-all"
                                   style="color:var(--text)" value="{{ old('name') }}">
                            @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="text-xs uppercase tracking-wide block mb-2" style="color:var(--text-dim)">{{ __('portfolio.form_email') }}</label>
                            <input type="email" name="email" id="email" required placeholder="{{ __('portfolio.ph_email') }}"
                                   class="w-full glass bg-transparent rounded-xl px-4 py-3 text-sm outline-none transition-all"
                                   style="color:var(--text)" value="{{ old('email') }}">
                            @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-wide block mb-2" style="color:var(--text-dim)">{{ __('portfolio.form_subject') }}</label>
                        <input type="text" name="subject" id="subject" required placeholder="{{ __('portfolio.ph_subject') }}"
                               class="w-full glass bg-transparent rounded-xl px-4 py-3 text-sm outline-none transition-all"
                               style="color:var(--text)" value="{{ old('subject') }}">
                        @error('subject')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-wide block mb-2" style="color:var(--text-dim)">{{ __('portfolio.form_message') }}</label>
                        <textarea name="message" id="message" rows="5" required placeholder="{{ __('portfolio.ph_message') }}"
                                  class="w-full glass bg-transparent rounded-xl px-4 py-3 text-sm outline-none transition-all resize-none"
                                  style="color:var(--text)">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="w-full gradient-bg text-white font-semibold py-3.5 rounded-xl hover:shadow-lg hover:shadow-purple-500/25 transition-all duration-300 hover:-translate-y-0.5 active:scale-95">
                        {{ __('portfolio.form_send') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
