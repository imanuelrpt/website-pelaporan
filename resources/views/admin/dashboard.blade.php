@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title mb-0">Dashboard</h1>
    </div>
    <div class="card-body">
        <p class="lead">Selamat datang di Panel Admin, {{ Auth::user()->name }}.</p>
        <p>Dari sini Anda dapat mengelola semua laporan yang masuk dari pengguna. Gunakan sidebar di sebelah kiri untuk menavigasi ke halaman yang berbeda.</p>
        <hr>
        <a href="{{ route('admin.laporan.index') }}" class="btn btn-primary">
            <i class="bi bi-file-earmark-text"></i> Lihat Laporan Masuk
        </a>
    </div>
</div>
@endsection