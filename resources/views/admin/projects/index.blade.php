@extends('admin.layout')

@section('title', 'Projects')
@section('page-title', 'Projects')
@section('page-subtitle', 'Kelola daftar project portfolio')

@section('content')
<!-- Add Form -->
<div class="card p-4 mb-4">
    <h6 class="fw-semibold mb-3"><i class="bi bi-plus-circle me-2 text-primary"></i>Tambah Project</h6>
    <form action="{{ route('admin.projects.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label small fw-medium">Nama Project</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-medium">Role</label>
                <input type="text" name="role" class="form-control" placeholder="Full Stack Developer">
            </div>
            <div class="col-12">
                <label class="form-label small fw-medium">Deskripsi</label>
                <textarea name="description" class="form-control" rows="2" required></textarea>
            </div>
            <div class="col-12">
                <label class="form-label small fw-medium">Impact</label>
                <textarea name="impact" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-12">
                <label class="form-label small fw-medium">Technologies (pisahkan dengan koma)</label>
                <input type="text" name="technologies" class="form-control" required placeholder="Laravel, PostgreSQL, REST API">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-medium">GitHub URL</label>
                <input type="url" name="github_url" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-medium">Demo URL</label>
                <input type="url" name="demo_url" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-medium">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featured">
                    <label class="form-check-label" for="featured">⭐ Featured Project</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Project</button>
    </form>
</div>

<!-- List -->
<div class="row g-4">
    @forelse($projects as $project)
    <div class="col-md-6">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="fw-bold mb-1">{{ $project->title }}</h6>
                    @if($project->role) <p class="text-primary small mb-0">{{ $project->role }}</p> @endif
                </div>
                <div class="d-flex gap-1 align-items-center">
                    @if($project->is_featured) <span class="badge bg-warning text-dark me-1">⭐</span> @endif
                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editProj{{ $project->id }}"><i class="bi bi-pencil"></i></button>
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Hapus?')" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
            <p class="text-muted small">{{ Str::limit($project->description, 100) }}</p>
            <div class="d-flex flex-wrap gap-1">
                @foreach($project->technologies as $tech)
                <span class="badge" style="background:rgba(124,58,237,0.1);color:#7c3aed;border:1px solid rgba(124,58,237,0.2)">{{ trim($tech) }}</span>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editProj{{ $project->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Edit Project</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
                <form action="{{ route('admin.projects.update', $project) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-body row g-3">
                        <div class="col-md-6"><label class="form-label small">Nama Project</label><input type="text" name="title" class="form-control" value="{{ $project->title }}" required></div>
                        <div class="col-md-6"><label class="form-label small">Role</label><input type="text" name="role" class="form-control" value="{{ $project->role }}"></div>
                        <div class="col-12"><label class="form-label small">Deskripsi</label><textarea name="description" class="form-control" rows="2" required>{{ $project->description }}</textarea></div>
                        <div class="col-12"><label class="form-label small">Impact</label><textarea name="impact" class="form-control" rows="2">{{ $project->impact }}</textarea></div>
                        <div class="col-12"><label class="form-label small">Technologies (koma)</label><input type="text" name="technologies" class="form-control" value="{{ implode(', ', $project->technologies) }}" required></div>
                        <div class="col-md-5"><label class="form-label small">GitHub URL</label><input type="url" name="github_url" class="form-control" value="{{ $project->github_url }}"></div>
                        <div class="col-md-5"><label class="form-label small">Demo URL</label><input type="url" name="demo_url" class="form-control" value="{{ $project->demo_url }}"></div>
                        <div class="col-md-2"><label class="form-label small">Sort</label><input type="number" name="sort_order" class="form-control" value="{{ $project->sort_order }}"></div>
                        <div class="col-12"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }}><label class="form-check-label small">Featured</label></div></div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12"><p class="text-muted text-center py-4">Belum ada project.</p></div>
    @endforelse
</div>
@endsection
