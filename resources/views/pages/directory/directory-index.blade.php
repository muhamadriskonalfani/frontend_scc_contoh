@extends('layouts.app')

@section('title', 'Direktori Kampus')

@section('styles')
<style>
    body {
        font-size: 14px;
    }

    /* =========================
       HEADER
    ========================== */
    .topbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 56px;
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid var(--border);
    }

    .topbar .back-btn {
        position: absolute;
        left: 16px;
        color: var(--text-dark);
    }

    .topbar .title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
    }

    /* =========================
       CONTENT
    ========================== */
    .content-wrapper {
        padding: 65px 16px 40px;
    }

    /* =========================
       FILTER
    ========================== */
    .filter-select {
        font-size: 13px;
        padding: 8px 10px;
        border-radius: 8px;
        border: 1px solid var(--border);
    }

    .btn-apply {
        background: var(--blue);
        color: #fff;
        border-radius: 8px;
        border: none;
        font-size: 13px;
        font-weight: 500;
    }

    .btn-reset {
        background: #f1f5f9;
        color: var(--text-dark);
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
    }

    /* =========================
       USER CARD
    ========================== */
    .user-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 12px;
        margin-bottom: 12px;
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .user-card img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-name {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .user-meta {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .user-job {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    /* =========================
       EMPTY STATE
    ========================== */
    .empty-state {
        margin-top: 60px;
        font-size: 13px;
        color: var(--text-muted);
        text-align: center;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ route('dashboard.index') }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>
    <div class="title">Direktori Kampus</div>
</div>
@endsection

@section('content')
<div class="content-wrapper">

    {{-- FILTER --}}
    <form method="GET" class="mb-3">
        <div class="row g-2">

            <div class="col-6">
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

            <div class="col-6">
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

            <div class="col-6">
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

            <div class="col-6">
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

            <div class="col-6">
                <button class="btn btn-apply w-100">Terapkan</button>
            </div>

            <div class="col-6">
                <a href="{{ route('directory.index') }}" class="btn btn-reset w-100">Reset</a>
            </div>

        </div>
    </form>

    {{-- USER LIST --}}
    @forelse ($users as $user)
        <a href="{{ route('directory.show', $user['id']) }}"
           class="text-decoration-none">

            <div class="user-card">
                <img
                    src="{{ $user['photo'] ?: asset('assets/img/profile_male.png') }}"
                    onerror="this.onerror=null;this.src='{{ asset('assets/img/profile_male.png') }}';"
                    alt="Foto Profil">

                <div>
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
        </a>
    @empty
        <div class="empty-state">
            Data tidak ditemukan
        </div>
    @endforelse

</div>
@endsection
