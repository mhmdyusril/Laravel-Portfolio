@extends('admin.layout')

@section('title', 'Profile')
@section('page-title', 'Profile')
@section('page-subtitle', 'Kelola akun admin dan password')

@section('content')
<div class="row g-4">
    <!-- Update Profile Info -->
    <div class="col-lg-6">
        <div class="card p-4">
            <h6 class="fw-semibold mb-1">Informasi Akun</h6>
            <p class="text-muted small mb-4">Perbarui nama dan email akun admin.</p>

            @if (session('status') === 'profile-updated')
            <div class="alert alert-success alert-dismissible fade show small py-2" role="alert">
                ✅ Profil berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf @method('PATCH')
                <div class="mb-3">
                    <label class="form-label small fw-medium">Nama</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-medium">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary btn-sm px-4">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- Update Password -->
    <div class="col-lg-6">
        <div class="card p-4">
            <h6 class="fw-semibold mb-1">Ubah Password</h6>
            <p class="text-muted small mb-4">Gunakan password yang kuat dan panjang.</p>

            @if (session('status') === 'password-updated')
            <div class="alert alert-success alert-dismissible fade show small py-2" role="alert">
                ✅ Password berhasil diperbarui.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label small fw-medium">Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-control @error('current_password','updatePassword') is-invalid @enderror">
                    @error('current_password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-medium">Password Baru</label>
                    <input type="password" name="password" class="form-control @error('password','updatePassword') is-invalid @enderror">
                    @error('password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-medium">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary btn-sm px-4">Update Password</button>
            </form>
        </div>
    </div>

    <!-- Delete Account -->
    <div class="col-12">
        <div class="card p-4 border-danger border-opacity-25">
            <h6 class="fw-semibold text-danger mb-1">Danger Zone</h6>
            <p class="text-muted small mb-3">Setelah akun dihapus, semua data tidak bisa dipulihkan.</p>
            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="bi bi-trash me-1"></i>Hapus Akun
            </button>
        </div>
    </div>
</div>

<!-- Delete Confirm Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-danger">Hapus Akun</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small">Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak bisa dibatalkan.</p>
                <form id="deleteForm" action="{{ route('admin.profile.destroy') }}" method="POST">
                    @csrf @method('DELETE')
                    <div class="mb-3">
                        <label class="form-label small fw-medium">Konfirmasi Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                        @error('password', 'userDeletion')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger btn-sm" onclick="document.getElementById('deleteForm').submit()">Ya, Hapus Akun</button>
            </div>
        </div>
    </div>
</div>
@endsection
