// Translation dictionary
const i18n = {
    id: {
        nav_about: 'Tentang',
        nav_skills: 'Keahlian',
        nav_experience: 'Pengalaman',
        nav_projects: 'Proyek',
        nav_education: 'Pendidikan',
        nav_contact: 'Kontak',
        hello: '👋 Halo, saya',
        contact_me: 'Hubungi Saya',
        years_exp: '5 Tahun',
        full_stack_dev: 'Full Stack Dev',
        scroll: 'Gulir',
        about_tag: 'Tentang Saya',
        about_title: 'Ringkasan',
        about_title_hl: 'Profesional',
        years: 'Tahun Pengalaman',
        projects_lbl: 'Proyek',
        technologies: 'Teknologi',
        companies: 'Perusahaan',
        skills_tag: 'Yang Saya Kuasai',
        skills_title: 'Kompetensi',
        skills_title_hl: 'Teknis',
        exp_tag: 'Riwayat Kerja',
        exp_title: 'Pengalaman',
        exp_title_hl: 'Profesional',
        present: 'Sekarang',
        proj_tag: 'Karya Saya',
        proj_title: 'Proyek',
        proj_title_hl: 'Unggulan',
        impact: 'Dampak',
        no_projects: 'Belum ada proyek.',
        edu_tag: 'Latar Belakang Akademis',
        edu_title: 'Pendidikan',
        soft_skills: '💡 Soft Skills',
        contact_tag: 'Hubungi Saya',
        contact_title: 'Mari',
        contact_title_hl: 'Terhubung',
        contact_desc: 'Tertarik bekerja sama atau punya proyek menarik? Jangan ragu untuk menghubungi saya!',
        form_name: 'Nama',
        form_email: 'Email',
        form_subject: 'Subjek',
        form_message: 'Pesan',
        form_send: 'Kirim Pesan ✉️',
        form_sending: 'Mengirim...',
        form_success: '✅ Pesan Anda berhasil terkirim! Saya akan segera menghubungi Anda.',
        ph_name: 'John Doe',
        ph_email: 'email@contoh.com',
        ph_subject: 'Diskusi Proyek...',
        ph_message: 'Halo Yusril, saya ingin...',
        footer: 'Dibuat dengan ❤️ menggunakan Golang (Serverless) & PostgreSQL.'
    },
    en: {
        nav_about: 'About',
        nav_skills: 'Skills',
        nav_experience: 'Experience',
        nav_projects: 'Projects',
        nav_education: 'Education',
        nav_contact: 'Contact',
        hello: "👋 Hello, I'm",
        contact_me: 'Contact Me',
        years_exp: '5 Years',
        full_stack_dev: 'Full Stack Dev',
        scroll: 'Scroll',
        about_tag: 'About Me',
        about_title: 'Professional',
        about_title_hl: 'Summary',
        years: 'Years Experience',
        projects_lbl: 'Projects',
        technologies: 'Technologies',
        companies: 'Companies',
        skills_tag: 'What I Know',
        skills_title: 'Technical',
        skills_title_hl: 'Competencies',
        exp_tag: 'Work History',
        exp_title: 'Professional',
        exp_title_hl: 'Experience',
        present: 'Present',
        proj_tag: 'My Work',
        proj_title: 'Key',
        proj_title_hl: 'Projects',
        impact: 'Impact',
        no_projects: 'No projects yet.',
        edu_tag: 'Academic Background',
        edu_title: 'Education',
        soft_skills: '💡 Soft Skills',
        contact_tag: 'Get In Touch',
        contact_title: "Let's",
        contact_title_hl: 'Connect',
        contact_desc: 'Interested in working together or have an exciting project? Feel free to reach out!',
        form_name: 'Name',
        form_email: 'Email',
        form_subject: 'Subject',
        form_message: 'Message',
        form_send: 'Send Message ✉️',
        form_sending: 'Sending...',
        form_success: '✅ Your message has been sent successfully! I will get in touch with you shortly.',
        ph_name: 'John Doe',
        ph_email: 'email@example.com',
        ph_subject: 'Project Discussion...',
        ph_message: 'Hello Yusril, I would like to...',
        footer: 'Crafted with ❤️ using Golang (Serverless) & PostgreSQL.'
    }
};

let currentLang = localStorage.getItem('lang') || 'id';
let portfolioData = null;

// Initialize Theme
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

function switchLang(lang) {
    currentLang = lang;
    localStorage.setItem('lang', lang);
    applyTranslations();
    if (portfolioData) renderPortfolio(portfolioData);
}

function applyTranslations() {
    const t = i18n[currentLang] || i18n.id;
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (t[key]) el.textContent = t[key];
    });

    document.querySelectorAll('[data-i18n-ph]').forEach(el => {
        const key = el.getAttribute('data-i18n-ph');
        if (t[key]) el.setAttribute('placeholder', t[key]);
    });

    // Language buttons styling
    const btnId = document.getElementById('btn-lang-id');
    const btnEn = document.getElementById('btn-lang-en');
    if (btnId && btnEn) {
        if (currentLang === 'id') {
            btnId.className = 'px-3 py-1 text-xs font-bold transition-all duration-200 gradient-bg text-white';
            btnEn.className = 'px-3 py-1 text-xs font-bold transition-all duration-200';
            btnEn.style.color = 'var(--text-dim)';
        } else {
            btnEn.className = 'px-3 py-1 text-xs font-bold transition-all duration-200 gradient-bg text-white';
            btnId.className = 'px-3 py-1 text-xs font-bold transition-all duration-200';
            btnId.style.color = 'var(--text-dim)';
        }
    }
}

// Fetch and Render Portfolio Data from Go Backend
async function fetchPortfolio() {
    try {
        const res = await fetch('/api/portfolio');
        if (!res.ok) throw new Error('Failed to fetch portfolio data');
        portfolioData = await res.json();
        renderPortfolio(portfolioData);
    } catch (err) {
        console.error('Portfolio fetch error:', err);
    }
}

function renderPortfolio(data) {
    const t = i18n[currentLang] || i18n.id;
    const p = data.personal || {};

    // Hero Section
    if (p.name) document.getElementById('hero-name').textContent = p.name;
    if (p.tagline) document.getElementById('hero-tagline').textContent = p.tagline;
    if (p.location) document.getElementById('hero-location').textContent = `📍 ${p.location}`;
    if (p.bio) document.getElementById('about-bio').textContent = p.bio;

    if (p.github) {
        const el = document.getElementById('hero-github');
        if (el) { el.href = p.github; el.classList.remove('hidden'); }
    }
    if (p.linkedin) {
        const el = document.getElementById('hero-linkedin');
        if (el) { el.href = p.linkedin; el.classList.remove('hidden'); }
    }

    // Stats
    const stats = data.stats || {};
    document.getElementById('stat-years').textContent = `${stats.years_of_exp || 5}+`;
    document.getElementById('stat-projects').textContent = `${stats.project_count || 0}+`;
    document.getElementById('stat-skills').textContent = `${stats.skill_count || 0}+`;
    document.getElementById('stat-companies').textContent = `${stats.company_count || 0}`;

    // Skills Section
    const skillsContainer = document.getElementById('skills-container');
    if (skillsContainer && data.skills) {
        let html = '';
        for (const [category, list] of Object.entries(data.skills)) {
            html += `
            <div class="glass rounded-2xl p-6 reveal hover:border-purple-500/30 transition-all duration-300">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-2 h-2 rounded-full gradient-bg"></div>
                    <h3 class="font-semibold" style="color:var(--text)">${escapeHtml(category)}</h3>
                </div>
                <div class="flex flex-wrap gap-2">
                    ${list.map(s => `<span class="skill-badge">${escapeHtml(s.name)}</span>`).join('')}
                </div>
            </div>`;
        }
        skillsContainer.innerHTML = html;
    }

    // Experience Section
    const expContainer = document.getElementById('experience-container');
    if (expContainer && data.experiences) {
        expContainer.innerHTML = data.experiences.map(exp => {
            let descList = [];
            try {
                descList = typeof exp.descriptions === 'string' ? JSON.parse(exp.descriptions) : (exp.descriptions || []);
            } catch (e) {
                descList = [];
            }
            const dateStr = `${exp.start_date} — ${exp.is_current ? t.present : (exp.end_date || '')}`;
            return `
            <div class="glass rounded-2xl p-6 md:p-8 reveal hover:border-purple-500/30 transition-all duration-300 relative">
                <div class="absolute -left-10 top-8 w-4 h-4 rounded-full gradient-bg border-2 border-purple-900 shadow-lg shadow-purple-500/30"></div>
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3 mb-5">
                    <div>
                        <h3 class="text-xl font-bold" style="color:var(--text)">${escapeHtml(exp.position)}</h3>
                        <p class="font-semibold" style="color:#a78bfa">${escapeHtml(exp.company)}</p>
                    </div>
                    <span class="glass px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap self-start" style="color:var(--text-muted)">
                        ${dateStr}
                        ${exp.is_current ? '<span class="ml-2 w-1.5 h-1.5 bg-green-400 rounded-full inline-block animate-pulse"></span>' : ''}
                    </span>
                </div>
                <ul class="space-y-3">
                    ${descList.map(d => `
                    <li class="flex gap-3 text-sm leading-relaxed" style="color:var(--text-muted)">
                        <span class="mt-0.5 flex-shrink-0" style="color:#a78bfa">▸</span>
                        <span>${escapeHtml(d)}</span>
                    </li>`).join('')}
                </ul>
            </div>`;
        }).join('');
    }

    // Projects Section
    const projContainer = document.getElementById('projects-container');
    if (projContainer && data.projects) {
        if (data.projects.length === 0) {
            projContainer.innerHTML = `<p class="col-span-2" style="color:var(--text-dim)">${t.no_projects}</p>`;
        } else {
            projContainer.innerHTML = data.projects.map(proj => {
                let techList = [];
                try {
                    techList = typeof proj.technologies === 'string' ? JSON.parse(proj.technologies) : (proj.technologies || []);
                } catch (e) {
                    techList = [];
                }
                return `
                <div class="glass rounded-2xl p-6 md:p-8 reveal hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div>
                            <h3 class="text-xl font-bold" style="color:var(--text)">${escapeHtml(proj.title)}</h3>
                            ${proj.role ? `<p class="text-sm font-medium mt-1" style="color:#60a5fa">${escapeHtml(proj.role)}</p>` : ''}
                        </div>
                        ${proj.is_featured ? '<span class="tech-badge flex-shrink-0">⭐ Featured</span>' : ''}
                    </div>
                    <p class="text-sm leading-relaxed mb-4" style="color:var(--text-muted)">${escapeHtml(proj.description)}</p>
                    ${proj.impact ? `
                    <div class="glass-dark rounded-xl p-4 mb-4">
                        <p class="text-xs font-semibold uppercase tracking-wide mb-1" style="color:#a78bfa">${t.impact}</p>
                        <p class="text-sm leading-relaxed" style="color:var(--text)">${escapeHtml(proj.impact)}</p>
                    </div>` : ''}
                    <div class="flex flex-wrap gap-2 mb-5">
                        ${techList.map(tc => `<span class="tech-badge">${escapeHtml(tc.trim())}</span>`).join('')}
                    </div>
                    <div class="flex gap-4">
                        ${proj.github_url ? `
                        <a href="${proj.github_url}" target="_blank" class="text-xs transition-colors flex items-center gap-1.5 hover:text-purple-400" style="color:var(--text-muted)">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            GitHub
                        </a>` : ''}
                        ${proj.demo_url ? `
                        <a href="${proj.demo_url}" target="_blank" class="text-xs transition-colors flex items-center gap-1.5 hover:text-blue-400" style="color:var(--text-muted)">
                            🔗 Demo
                        </a>` : ''}
                    </div>
                </div>`;
            }).join('');
        }
    }

    // Education Section
    const eduContainer = document.getElementById('education-container');
    if (eduContainer && data.educations) {
        eduContainer.innerHTML = data.educations.map(edu => `
        <div class="glass rounded-2xl p-6 md:p-8 reveal flex gap-5">
            <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center text-xl flex-shrink-0">🎓</div>
            <div>
                <h3 class="font-bold text-lg" style="color:var(--text)">${escapeHtml(edu.degree)}</h3>
                <p class="font-medium" style="color:#a78bfa">${escapeHtml(edu.field)}</p>
                <p class="text-sm mt-1" style="color:var(--text-dim)">${escapeHtml(edu.institution)}</p>
                <span class="inline-block mt-3 text-xs glass px-3 py-1 rounded-full" style="color:var(--text-muted)">${escapeHtml(edu.start_year)} — ${escapeHtml(edu.end_year)}</span>
            </div>
        </div>`).join('');
    }

    // Contact details in left box
    if (p.email) {
        document.getElementById('contact-email-link').href = `mailto:${p.email}`;
        document.getElementById('contact-email-text').textContent = p.email;
    }
    if (p.phone) {
        document.getElementById('contact-phone-link').href = `tel:${p.phone}`;
        document.getElementById('contact-phone-text').textContent = p.phone;
    }
    if (p.linkedin) {
        document.getElementById('contact-linkedin-link').href = p.linkedin;
    }

    // Trigger Scroll Reveal on new DOM elements
    observeReveals();
}

// Contact Form AJAX Handler
async function handleContactSubmit(e) {
    e.preventDefault();
    const t = i18n[currentLang] || i18n.id;
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const alertBox = document.getElementById('contact-alert');

    const payload = {
        name: form.name.value.trim(),
        email: form.email.value.trim(),
        subject: form.subject.value.trim(),
        message: form.message.value.trim()
    };

    btn.disabled = true;
    btn.textContent = t.form_sending;

    try {
        const res = await fetch('/api/contact', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const result = await res.json();
        if (res.ok) {
            alertBox.className = 'mb-6 px-4 py-3 rounded-xl text-sm block';
            alertBox.style.background = 'rgba(52,211,153,0.1)';
            alertBox.style.border = '1px solid rgba(52,211,153,0.3)';
            alertBox.style.color = '#34d399';
            alertBox.textContent = t.form_success;
            form.reset();
        } else {
            throw new Error(result.error || 'Gagal mengirim pesan');
        }
    } catch (err) {
        alertBox.className = 'mb-6 px-4 py-3 rounded-xl text-sm block';
        alertBox.style.background = 'rgba(239,68,68,0.1)';
        alertBox.style.border = '1px solid rgba(239,68,68,0.3)';
        alertBox.style.color = '#f87171';
        alertBox.textContent = `❌ ${err.message}`;
    } finally {
        btn.disabled = false;
        btn.textContent = t.form_send;
    }
}

function observeReveals() {
    const reveals = document.querySelectorAll('.reveal:not(.visible)');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08 });
    reveals.forEach(el => observer.observe(el));
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// Navbar scroll behaviour
window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;
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

// Mobile burger
document.addEventListener('DOMContentLoaded', () => {
    const burger = document.getElementById('burger');
    if (burger) {
        burger.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    }
    applyTranslations();
    fetchPortfolio();
});

function closeMobile() {
    document.getElementById('mobile-menu').classList.add('hidden');
}
