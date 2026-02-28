@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan konten portfolio Anda')

@section('content')
<div class="row g-4">
    <!-- Stat Cards -->
    <div class="col-md-3">
        <div class="card stat-card p-4" style="border-color: #7c3aed;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1">Skills</p>
                    <h2 class="fw-bold mb-0">{{ $stats['skills'] }}</h2>
                </div>
                <div class="rounded-3 p-2" style="background:rgba(124,58,237,0.1)">
                    <i class="bi bi-stars fs-4 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4" style="border-color: #2563eb;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1">Experiences</p>
                    <h2 class="fw-bold mb-0">{{ $stats['experiences'] }}</h2>
                </div>
                <div class="rounded-3 p-2" style="background:rgba(37,99,235,0.1)">
                    <i class="bi bi-briefcase fs-4" style="color:#2563eb"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4" style="border-color: #059669;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1">Projects</p>
                    <h2 class="fw-bold mb-0">{{ $stats['projects'] }}</h2>
                </div>
                <div class="rounded-3 p-2" style="background:rgba(5,150,105,0.1)">
                    <i class="bi bi-folder2-open fs-4" style="color:#059669"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-4" style="border-color: #dc2626;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted small mb-1">Messages</p>
                    <h2 class="fw-bold mb-0">{{ $stats['messages'] }}</h2>
                    @if($stats['unread'] > 0)
                    <span class="badge bg-danger mt-1">{{ $stats['unread'] }} unread</span>
                    @endif
                </div>
                <div class="rounded-3 p-2" style="background:rgba(220,38,38,0.1)">
                    <i class="bi bi-envelope fs-4" style="color:#dc2626"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Links -->
<div class="row g-4 mt-1">
    <div class="col-12">
        <div class="card p-4">
            <h6 class="fw-semibold mb-3">⚡ Quick Actions</h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.skills.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-plus me-1"></i>Tambah Skill
                </a>
                <a href="{{ route('admin.experiences.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-plus me-1"></i>Tambah Experience
                </a>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-plus me-1"></i>Tambah Project
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-envelope me-1"></i>Lihat Pesan
                </a>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-primary">
                    <i class="bi bi-eye me-1"></i>Preview Portfolio
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
