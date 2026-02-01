@extends('layouts.app')

@section('title', 'Detail Profil')

@section('styles')
<style>
    body {
        font-size: 14px;
    }

    /* =========================
       TOP BAR
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
        padding: 16px;
        padding-top: 90px;
        padding-bottom: 24px;
    }

    /* =========================
       PROFILE HEADER
    ========================== */
    .profile-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile-header img {
        width: 88px;
        height: 88px;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid var(--border);
        margin-bottom: 10px;
        background: var(--white);
    }

    .profile-name {
        font-weight: 600;
        font-size: 16px;
        color: var(--text-dark);
    }

    .profile-badge {
        margin-top: 6px;
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 20px;
        background: var(--blue-light);
        color: var(--blue);
        display: inline-block;
    }

    /* =========================
       CARD
    ========================== */
    .detail-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 10px;
        margin-bottom: 14px;
    }

    .detail-card .card-body {
        padding: 14px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 8px 0;
        font-size: 13px;
        border-bottom: 1px dashed var(--border);
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: var(--text-muted);
        flex-shrink: 0;
    }

    .detail-value {
        font-weight: 500;
        color: var(--text-dark);
        text-align: right;
    }

    /* =========================
       BIO
    ========================== */
    .bio-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .bio-text {
        font-size: 13px;
        color: var(--text-dark);
        line-height: 1.6;
        margin: 0;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ route('directory.index') }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>

    <div class="title">
        Detail
        @if ($user['status'] === 'alumni')
            Alumni
        @elseif ($user['status'] === 'student')
            Mahasiswa
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="content-wrapper">

    {{-- PROFILE HEADER --}}
    <div class="profile-header">
        <img
            src="{{ $user['photo'] ?: asset('assets/img/profile_male.png') }}"
            onerror="this.onerror=null;this.src='{{ asset('assets/img/profile_male.png') }}';"
            alt="Foto Profil">

        <div class="profile-name">{{ $user['name'] }}</div>

        <span class="profile-badge">
            {{ ucfirst($user['status']) }}
        </span>
    </div>

    {{-- DETAIL INFO --}}
    <div class="detail-card">
        <div class="card-body">

            <div class="detail-item">
                <span class="detail-label">Fakultas</span>
                <span class="detail-value">{{ $user['faculty'] }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Program Studi</span>
                <span class="detail-value">{{ $user['study_program'] }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Angkatan</span>
                <span class="detail-value">{{ $user['entry_year'] }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Tahun Lulus</span>
                <span class="detail-value">{{ $user['graduation_year'] ?? '-' }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Pekerjaan</span>
                <span class="detail-value">{{ $user['job_title'] ?? '-' }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Instansi</span>
                <span class="detail-value">{{ $user['current_workplace'] ?? '-' }}</span>
            </div>

        </div>
    </div>

    {{-- BIO --}}
    @if (!empty($user['bio']))
        <div class="detail-card">
            <div class="card-body">
                <div class="bio-title">Bio</div>
                <p class="bio-text">
                    {{ $user['bio'] }}
                </p>
            </div>
        </div>
    @endif

</div>
@endsection
