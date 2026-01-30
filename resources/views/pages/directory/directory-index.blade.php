@extends('layouts.app')

@section('title', 'Direktori Kampus')

@section('styles')
<style>
    body {
        font-size: 14px;
        background: #f6f7fb;
    }

    /* =========================
       TOP BAR (HEADER)
    ========================== */
    .topbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 56px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        z-index: 999;
    }

    .topbar .back-btn {
        position: absolute;
        left: 16px;
        color: #333;
    }

    .topbar .title {
        font-size: 18px;
        font-weight: 600;
        color: #222;
    }

    /* =========================
       CONTENT WRAPPER
    ========================== */
    .content-offset {
        padding-top: 20px;
        padding-bottom: 24px;
        background: #eef3fb;
        min-height: 100vh;
        border-radius: 18px 18px 0 0;
    }

    /* =========================
       FILTER
    ========================== */
    .filter-select {
        border-radius: 999px;
        font-size: 13px;
        padding: 8px 12px;
    }

    .btn-apply,
    .btn-reset {
        border-radius: 999px;
        font-weight: 500;
        padding: 8px;
    }

    .btn-apply {
        background: #ff7a00;
        color: #fff;
        border: none;
    }

    .btn-reset {
        background: #eaeaea;
        color: #333;
    }

    /* =========================
       USER CARD
    ========================== */
    .user-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        margin-bottom: 16px;
    }

    .user-card img {
        width: 52px;
        height: 52px;
        object-fit: cover;
    }

    .user-name {
        font-weight: 600;
        font-size: 15px;
    }

    .user-meta {
        font-size: 13px;
        color: #6c757d;
    }

    .user-job {
        font-size: 13px;
        color: #6c757d;
        margin-top: 2px;
    }

    /* =========================
       EMPTY STATE
    ========================== */
    .empty-state {
        margin-top: 60px;
        color: #999;
        text-align: center;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>
    <div class="title">Direktori Kampus</div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    {{-- FILTER --}}
    <form method="GET" class="mb-4">
        <div class="row g-2">

            <div class="col-4">
                <select name="type" class="form-control filter-select">
                    <option value="">Tipe</option>
                    <option value="student" {{ ($filters['type'] ?? '') == 'student' ? 'selected' : '' }}>
                        Mahasiswa
                    </option>
                    <option value="alumni" {{ ($filters['type'] ?? '') == 'alumni' ? 'selected' : '' }}>
                        Alumni
                    </option>
                </select>
            </div>

            <div class="col-4">
                <select name="faculty_id" class="form-control filter-select">
                    <option value="">Fakultas</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty['id'] }}"
                            {{ ($filters['faculty_id'] ?? '') == $faculty['id'] ? 'selected' : '' }}>
                            {{ $faculty['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-4">
                <select name="study_program_id" class="form-control filter-select">
                    <option value="">Prodi</option>
                    @foreach ($studyPrograms as $prodi)
                        <option value="{{ $prodi['id'] }}"
                            {{ ($filters['study_program_id'] ?? '') == $prodi['id'] ? 'selected' : '' }}>
                            {{ $prodi['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-4">
                <select name="entry_year" class="form-control filter-select">
                    <option value="">Angkatan</option>
                    @for ($year = now()->year; $year >= 2016; $year--)
                        <option value="{{ $year }}"
                            {{ ($filters['entry_year'] ?? '') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-4">
                <button class="btn btn-apply w-100">
                    Terapkan
                </button>
            </div>

            <div class="col-4">
                <a href="{{ route('directory.index') }}" class="btn btn-reset w-100">
                    Reset
                </a>
            </div>

        </div>
    </form>

    {{-- USER LIST --}}
    @forelse ($users as $user)
        <a href="{{ route('directory.show', $user['id']) }}" class="text-decoration-none text-dark">
            <div class="card user-card">
                <div class="card-body d-flex gap-3 align-items-center">

                    <img
                        src="{{ $user['photo'] ?: asset('assets/img/profile_male.png') }}"
                        onerror="this.onerror=null;this.src='{{ asset('assets/img/profile_male.png') }}';"
                        class="rounded-circle"
                        alt="Foto Profil">

                    <div class="grow">
                        <div class="user-name">{{ $user['name'] }}</div>
                        <div class="user-meta">
                            {{ $user['study_program'] }} · Angkatan {{ $user['entry_year'] }}
                        </div>

                        @if (!empty($user['job_title']))
                            <div class="user-job">
                                💼 {{ $user['job_title'] }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </a>
    @empty
        <div class="empty-state">
            Data tidak ditemukan
        </div>
    @endforelse

</div>
@endsection
