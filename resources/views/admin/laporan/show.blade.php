@extends('layouts.admin')

@section('title', 'Detail Laporan')

@section('content')
<div class="row">
    <!-- Left Column: Report Details -->
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detail Laporan #{{ $laporan->id }}</h4>
                <span class="badge bg-{{ $laporan->status_color }}">{{ $laporan->status }}</span>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $laporan->judul }}</h5>
                <p class="card-text text-muted">Dilaporkan oleh {{ $laporan->user->name }} pada {{ $laporan->created_at->format('d M Y, H:i') }}</p>
                <hr>
                <p>{{ $laporan->deskripsi }}</p>
                @if($laporan->foto)
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan" class="img-fluid rounded" style="max-height: 400px;">
                    </div>
                @endif
            </div>
        </div>

        <!-- Tanggapan Section -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tanggapan</h5>
            </div>
            <div class="card-body">
                @forelse($laporan->tanggapans as $tanggapan)
                    <div class="alert alert-info"><strong>{{ $tanggapan->admin->name }}:</strong> {{ $tanggapan->isi_tanggapan }}</div>
                @empty
                    <p>Belum ada tanggapan untuk laporan ini.</p>
                @endforelse
                <hr>
                <form action="{{ route('admin.laporan.tanggapan', $laporan) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea name="isi_tanggapan" class="form-control" rows="3" placeholder="Tulis tanggapan Anda..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Kirim Tanggapan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Actions -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ubah Status Laporan</h5>
            </div>
            <div class="card-body">
                <p>Pilih status baru untuk laporan ini:</p>
                <form action="{{ route('admin.laporan.updateStatus', $laporan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="d-grid gap-2">
                        <button type="submit" name="status" value="Diterima" class="btn btn-outline-success">Setujui Laporan</button>
                        <button type="submit" name="status" value="Sedang Diproses" class="btn btn-outline-info">Proses Laporan</button>
                        <button type="submit" name="status" value="Selesai" class="btn btn-outline-primary">Selesaikan Laporan</button>
                        <button type="submit" name="status" value="Ditolak" class="btn btn-outline-danger">Tolak Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection