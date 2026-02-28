@extends('admin.layout')

@section('title', 'Skills')
@section('page-title', 'Skills')
@section('page-subtitle', 'Kelola keahlian teknis yang tampil di portfolio')

@section('content')
<div class="row g-4">
    <!-- Add Skill Card -->
    <div class="col-lg-4">
        <div class="card p-4">
            <h6 class="fw-semibold mb-3"><i class="bi bi-plus-circle me-2 text-primary"></i>Tambah Skill</h6>
            <form action="{{ route('admin.skills.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-medium">Nama Skill</label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Laravel">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-medium">Kategori</label>
                    <select name="category" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        @foreach(['Full Stack', 'API & Integration', 'Database', 'Security', 'Infrastructure'] as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-medium">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0">
                </div>
                <button type="submit" class="btn btn-primary w-100">Tambah Skill</button>
            </form>
        </div>
    </div>

    <!-- Skills List -->
    <div class="col-lg-8">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Skill</th>
                            <th>Kategori</th>
                            <th>Order</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skills as $skill)
                        <tr>
                            <td class="fw-medium">{{ $skill->name }}</td>
                            <td><span class="badge badge-category rounded-pill">{{ $skill->category }}</span></td>
                            <td class="text-muted small">{{ $skill->sort_order }}</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editSkill{{ $skill->id }}"><i class="bi bi-pencil"></i></button>
                                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus skill ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editSkill{{ $skill->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header"><h5 class="modal-title">Edit Skill</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
                                    <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label small">Nama Skill</label>
                                                <input type="text" name="name" class="form-control" value="{{ $skill->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small">Kategori</label>
                                                <select name="category" class="form-select">
                                                    @foreach(['Full Stack', 'API & Integration', 'Database', 'Security', 'Infrastructure'] as $cat)
                                                    <option value="{{ $cat }}" {{ $skill->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label small">Sort Order</label>
                                                <input type="number" name="sort_order" class="form-control" value="{{ $skill->sort_order }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada skill. Tambahkan di form kiri.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
