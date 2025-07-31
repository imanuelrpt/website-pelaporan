@extends('layouts.app')

@section('content')
<div class="register-container">
    <div class="register-wrapper">
        <!-- Left Side (Branding) -->
        <div class="register-branding">
            <div class="branding-content">
                <div class="logo-animation">
                    <div class="logo-circle">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h1>SIPALA</h1>
                </div>
                <p class="branding-text">Sistem Informasi Pelaporan Anda. Laporkan masalah, kami tanggapi segera.</p>
                
                <div class="features-carousel">
                    <div class="feature-card">
                        <i class="bi bi-megaphone"></i>
                        <h4>Pelaporan Cepat</h4>
                        <p>Laporkan masalah lingkungan dengan mudah dan cepat</p>
                    </div>
                    <div class="feature-card">
                        <i class="bi bi-graph-up"></i>
                        <h4>Transparansi</h4>
                        <p>Pantau perkembangan laporan Anda secara real-time</p>
                    </div>
                </div>
                
                <div class="branding-footer">
                    <div class="trust-badge">
                        <i class="bi bi-check-circle"></i>
                        <span>Sistem Terpercaya</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side (Form) -->
        <div class="register-form-wrapper">
            <div class="form-container">
                <div class="form-header">
                    <h2>Buat Akun Baru</h2>
                    <p class="welcome-text">Bergabunglah dengan SIPALA untuk mulai melaporkan</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="register-form">
                    @csrf
                    
                    <!-- Name Field -->
                    <div class="form-group floating-input">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <label for="name">Nama Lengkap</label>
                        <i class="bi bi-person-fill input-icon"></i>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <!-- Email Field -->
                    <div class="form-group floating-input">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email">
                        <label for="email">Alamat Email</label>
                        <i class="bi bi-envelope-fill input-icon"></i>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <!-- Password Field -->
                    <div class="form-group floating-input">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="new-password">
                        <label for="password">Password</label>
                        <i class="bi bi-lock-fill input-icon"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <!-- Confirm Password Field -->
                    <div class="form-group floating-input">
                        <input id="password-confirm" type="password" class="form-control" 
                               name="password_confirmation" required autocomplete="new-password">
                        <label for="password-confirm">Konfirmasi Password</label>
                        <i class="bi bi-shield-lock input-icon"></i>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-register">
                            <i class="bi bi-person-plus-fill me-2"></i> Daftar Sekarang
                        </button>
                    </div>
                    
                    <!-- Login Link -->
                    <div class="login-link">
                        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    :root {
        --primary-color: #198754;
        --secondary-color: #146c43;
        --accent-color: #20c997;
        --text-color: #333;
        --light-bg: #f8f9fa;
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 20px;
    }

    .register-wrapper {
        display: flex;
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
        background-color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .register-branding {
        flex: 1;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 40px;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .register-branding::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .register-branding::after {
        content: "";
        position: absolute;
        bottom: -80px;
        right: -30px;
        width: 250px;
        height: 250px;
        background-color: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .branding-content {
        width: 100%;
        position: relative;
        z-index: 1;
    }

    .logo-animation {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
    }

    .logo-circle {
        width: 60px;
        height: 60px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        animation: pulse 2s infinite;
    }

    .logo-circle i {
        font-size: 1.8rem;
        color: white;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .logo-animation h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        color: white;
    }

    .branding-text {
        font-size: 1.1rem;
        margin-bottom: 40px;
        opacity: 0.9;
        line-height: 1.6;
    }

    .features-carousel {
        margin: 40px 0;
    }

    .feature-card {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        background-color: rgba(255, 255, 255, 0.15);
    }

    .feature-card i {
        font-size: 1.8rem;
        margin-bottom: 10px;
        color: var(--accent-color);
    }

    .feature-card h4 {
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .feature-card p {
        font-size: 0.9rem;
        opacity: 0.8;
        margin: 0;
    }

    .branding-footer {
        margin-top: 40px;
    }

    .trust-badge {
        display: inline-flex;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.1);
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .trust-badge i {
        margin-right: 8px;
        color: var(--accent-color);
    }

    .register-form-wrapper {
        flex: 1;
        padding: 60px 50px;
        display: flex;
        align-items: center;
    }

    .form-container {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    .form-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 10px;
    }

    .welcome-text {
        color: #666;
        margin-bottom: 30px;
        font-size: 0.95rem;
    }

    .register-form {
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .floating-input {
        position: relative;
    }

    .floating-input input {
        height: 50px;
        padding: 16px 15px 5px 40px;
        border-radius: 8px;
        border: 1px solid #ddd;
        width: 100%;
        transition: all 0.3s;
    }

    .floating-input input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(25, 135, 84, 0.2);
    }

    .floating-input label {
        position: absolute;
        top: 15px;
        left: 40px;
        color: #999;
        transition: all 0.3s;
        pointer-events: none;
    }

    .floating-input input:focus + label,
    .floating-input input:not(:placeholder-shown) + label {
        top: 5px;
        left: 40px;
        font-size: 0.75rem;
        color: var(--primary-color);
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 15px;
        color: #999;
        font-size: 1.1rem;
    }

    .floating-input input:focus ~ .input-icon {
        color: var(--primary-color);
    }

    .btn-register {
        width: 100%;
        height: 50px;
        background-color: var(--primary-color);
        border: none;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-register:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
        color: #666;
        font-size: 0.9rem;
    }

    .login-link a {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }

    .login-link a:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .register-wrapper {
            flex-direction: column;
        }

        .register-branding {
            padding: 30px;
            text-align: center;
        }

        .logo-animation {
            justify-content: center;
        }

        .register-form-wrapper {
            padding: 40px 30px;
        }
    }

    @media (max-width: 576px) {
        .register-container {
            padding: 15px;
        }

        .register-branding {
            padding: 25px 20px;
        }

        .register-form-wrapper {
            padding: 30px 20px;
        }

        .form-header h2 {
            font-size: 1.5rem;
        }

        .floating-input input {
            height: 45px;
            padding-left: 35px;
        }

        .input-icon {
            left: 12px;
            top: 13px;
        }

        .btn-register {
            height: 45px;
        }
    }
</style>
@endsection