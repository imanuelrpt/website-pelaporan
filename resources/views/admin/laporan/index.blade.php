@extends('layouts.admin')

@section('title', 'Daftar Laporan')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="card-title mb-0"><i class="bi bi-file-earmark-text-fill"></i> Daftar Laporan Masuk</h1>
        <a href="{{ route('admin.laporan.export') }}" class="btn btn-success"><i class="bi bi-file-earmark-excel-fill"></i> Export ke Excel</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Pelapor</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporans as $laporan)
                        <tr>
                            <td>#{{ $laporan->id }}</td>
                            <td>{{ Str::limit($laporan->judul, 40) }}</td>
                            <td>{{ $laporan->user->name }}</td>
                            <td>
                                <span class="badge bg-{{ $laporan->status_color }}">{{ $laporan->status }}</span>
                            </td>
                            <td>{{ $laporan->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.laporan.show', $laporan) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <p class="mb-0">Tidak ada laporan yang tersedia.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($laporans->hasPages())
        <div class="mt-3">
            {{ $laporans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection