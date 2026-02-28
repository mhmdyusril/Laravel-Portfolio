@extends('admin.layout')

@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')

@section('content')
<div class="card p-4" style="max-width: 700px;">
    <div class="d-flex justify-content-between mb-4">
        <div>
            <h5 class="fw-bold mb-1">{{ $contact->subject }}</h5>
            <p class="text-muted small mb-0">Dari: <strong>{{ $contact->name }}</strong> &lt;{{ $contact->email }}&gt;</p>
            <p class="text-muted small">{{ $contact->created_at->format('d M Y H:i') }}</p>
        </div>
        <span class="badge bg-success">Read</span>
    </div>
    <div class="bg-light rounded-3 p-4">
        <p class="mb-0" style="white-space:pre-wrap;line-height:1.8">{{ $contact->message }}</p>
    </div>
    <div class="d-flex gap-2 mt-4">
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary btn-sm">← Kembali</a>
        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn btn-primary btn-sm">
            <i class="bi bi-reply me-1"></i>Balas via Email
        </a>
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="ms-auto" onsubmit="return confirm('Hapus pesan?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash me-1"></i>Hapus</button>
        </form>
    </div>
</div>
@endsection
