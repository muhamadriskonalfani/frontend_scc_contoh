@extends('layouts.auth')

@section('title', 'Login')

@section('styles')
<style>
    /* HEADER */
    .auth-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        padding: 10px;
        border-bottom: 1px solid var(--border);
        z-index: 999;
    }

    .auth-header .title {
        font-size: 18px;
        font-weight: 500;
    }

    /* FORM */
    .auth-form {
        margin: 120px 15px 0;
    }

    .auth-form label {
        font-size: 14px;
        margin-bottom: 6px;
        display: block;
        color: #444;
    }

    .auth-form .form-control {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        margin-bottom: 16px;
        font-size: 14px;
    }

    .auth-form button {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: none;
        background: var(--fresh-blue);
        color: #fff;
        font-size: 15px;
        font-weight: 500;
    }

    /* FOOTER */
    .auth-footer {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        text-align: center;
        margin: 20px 0;
        font-size: 14px;
        color: #666;
    }
</style>
@endsection

@section('header')
<div class="auth-header">
    <div class="d-flex gap-2 align-items-center">
        <a href="/" class="text-decoration-none" style="color: var(--fresh-blue)">
            <i data-feather="arrow-left"></i>
        </a>
        <span class="title">Login</span>
    </div>
</div>
@endsection

@section('content')

<div class="auth-form">
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf

        {{-- EMAIL --}}
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                value="{{ old('email') }}" required>
        </div>

        {{-- PASSWORD --}}
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        {{-- BUTTON --}}
        <button type="submit">
            Login
        </button>
    </form>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="text-danger text-center mt-3">
            {{ $errors->first() }}
        </div>
    @endif
</div>

@endsection

@section('footer')
<div class="auth-footer">
    Belum punya akun? <a href="{{ route('auth.register_meta') }}">Daftar</a>
</div>
@endsection
