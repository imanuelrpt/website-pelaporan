@extends('layouts.app')

@section('content')
<div class="report-list-container">
    <div class="report-header">
        <div class="header-content">
            <h1><i class="bi bi-list-check"></i> Daftar Laporan Saya</h1>
            <p class="subtitle">Kelola semua laporan yang telah Anda buat</p>
        </div>
        <a href="{{ route('laporan.create') }}" class="btn btn-create">
            <i class="bi bi-plus-circle"></i> Buat Laporan Baru
        </a>
    </div>

    <div class="report-list">
        @forelse($laporans as $laporan)
        <div class="report-card">
            <div class="report-card-header">
                <h3>{{ $laporan->judul }}</h3>
                <span class="status-badge status-{{ strtolower($laporan->status) }}">
                    {{ $laporan->status }}
                </span>
            </div>
            <div class="report-card-body">
                <div class="report-meta">
                    <span><i class="bi bi-calendar"></i> {{ $laporan->created_at->format('d M Y H:i') }}</span>
                    @if($laporan->updated_at != $laporan->created_at)
                    <span><i class="bi bi-arrow-repeat"></i> Diperbarui: {{ $laporan->updated_at->format('d M Y H:i') }}</span>
                    @endif
                </div>
                <div class="report-actions">
                    <a href="{{ route('laporan.show', $laporan) }}" class="btn btn-detail">
                        <i class="bi bi-eye"></i> Lihat Detail
                    </a>
                    @if(Auth::check() && Auth::id() === $laporan->user_id && $laporan->status === 'Diterima')
                        <a href="{{ route('laporan.edit', $laporan) }}" class="btn btn-warning btn-sm ms-2">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ms-2"><i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h3>Belum Ada Laporan</h3>
            <p>Anda belum membuat laporan apapun. Mulailah dengan membuat laporan baru.</p>
            <a href="{{ route('laporan.create') }}" class="btn btn-create">
                <i class="bi bi-plus-circle"></i> Buat Laporan Pertama
            </a>
        </div>
        @endforelse
    </div>

    @if($laporans->hasPages())
    <div class="pagination-wrapper">
        {{ $laporans->links() }}
    </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    .report-list-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-content h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header-content h1 i {
        color: #198754;
    }

    .subtitle {
        color: #7f8c8d;
        font-size: 1rem;
        margin: 0;
    }

    .btn-create {
        background-color: #198754;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-create:hover {
        background-color: #146c43;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .report-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .report-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        border-left: 4px solid #198754;
    }

    .report-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .report-card-header {
        padding: 15px 20px;
        border-bottom: 1px solid #f1f1f1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .report-card-header h3 {
        margin: 0;
        font-size: 1.2rem;
        color: #2c3e50;
        font-weight: 600;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-proses {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-diterima {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .status-ditolak {
        background-color: #f8d7da;
        color: #842029;
    }

    .status-selesai {
        background-color: #cfe2ff;
        color: #084298;
    }

    .report-card-body {
        padding: 15px 20px;
    }

    .report-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .report-meta span {
        font-size: 0.9rem;
        color: #7f8c8d;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .report-actions {
        display: flex;
        justify-content: flex-end;
    }

    .btn-detail {
        background-color: transparent;
        color: #198754;
        border: 1px solid #198754;
        padding: 6px 15px;
        border-radius: 6px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
    }

    .btn-detail:hover {
        background-color: #198754;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .empty-state i {
        font-size: 3rem;
        color: #bdc3c7;
        margin-bottom: 15px;
    }

    .empty-state h3 {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #7f8c8d;
        margin-bottom: 20px;
    }

    .pagination-wrapper {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    .pagination .page-item.active .page-link {
        background-color: #198754;
        border-color: #198754;
    }

    .pagination .page-link {
        color: #198754;
    }

    @media (max-width: 768px) {
        .report-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .report-card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .report-actions {
            justify-content: flex-start;
            margin-top: 10px;
        }
    }
</style>
@endsection