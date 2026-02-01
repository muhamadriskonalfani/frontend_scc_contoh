@extends('layouts.auth')

@section('title', 'Register')

@section('styles')
<style>
    /* BRAND */
    .auth-brand {
        text-align: center;
        margin-top: 32px;
        margin-bottom: 20px;
    }

    .auth-brand img {
        width: 64px;
        margin-bottom: 10px;
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
        margin: 0 16px 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,.08);
    }

    .auth-card h2 {
        text-align: center;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    /* FORM */
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

    .icon-left {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #9ca3af;
    }

    .icon-right {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #9ca3af;
        cursor: pointer;
    }

    .input-icon .form-control,
    .input-icon select {
        height: 44px;
        border-radius: 10px;
        border: 1px solid var(--border);
        font-size: 14px;
        padding-left: 44px;
        padding-right: 44px;
    }

    /* BUTTON */
    .btn-register {
        width: 100%;
        height: 44px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(90deg, var(--blue), #2b64a8);
        color: #fff;
        font-weight: 500;
        margin-top: 8px;
    }

    /* LINK */
    .auth-links {
        text-align: center;
        margin-top: 18px;
        font-size: 14px;
    }

    .auth-links a {
        color: var(--blue);
        font-weight: 500;
        text-decoration: none;
    }
</style>
@endsection

@section('content')

{{-- BRAND --}}
<div class="auth-brand">
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
    <h1>Student Career Center</h1>
    <p>Pusat Karier Mahasiswa</p>
</div>

{{-- CARD --}}
<div class="auth-card">
    <h2>Register</h2>

    <form action="{{ route('auth.register') }}" method="POST">
        @csrf

        {{-- NAMA --}}
        <div class="form-group">
            <label>Nama Lengkap</label>
            <div class="input-icon">
                <i data-feather="user" class="icon-left"></i>
                <input type="text" name="name" class="form-control"
                       placeholder="Masukkan nama"
                       value="{{ old('name') }}" required>
            </div>
        </div>

        {{-- EMAIL --}}
        <div class="form-group">
            <label>Email</label>
            <div class="input-icon">
                <i data-feather="mail" class="icon-left"></i>
                <input type="email" name="email" class="form-control"
                       placeholder="Masukkan email"
                       value="{{ old('email') }}" required>
            </div>
        </div>

        {{-- PASSWORD --}}
        <div class="form-group">
            <label>Password</label>
            <div class="input-icon">
                <i data-feather="lock" class="icon-left"></i>
                <input type="password" id="password" name="password"
                       class="form-control"
                       placeholder="Masukkan password"
                       required>
                <i data-feather="eye" class="icon-right" onclick="togglePassword('password','eye1')" id="eye1"></i>
            </div>
        </div>

        {{-- PASSWORD CONFIRM --}}
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <div class="input-icon">
                <i data-feather="lock" class="icon-left"></i>
                <input type="password" id="password_confirmation"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Ulangi password"
                       required>
                <i data-feather="eye" class="icon-right" onclick="togglePassword('password_confirmation','eye2')" id="eye2"></i>
            </div>
        </div>

        {{-- ROLE --}}
        <div class="form-group">
            <label>Daftar Sebagai</label>
            <div class="input-icon">
                <i data-feather="users" class="icon-left"></i>
                <select name="role" class="form-control" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="alumni" {{ old('role') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                </select>
            </div>
        </div>

        {{-- NIM --}}
        <div class="form-group">
            <label>NIM / NPM</label>
            <div class="input-icon">
                <i data-feather="credit-card" class="icon-left"></i>
                <input type="text" name="student_id_number"
                       class="form-control"
                       placeholder="Masukkan NIM / NPM"
                       value="{{ old('student_id_number') }}" required>
            </div>
        </div>

        {{-- FAKULTAS --}}
        <div class="form-group">
            <label>Fakultas</label>
            <div class="input-icon">
                <i data-feather="home" class="icon-left"></i>
                <select name="faculty_id" class="form-control" required>
                    <option value="">-- Pilih Fakultas --</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty['id'] }}"
                            {{ old('faculty_id') == $faculty['id'] ? 'selected' : '' }}>
                            {{ $faculty['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- PRODI --}}
        <div class="form-group">
            <label>Program Studi</label>
            <div class="input-icon">
                <i data-feather="book-open" class="icon-left"></i>
                <select name="study_program_id" class="form-control" required>
                    <option value="">-- Pilih Prodi --</option>
                    @foreach ($studyPrograms as $prodi)
                        <option value="{{ $prodi['id'] }}"
                            {{ old('study_program_id') == $prodi['id'] ? 'selected' : '' }}>
                            {{ $prodi['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- TAHUN MASUK --}}
        <div class="form-group">
            <label>Tahun Masuk</label>
            <div class="input-icon">
                <i data-feather="calendar" class="icon-left"></i>
                <input type="number" name="entry_year"
                       class="form-control"
                       placeholder="Contoh: 2021"
                       value="{{ old('entry_year') }}" required>
            </div>
        </div>

        {{-- TAHUN LULUS --}}
        <div class="form-group">
            <label>Tahun Lulus (opsional)</label>
            <div class="input-icon">
                <i data-feather="calendar" class="icon-left"></i>
                <input type="number" name="graduation_year"
                       class="form-control"
                       placeholder="Contoh: 2025"
                       value="{{ old('graduation_year') }}">
            </div>
        </div>

        <button type="submit" class="btn-register">
            Daftar
        </button>
    </form>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="text-danger text-center mt-3">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="auth-links">
        Sudah punya akun? <a href="{{ route('index') }}">Login</a>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function togglePassword(inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eye = document.getElementById(eyeId);

        if (input.type === 'password') {
            input.type = 'text';
            eye.setAttribute('data-feather', 'eye-off');
        } else {
            input.type = 'password';
            eye.setAttribute('data-feather', 'eye');
        }

        feather.replace();
    }
</script>
@endsection
