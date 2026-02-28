@extends('admin.layout')

@section('title', 'Education')
@section('page-title', 'Education')
@section('page-subtitle', 'Kelola riwayat pendidikan')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card p-4">
            <h6 class="fw-semibold mb-3"><i class="bi bi-plus-circle me-2 text-primary"></i>Tambah Pendidikan</h6>
            <form action="{{ route('admin.educations.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-medium">Institusi</label>
                    <input type="text" name="institution" class="form-control" required placeholder="Nama Universitas/Sekolah">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-medium">Gelar</label>
                    <input type="text" name="degree" class="form-control" required placeholder="Bachelor of...">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-medium">Bidang Studi</label>
                    <input type="text" name="field" class="form-control" required placeholder="Information Systems">
                </div>
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label small fw-medium">Tahun Mulai</label>
                        <input type="text" name="start_year" class="form-control" placeholder="2017">
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-medium">Tahun Selesai</label>
                        <input type="text" name="end_year" class="form-control" placeholder="2021">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Tambah</button>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        @foreach($educations as $edu)
        <div class="card p-4 mb-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="fw-bold">{{ $edu->degree }}</h6>
                    <p class="text-primary small mb-1">{{ $edu->field }}</p>
                    <p class="text-muted small">{{ $edu->institution }}</p>
                    <span class="badge bg-light text-secondary border">{{ $edu->start_year }} — {{ $edu->end_year }}</span>
                </div>
                <div class="d-flex gap-2 align-items-start">
                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editEdu{{ $edu->id }}"><i class="bi bi-pencil"></i></button>
                    <form action="{{ route('admin.educations.destroy', $edu) }}" method="POST" onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal -->
        <div class="modal fade" id="editEdu{{ $edu->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><h5 class="modal-title">Edit Pendidikan</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
                    <form action="{{ route('admin.educations.update', $edu) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3"><label class="form-label small">Institusi</label><input type="text" name="institution" class="form-control" value="{{ $edu->institution }}" required></div>
                            <div class="mb-3"><label class="form-label small">Gelar</label><input type="text" name="degree" class="form-control" value="{{ $edu->degree }}" required></div>
                            <div class="mb-3"><label class="form-label small">Bidang Studi</label><input type="text" name="field" class="form-control" value="{{ $edu->field }}" required></div>
                            <div class="row g-2">
                                <div class="col-6"><label class="form-label small">Tahun Mulai</label><input type="text" name="start_year" class="form-control" value="{{ $edu->start_year }}"></div>
                                <div class="col-6"><label class="form-label small">Tahun Selesai</label><input type="text" name="end_year" class="form-control" value="{{ $edu->end_year }}"></div>
                            </div>
                        </div>
                        <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
