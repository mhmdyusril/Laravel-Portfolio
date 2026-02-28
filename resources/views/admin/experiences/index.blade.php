@extends('admin.layout')

@section('title', 'Experiences')
@section('page-title', 'Professional Experience')
@section('page-subtitle', 'Kelola riwayat pengalaman kerja')

@section('content')
<!-- Add Form -->
<div class="card p-4 mb-4">
    <h6 class="fw-semibold mb-3"><i class="bi bi-plus-circle me-2 text-primary"></i>Tambah Experience</h6>
    <form action="{{ route('admin.experiences.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label small fw-medium">Perusahaan</label>
                <input type="text" name="company" class="form-control" required placeholder="PT Example">
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-medium">Posisi</label>
                <input type="text" name="position" class="form-control" required placeholder="Software Developer">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-medium">Mulai</label>
                <input type="text" name="start_date" class="form-control" placeholder="January 2023">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-medium">Selesai</label>
                <input type="text" name="end_date" class="form-control" placeholder="Kosongkan jika masih aktif">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-medium">Masih Aktif?</label>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="is_current" value="1" id="is_current">
                    <label class="form-check-label" for="is_current">Ya, masih aktif</label>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-medium">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0">
            </div>
            <div class="col-12">
                <label class="form-label small fw-medium">Deskripsi (satu baris = satu poin)</label>
                <textarea name="descriptions" class="form-control" rows="4" placeholder="Tulis setiap poin di baris baru..."></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Experience</button>
    </form>
</div>

<!-- List -->
@foreach($experiences as $exp)
<div class="card p-4 mb-3">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h6 class="fw-bold mb-1">{{ $exp->position }}</h6>
            <p class="text-primary mb-1 small">{{ $exp->company }}</p>
            <span class="badge bg-light text-secondary border">{{ $exp->start_date }} — {{ $exp->is_current ? 'Present' : $exp->end_date }}</span>
            @if($exp->is_current) <span class="badge bg-success ms-1">Aktif</span> @endif
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editExp{{ $exp->id }}">
                <i class="bi bi-pencil"></i>
            </button>
            <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Hapus?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
        </div>
    </div>
    <ul class="mt-3 mb-0 small text-muted">
        @foreach($exp->descriptions as $d)
        <li>{{ $d }}</li>
        @endforeach
    </ul>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editExp{{ $exp->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Edit Experience</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
            <form action="{{ route('admin.experiences.update', $exp) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label small">Perusahaan</label>
                        <input type="text" name="company" class="form-control" value="{{ $exp->company }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small">Posisi</label>
                        <input type="text" name="position" class="form-control" value="{{ $exp->position }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small">Mulai</label>
                        <input type="text" name="start_date" class="form-control" value="{{ $exp->start_date }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small">Selesai</label>
                        <input type="text" name="end_date" class="form-control" value="{{ $exp->end_date }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ $exp->sort_order }}">
                    </div>
                    <div class="col-md-6">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="is_current" value="1" {{ $exp->is_current ? 'checked' : '' }}>
                            <label class="form-check-label small">Masih Aktif</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label small">Deskripsi (satu baris = satu poin)</label>
                        <textarea name="descriptions" class="form-control" rows="5">{{ implode("\n", $exp->descriptions) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
