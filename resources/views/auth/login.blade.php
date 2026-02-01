@extends('layouts.auth')

@section('title', 'Login')

@section('styles')
<style>
    /* HEADER LOGO */
    .auth-brand {
        text-align: center;
        margin-top: 40px;
        margin-bottom: 24px;
    }

    .auth-brand img {
        width: 64px;
        margin-bottom: 12px;
    }

    .auth-brand h1 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .auth-brand p {
        font-size: 14px;
        color: var(--text-muted);
        margin: 0;
    }

    /* CARD */
    .auth-card {
        background: var(--white);
        border-radius: 18px;
        padding: 24px 20px;
        margin: 0 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,.08);
    }

    .auth-card h2 {
        text-align: center;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    /* INPUT */
    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        font-size: 13px;
        margin-bottom: 6px;
        display: block;
        color: var(--text-dark);
    }

    .input-icon {
        position: relative;
    }

    /* ICON KIRI */
    .input-icon .icon-left {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        width: 18px;
        height: 18px;
    }

    /* ICON KANAN (EYE) */
    .input-icon .icon-right {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        cursor: pointer;
        width: 18px;
        height: 18px;
    }

    .input-icon .form-control {
        height: 44px;
        border-radius: 10px;
        border: 1px solid var(--border);
        font-size: 14px;
        padding-left: 44px;
        padding-right: 44px;
    }

    .input-icon .form-control:focus {
        border-color: var(--blue);
        box-shadow: none;
    }

    /* BUTTON */
    .btn-login {
        width: 100%;
        height: 44px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(90deg, var(--blue), var(--blue-dark));
        color: #fff;
        font-weight: 500;
        margin-top: 8px;
    }

    /* LINKS */
    .auth-links {
        text-align: center;
        margin-top: 14px;
        font-size: 14px;
    }

    .auth-links a {
        color: var(--blue);
        text-decoration: none;
        font-weight: 500;
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 16px 0;
        color: #9ca3af;
        font-size: 13px;
    }

    .divider::before,
    .divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }

    .divider span {
        padding: 0 10px;
    }
</style>
@endsection

@section('content')

{{-- BRAND --}}
<div class="auth-brand">
    {{-- ganti dengan logo kamu --}}
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
    <h1>Student Career Center</h1>
    <p>Pusat Karier Mahasiswa</p>
</div>

{{-- CARD --}}
<div class="auth-card">
    <h2>Login</h2>

    <form action="{{ route('auth.login') }}" method="POST">
        @csrf

        {{-- EMAIL --}}
        <div class="form-group">
            <label>Email</label>
            <div class="input-icon">
                <i data-feather="mail" class="icon-left"></i>
                <input type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan email"
                    value="{{ old('email') }}"
                    required>
            </div>
        </div>


        {{-- PASSWORD --}}
        <div class="form-group">
            <label>Password</label>
            <div class="input-icon">
                <i data-feather="lock" class="icon-left"></i>

                <input type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required>

                <i data-feather="eye"
                class="icon-right"
                onclick="togglePassword()"
                id="toggleEye"></i>
            </div>
        </div>


        {{-- BUTTON --}}
        <button class="btn-login" type="submit">
            Login
        </button>
    </form>

    {{-- LINKS --}}
    <div class="auth-links">
        <a href="#">Lupa password?</a>

        <div class="divider">
            <span>or</span>
        </div>

        Belum Punya Akun?
        <a href="{{ route('auth.register_meta') }}">Daftar</a>
    </div>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="text-danger text-center mt-3">
            {{ $errors->first() }}
        </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const eye = document.getElementById('toggleEye');

        if (password.type === 'password') {
            password.type = 'text';
            eye.setAttribute('data-feather', 'eye-off');
        } else {
            password.type = 'password';
            eye.setAttribute('data-feather', 'eye');
        }

        feather.replace();
    }
</script>
@endsection
