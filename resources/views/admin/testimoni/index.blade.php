@extends('layouts.admin')

@section('title', 'Daftar Testimoni')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="card-title mb-0"><i class="bi bi-star-fill"></i> Daftar Testimoni</h1>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Pengguna</th>
                        <th>Testimoni</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimonis as $testimoni)
                        <tr>
                            <td>#{{ $testimoni->id }}</td>
                            <td>{{ $testimoni->user->name }}</td>
                            <td>{{ Str::limit($testimoni->testimoni, 50) }}</td>
                            <td>{{ $testimoni->rating }} <i class="bi bi-star-fill text-warning"></i></td>
                            <td>
                                <span class="badge bg-{{ $testimoni->is_visible ? 'success' : 'secondary' }}">
                                    {{ $testimoni->is_visible ? 'Tampil' : 'Sembunyi' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.testimoni.update', $testimoni) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_visible" value="{{ $testimoni->is_visible ? 0 : 1 }}">
                                    <button type="submit" class="btn btn-sm btn-outline-{{ $testimoni->is_visible ? 'secondary' : 'success' }}">
                                        {{ $testimoni->is_visible ? 'Sembunyikan' : 'Tampilkan' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.testimoni.destroy', $testimoni) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <p class="mb-0">Tidak ada testimoni yang tersedia.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($testimonis->hasPages())
        <div class="mt-3">
            {{ $testimonis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
