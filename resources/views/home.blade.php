@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <section class="hero-section mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
                <h1 class="display-4 fw-bold text-success mb-4">SIPALA</h1>
                <p class="lead text-muted mb-4">
                    Sistem Pelaporan Lingkungan dan Publik Berbasis Web. Warga dapat melaporkan masalah lingkungan, 
                    memantau penanganan, dan berpartisipasi aktif untuk lingkungan yang lebih baik.
                </p>
                <a href="{{ route('laporan.create') }}" class="btn btn-success btn-lg px-4 py-2">
                    <i class="bi bi-plus-circle me-2"></i>Buat Laporan Sekarang
                </a>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" 
                     class="img-fluid rounded-3 shadow-lg" 
                     alt="Lingkungan SIPALA">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section mb-5">
        <h2 class="text-center fw-bold mb-5">Fitur Unggulan SIPALA</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                    <div class="card-body p-4 text-center">
                        <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle p-3 mb-3 mx-auto">
                            <i class="bi bi-geo-alt-fill text-success" style="font-size:1.75rem;"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Laporan Berbasis Lokasi</h5>
                        <p class="text-muted mb-0">Tandai lokasi kejadian langsung di peta interaktif.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                    <div class="card-body p-4 text-center">
                        <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle p-3 mb-3 mx-auto">
                            <i class="bi bi-image-fill text-success" style="font-size:1.75rem;"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Upload Foto</h5>
                        <p class="text-muted mb-0">Lampirkan foto masalah untuk laporan yang lebih jelas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                    <div class="card-body p-4 text-center">
                        <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle p-3 mb-3 mx-auto">
                            <i class="bi bi-bar-chart-fill text-success" style="font-size:1.75rem;"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Statistik & Transparansi</h5>
                        <p class="text-muted mb-0">Pantau statistik dan progres penanganan laporan secara publik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Testimoni Pengguna</h2>
            <div class="row g-4">
                @forelse ($testimonis as $testimoni)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://i.pravatar.cc/50?u={{ $testimoni->user->id }}" class="rounded-circle me-3" alt="Avatar">
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $testimoni->user->name }}</h6>
                                        <div class="text-warning">
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="bi bi-star{{ $i < $testimoni->rating ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mb-0">"{{ $testimoni->testimoni }}"</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada testimoni yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    .icon-wrapper {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .contact-item {
        display: flex;
        align-items: center;
    }
</style>
@endsection