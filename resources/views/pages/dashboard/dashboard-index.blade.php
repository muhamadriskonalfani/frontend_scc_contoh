@extends('layouts.app')

@section('title', 'Beranda')

@section('styles')
<style>
    body {
        font-size: 14px;
    }

    /* HERO */
    .hero {
        text-align: center;
        padding: 24px 16px 10px;
    }

    .hero img {
        width: 64px;
        margin-bottom: 12px;
    }

    .hero h1 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .hero p {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
    }

    /* USER CARD */
    .user-card {
        background: #fff;
        border-radius: 18px;
        padding: 14px 16px;
        margin: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 10px 25px rgba(0,0,0,.08);
    }

    .user-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #eaf3ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: var(--blue);
    }

    .user-name {
        font-weight: 600;
    }

    .user-id {
        font-size: 13px;
        color: #6b7280;
    }

    .notif {
        position: relative;
    }

    .notif span {
        position: absolute;
        top: -4px;
        right: -4px;
        background: #f97316;
        color: #fff;
        font-size: 11px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* QUICK MENU */
    .quick-menu {
        margin: 12px 16px 24px;
    }

    .quick-item {
        background: #fff;
        border-radius: 18px;
        padding: 16px 8px;
        text-align: center;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;

        height: 96px;
        box-shadow: 0 8px 20px rgba(0,0,0,.06);
        transition: all .2s ease;
    }

    .quick-item:active {
        transform: scale(.97);
    }

    .quick-item i {
        width: 28px;
        height: 28px;
        color: var(--blue);
    }

    .quick-item span {
        font-size: 12px;
        font-weight: 500;
        color: #374151;
        line-height: 1.2;
    }


    /* SECTION */
    .section {
        margin: 0 16px 16px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .section-header h5 {
        font-size: 16px;
        font-weight: 600;
    }

    .section-header a {
        font-size: 13px;
        color: var(--blue);
        text-decoration: none;
    }

    /* INFO CARD */
    .info-card {
        background: #fff;
        border-radius: 16px;
        padding: 12px;
        display: flex;
        gap: 12px;
        margin-bottom: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,.06);
    }

    .info-card img {
        width: 72px;
        height: 72px;
        border-radius: 12px;
        object-fit: cover;
    }

    .info-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .info-meta {
        font-size: 13px;
        color: #6b7280;
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<div class="hero">
    <img src="{{ asset('assets/img/logo.png') }}">
    <p>Selamat Datang di</p>
    <h1>Student Career Center</h1>
    <p>Pusat Karier Mahasiswa</p>
</div>

{{-- USER CARD --}}
<div class="user-card">
    <div class="user-left">
        <div class="user-avatar">
            {{ strtoupper(substr(session('auth.user.name'),0,1)) }}
        </div>
        <div>
            <div class="user-name">{{ session('auth.user.name') }}</div>
            <div class="user-id">{{ session('auth.user.student_id_number') ?? '-' }}</div>
        </div>
    </div>

    <div class="notif">
        <i data-feather="bell"></i>
        <span>3</span>
    </div>
</div>

{{-- QUICK MENU --}}
<div class="quick-menu">
    <div class="row g-3">
        <div class="col-4">
            <a href="{{ route('profile.index') }}" class="quick-item text-decoration-none text-dark">
                <i data-feather="user"></i>
                <span>Profil</span>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('directory.index') }}" class="quick-item text-decoration-none text-dark">
                <i data-feather="users"></i>
                <span>Pengguna</span>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('tracer_study.index') }}" class="quick-item text-decoration-none text-dark">
                <i data-feather="clipboard"></i>
                <span>Tracer</span>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('dashboard.career_info') }}" class="quick-item text-decoration-none text-dark">
                <i data-feather="briefcase"></i>
                <span>Info Karir</span>
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('campus.info.index') }}" class="quick-item text-decoration-none text-dark">
                <i data-feather="book-open"></i>
                <span>Info Kampus</span>
            </a>
        </div>
    </div>
</div>

{{-- INFO KAMPUS --}}
<div class="section">
    <div class="section-header">
        <h5>Info Kampus</h5>
        <a href="#">Lihat Semua</a>
    </div>

    {{-- Dummy Data --}}
    <div class="info-card">
        <img src="https://picsum.photos/200/200?1">
        <div>
            <div class="info-title">Seminar Nasional Kewirausahaan</div>
            <div class="info-meta">15 Juli 2024</div>
        </div>
    </div>

    <div class="info-card">
        <img src="https://picsum.photos/200/200?2">
        <div>
            <div class="info-title">Pendaftaran Beasiswa Prestasi</div>
            <div class="info-meta">12 Juli 2024</div>
        </div>
    </div>
</div>

@endsection
