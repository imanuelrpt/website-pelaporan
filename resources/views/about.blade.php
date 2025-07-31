@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="about-card bg-white rounded-4 p-4 p-md-5 shadow-lg">
                <div class="row align-items-center">
                    <div class="col-md-7 mb-4 mb-md-0">
                        <img src="https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             class="img-fluid rounded-3 shadow-lg" 
                             alt="Tentang SIPALA">
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-info-circle-fill text-success" style="font-size:1.5rem;"></i>
                            </div>
                            <h2 class="fw-bold mb-0 text-success">Tentang SIPALA</h2>
                        </div>
                        
                        <p class="lead text-muted mb-4">
                            SIPALA adalah sistem pelaporan lingkungan dan publik berbasis web yang bertujuan meningkatkan partisipasi warga dan transparansi penanganan masalah oleh instansi terkait.
                        </p>
                        
                        <div class="features-list mb-4">
                            <div class="d-flex mb-3">
                                <div class="me-3 text-success">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <span>Memudahkan warga melaporkan masalah lingkungan dan publik</span>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="me-3 text-success">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <span>Memantau status dan progres penanganan laporan</span>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="me-3 text-success">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <span>Kolaborasi antara masyarakat dan instansi pemerintah</span>
                            </div>
                            <div class="d-flex">
                                <div class="me-3 text-success">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <span>Statistik laporan yang dapat diakses publik</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-section mt-5 pt-4 border-top">
                    <h4 class="fw-bold mb-4 text-center">Hubungi Kami</h4>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-4">
                                <div class="contact-item bg-success bg-opacity-10 rounded-pill px-4 py-2">
                                    <i class="bi bi-envelope-fill text-success me-2"></i>
                                    <a href="mailto:info@sipala.com" class="text-decoration-none text-dark">info@sipala.com</a>
                                </div>
                                <div class="contact-item bg-success bg-opacity-10 rounded-pill px-4 py-2">
                                    <i class="bi bi-instagram text-success me-2"></i>
                                    <a href="https://instagram.com/sipala" target="_blank" class="text-decoration-none text-dark">@sipala</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .about-card {
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    .icon-wrapper {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .features-list {
        background-color: rgba(25, 135, 84, 0.05);
        padding: 1.5rem;
        border-radius: 0.5rem;
    }
    .contact-item {
        transition: all 0.3s ease;
    }
    .contact-item:hover {
        background-color: rgba(25, 135, 84, 0.2) !important;
        transform: translateY(-2px);
    }
    .contact-item a:hover {
        color: var(--bs-success) !important;
    }
</style>
@endsection