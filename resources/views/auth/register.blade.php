@extends('layouts.auth')

@section('title', 'Register')

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
        padding: 10px 15px;
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
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2px;
        height: 58px;
        background: var(--white-box);
        border-top: 1px solid var(--border);
        z-index: 1000;
        text-align: center;
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
        <span class="title">Register</span>
    </div>
</div>
@endsection

@section('content')

<div class="auth-form">
    <form action="{{ route('auth.register') }}" method="POST">
        @csrf

        {{-- NAMA --}}
        <div>
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control"
                value="{{ old('name') }}" required>
        </div>

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

        {{-- PASSWORD CONFIRM --}}
        <div>
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control"
                id="password_confirmation" required>
        </div>

        {{-- ROLE --}}
        <div>
            <label for="role">Daftar Sebagai</label>
            <select name="role" id="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>
                    Mahasiswa
                </option>
                <option value="alumni" {{ old('role') == 'alumni' ? 'selected' : '' }}>
                    Alumni
                </option>
            </select>
        </div>

        {{-- NIM / NPM --}}
        <div>
            <label for="student_id_number">NIM / NPM</label>
            <input type="text" name="student_id_number" class="form-control"
                id="student_id_number"
                value="{{ old('student_id_number') }}" required>
        </div>

        {{-- FAKULTAS --}}
        <div>
            <label for="faculty_id">Fakultas</label>
            <select name="faculty_id" id="faculty_id" class="form-control" required>
                <option value="">-- Pilih Fakultas --</option>
                @foreach ($faculties as $faculty)
                    <option value="{{ $faculty['id'] }}"
                        {{ old('faculty_id') == $faculty['id'] ? 'selected' : '' }}>
                        {{ $faculty['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- PROGRAM STUDI --}}
        <div>
            <label for="study_program_id">Program Studi</label>
            <select name="study_program_id" id="study_program_id" class="form-control" required>
                <option value="">-- Pilih Prodi --</option>
                @foreach ($studyPrograms as $prodi)
                    <option value="{{ $prodi['id'] }}"
                        {{ old('study_program_id') == $prodi['id'] ? 'selected' : '' }}>
                        {{ $prodi['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- TAHUN MASUK --}}
        <div>
            <label for="entry_year">Tahun Masuk</label>
            <input type="number" name="entry_year" class="form-control"
                id="entry_year" min="1990" max="{{ date('Y') }}"
                value="{{ old('entry_year') }}" required>
        </div>

        {{-- TAHUN LULUS (OPTIONAL) --}}
        <div>
            <label for="graduation_year">Tahun Lulus (opsional)</label>
            <input type="number" name="graduation_year" class="form-control"
                id="graduation_year"
                value="{{ old('graduation_year') }}">
        </div>

        {{-- BUTTON --}}
        <button type="submit">
            Daftar
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
    Sudah punya akun? <a href="{{ route('index') }}">Login</a>
</div>
@endsection
