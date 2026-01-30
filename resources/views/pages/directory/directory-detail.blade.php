@extends('layouts.app')

@section('title', 'Detail Profil')

@section('styles')
<style>
    body {
        font-size: 14px;
        background: #f6f7fb;
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
       CONTENT
    ========================== */
    .content-offset {
        padding-top: 20px;
        padding-bottom: 24px;
        background: #eef3fb;
        min-height: 100vh;
        border-radius: 18px 18px 0 0;
    }

    /* =========================
       PROFILE HEADER
    ========================== */
    .profile-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile-header img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        margin-bottom: 10px;
    }

    .profile-name {
        font-weight: 600;
        font-size: 18px;
    }

    .profile-badge {
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 999px;
    }

    /* =========================
       CARD
    ========================== */
    .detail-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        margin-bottom: 16px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 13px;
        border-bottom: 1px dashed #eee;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: #6c757d;
    }

    .detail-value {
        font-weight: 500;
        text-align: right;
    }

    /* =========================
       BIO
    ========================== */
    .bio-text {
        font-size: 13px;
        color: #444;
        line-height: 1.6;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>

    <div class="title">
        Detail
        @if ($user['status'] == 'alumni') Alumni
        @elseif ($user['status'] == 'student') Mahasiswa
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    {{-- PROFILE HEADER --}}
    <div class="profile-header">
        <img
            src="{{ $user['photo'] ?: asset('assets/img/profile_male.png') }}"
            onerror="this.onerror=null;this.src='{{ asset('assets/img/profile_male.png') }}';"
            alt="Foto Profil">

        <div class="profile-name">{{ $user['name'] }}</div>

        <span class="badge bg-info profile-badge">
            {{ ucfirst($user['status']) }}
        </span>
    </div>

    {{-- DETAIL INFO --}}
    <div class="card detail-card">
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
        <div class="card detail-card">
            <div class="card-body">
                <strong>Bio</strong>
                <p class="bio-text mt-2">
                    {{ $user['bio'] }}
                </p>
            </div>
        </div>
    @endif

</div>
@endsection
