@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-wrapper">
        <!-- Bagian Kiri (Branding) -->
        <div class="login-branding">
            <div class="branding-content">
                <div class="logo-wrapper">
                    <i class="bi bi-shield-check"></i>
                    <h1>SIPALA</h1>
                </div>
                <p class="branding-text">Sistem Informasi Pelaporan Anda. Laporkan masalah, kami tanggapi segera.</p>
                <div class="branding-image">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Lingkungan Bersih" 
                         class="img-fluid rounded-4">
                </div>
                <div class="features-list">
                    <div class="feature-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Pelaporan cepat</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Respon instansi</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Transparansi proses</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Kanan (Form Login) -->
        <div class="login-form-wrapper">
            <div class="form-container">
                <div class="form-header">
                    <h2>Masuk ke Akun Anda</h2>
                    <p class="welcome-text">Selamat datang kembali! Silakan masuk ke akun SIPALA Anda.</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-custom" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    <div class="form-group floating-input">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <label for="email">Alamat Email</label>
                        <i class="bi bi-envelope-fill input-icon"></i>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group floating-input">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="current-password">
                        <label for="password">Password</label>
                        <i class="bi bi-lock-fill input-icon"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password">Lupa Password?</a>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login
                        </button>
                    </div>

                    <div class="divider">
                        <span>atau</span>
                    </div>

                    <p class="register-link">Belum punya akun? <a href="{{ route('register') }}" class="register-cta">Daftar di sini</a></p>
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

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 20px;
    }

    .login-wrapper {
        display: flex;
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
        background-color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .login-branding {
        flex: 1;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 40px;
        display: flex;
        align-items: center;
    }

    .branding-content {
        width: 100%;
    }

    .logo-wrapper {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .logo-wrapper i {
        font-size: 2.5rem;
        margin-right: 15px;
        color: white;
    }

    .logo-wrapper h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        color: white;
    }

    .branding-text {
        font-size: 1.1rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .branding-image {
        margin-bottom: 30px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .branding-image img {
        transition: transform 0.5s ease;
    }

    .branding-image:hover img {
        transform: scale(1.03);
    }

    .features-list {
        margin-top: 30px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-size: 1rem;
    }

    .feature-item i {
        margin-right: 10px;
        color: var(--accent-color);
        font-size: 1.2rem;
    }

    .login-form-wrapper {
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

    .alert-custom {
        border-radius: 8px;
        padding: 12px 15px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
    }

    .login-form {
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

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        font-size: 0.9rem;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        border: 1px solid #ddd;
    }

    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .forgot-password {
        color: var(--primary-color);
        text-decoration: none;
        transition: color 0.3s;
    }

    .forgot-password:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }

    .btn-login {
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

    .btn-login:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 25px 0;
        color: #999;
        font-size: 0.8rem;
    }

    .divider::before,
    .divider::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #eee;
    }

    .divider::before {
        margin-right: 10px;
    }

    .divider::after {
        margin-left: 10px;
    }

    .register-link {
        text-align: center;
        color: #666;
        font-size: 0.9rem;
    }

    .register-cta {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }

    .register-cta:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .login-wrapper {
            flex-direction: column;
        }

        .login-branding {
            padding: 30px;
            text-align: center;
        }

        .logo-wrapper {
            justify-content: center;
        }

        .branding-image {
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .login-form-wrapper {
            padding: 40px 30px;
        }
    }

    @media (max-width: 576px) {
        .login-container {
            padding: 15px;
        }

        .login-branding {
            padding: 25px 20px;
        }

        .login-form-wrapper {
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

        .btn-login {
            height: 45px;
        }
    }
</style>
@endsection