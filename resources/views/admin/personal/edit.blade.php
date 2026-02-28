@extends('admin.layout')

@section('title', 'Personal Info')
@section('page-title', 'Personal Info')
@section('page-subtitle', 'Edit informasi pribadi yang tampil di portfolio')

@section('content')
<div class="card p-4">
    <form action="{{ route('admin.personal.update') }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $personal->name ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Tagline</label>
                <input type="text" name="tagline" class="form-control" required value="{{ old('tagline', $personal->tagline ?? '') }}">
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Bio / Professional Summary</label>
                <textarea name="bio" class="form-control" rows="4" required>{{ old('bio', $personal->bio ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email', $personal->email ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Phone</label>
                <input type="text" name="phone" class="form-control" required value="{{ old('phone', $personal->phone ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Location</label>
                <input type="text" name="location" class="form-control" required value="{{ old('location', $personal->location ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">GitHub URL</label>
                <input type="url" name="github" class="form-control" value="{{ old('github', $personal->github ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">LinkedIn URL</label>
                <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $personal->linkedin ?? '') }}">
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-5">
                <i class="bi bi-save me-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
