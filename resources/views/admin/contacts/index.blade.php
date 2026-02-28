@extends('admin.layout')

@section('title', 'Messages')
@section('page-title', 'Messages')
@section('page-subtitle', 'Pesan dari pengunjung portfolio')

@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Pengirim</th>
                    <th>Subject</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr class="{{ !$contact->is_read ? 'fw-semibold' : '' }}">
                    <td>
                        <div class="small fw-medium">{{ $contact->name }}</div>
                        <div class="text-muted" style="font-size:0.75rem">{{ $contact->email }}</div>
                    </td>
                    <td class="small">{{ $contact->subject }}</td>
                    <td class="text-muted small">{{ $contact->created_at->format('d M Y H:i') }}</td>
                    <td>
                        @if($contact->is_read)
                            <span class="badge bg-secondary">Read</span>
                        @else
                            <span class="badge bg-primary">New</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">Belum ada pesan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
