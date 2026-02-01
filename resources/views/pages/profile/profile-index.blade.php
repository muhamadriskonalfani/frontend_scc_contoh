@extends('layouts.app')

@section('title', 'Profil')

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
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .topbar .back-btn {
        position: absolute;
        left: 16px;
        color: var(--text-dark);
    }

    .topbar .title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .content-offset {
        padding: 90px 16px 40px;
    }

    /* =========================
       PROFILE CARD
    ========================== */
    .profile-card {
        background: var(--white);
        border-radius: 24px;
        padding: 24px 16px 18px;
        box-shadow: 0 15px 35px rgba(0,0,0,.08);
        position: relative;
        text-align: center;
        margin-top: 56px;
    }

    .profile-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--white);
        box-shadow: 0 10px 25px rgba(0,0,0,.15);
        margin-top: -80px;
        background: var(--white);
    }

    .profile-name {
        font-size: 18px;
        font-weight: 600;
        margin-top: 12px;
        color: var(--text-dark);
    }

    .profile-nim {
        font-size: 14px;
        color: var(--text-muted);
        margin-bottom: 8px;
    }

    /* EDIT BUTTON */
    .btn-edit {
        position: absolute;
        top: 16px;
        right: 16px;
        background: var(--blue-light);
        color: var(--blue);
        border-radius: 999px;
        padding: 6px 14px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 6px;
        border: none;
        text-decoration: none;
    }

    /* =========================
       INFO LIST
    ========================== */
    .info-list {
        margin-top: 18px;
        text-align: left;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-item span {
        color: var(--text-muted);
    }

    .info-item strong {
        font-weight: 500;
        color: var(--text-dark);
        text-align: right;
        max-width: 60%;
    }

    /* =========================
       ACTION BUTTONS
    ========================== */
    .btn-action {
        background: var(--blue);
        color: #fff;
        border-radius: 16px;
        padding: 14px;
        font-weight: 500;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-logout {
        background: var(--blue-dark);
        color: #fff;
        border-radius: 16px;
        padding: 14px;
        font-weight: 500;
        border: none;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ route('dashboard.index') }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>
    <div class="title">Profil</div>
</div>
@endsection

@section('content')
<div class="content-offset">

    @if (!$exists)
        <div class="profile-card">
            <i data-feather="user" style="width:48px;height:48px;color:var(--text-muted);"></i>
            <h5 class="mt-3">Profil belum dibuat</h5>
            <p class="text-muted">Lengkapi profil Anda agar lebih dikenal</p>

            <a href="{{ route('profile.create') }}" class="btn btn-action w-100 mt-3">
                Buat Profil
            </a>
        </div>
    @endif

    @if ($exists)
        <!-- PROFILE CARD -->
        <div class="profile-card mb-4">

            <a href="{{ route('profile.edit') }}" class="btn-edit">
                <i data-feather="edit-2" width="14"></i>
                Edit
            </a>

            <img
                src="{{ !empty($profile['image'])
                    ? config('services.api.domain_url') . '/storage/' . $profile['image']
                    : asset('assets/img/noimage.jpg') }}"
                class="profile-avatar"
                alt="Profile Image"
            >

            <div class="profile-name">
                {{ session('auth.user.name') }}
            </div>

            <div class="profile-nim">
                {{ session('auth.user.nim') ?? '-' }}
            </div>

            <div class="info-list">
                <div class="info-item">
                    <span>Email</span>
                    <strong>{{ session('auth.user.email') }}</strong>
                </div>
                <div class="info-item">
                    <span>NIM</span>
                    <strong>{{ session('auth.user.nim') ?? '-' }}</strong>
                </div>
                <div class="info-item">
                    <span>Fakultas</span>
                    <strong>{{ $profile['faculty'] ?? '-' }}</strong>
                </div>
                <div class="info-item">
                    <span>Program Studi</span>
                    <strong>{{ $profile['study_program'] ?? '-' }}</strong>
                </div>
                <div class="info-item">
                    <span>Angkatan</span>
                    <strong>{{ $profile['generation'] ?? '-' }}</strong>
                </div>
            </div>
        </div>

        <!-- INFO KARIR -->
        <div class="mb-4">
            <a href="{{ route('profile.career_info') }}" class="btn btn-action w-100">
                <i data-feather="briefcase"></i>
                Info Karir Saya
            </a>
        </div>
    @endif

    <!-- LOGOUT -->
    <form action="{{ route('auth.logout') }}" method="POST"
          onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
        @csrf
        <button type="submit" class="btn btn-logout w-100">
            Logout
        </button>
    </form>

</div>
@endsection
