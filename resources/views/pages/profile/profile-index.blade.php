@extends('layouts.app')

@section('title', 'Profile')

@section('styles')
<style>
    body {
        font-size: 14px;
        background: #f6f7fb;
    }

    /* TOP BAR */
    .topbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        padding: 14px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--white-box);
        z-index: 999;
    }

    .topbar .title-text {
        color: var(--fresh-orange);
        font-weight: 700;
        font-size: 18px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .topbar a {
        color: var(--fresh-orange);
    }

    .content-offset {
        padding-top: 10px;
        padding-bottom: 20px;
    }

    /* CARD */
    .card-box {
        background: #fff;
        border-radius: 5px;
        padding: 16px;
        margin-bottom: 18px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.05);
    }

    .card-box h6 {
        color: var(--fresh-orange);
    }

    /* USER INFO */
    .user-info div {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px dashed #eee;
        font-size: 13px;
    }

    .user-info div:last-child {
        border-bottom: none;
    }

    /* LOGOUT */
    .btn-logout {
        background: var(--fresh-orange);
        color: #fff;
        border-radius: 12px;
        padding: 12px;
        font-weight: 500;
        border: none;
    }

    .profile-avatar {
        min-width: 90px;
        min-height: 90px;
        max-width: 90px;
        max-height: 90px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--border);
    }

    .profile-name {
        font-size: 16px;
        font-weight: 600;
    }

    .profile-email {
        font-size: 13px;
        color: #777;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <div class="title-text">
        <span>🔥</span>
        <span>PROFILE</span>
    </div>

    <div class="d-flex gap-3 align-items-center">
        <a href="#"><i data-feather="search"></i></a>
        <a href="#"><i data-feather="bell"></i></a>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    <!-- Flash Message -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @if (!$exists)
        <!-- Profile Belum Ada -->
        <div class="card-box">
            <div class="text-center px-2 py-4" style="color: #777;">
                <i data-feather="user" style="width:48px;height:48px;"></i>
                <h5 class="mt-3">Profil belum dibuat</h5>
                <p class="mb-3">Lengkapi profil Anda agar lebih dikenal.</p>

                <a href="{{ route('profile.create') }}" class="btn btn-logout w-100">
                    Buat Profile
                </a>
            </div>
        </div>
    @endif

    @if ($exists)
        <!-- Profile Ada -->
        <div class="card-box text-center py-4">
            <img
                src="{{ !empty($profile['image'])
                    ? config('services.api.domain_url') . '/storage/' . $profile['image']
                    : asset('assets/img/noimage.jpg') }}"
                class="profile-avatar mb-2"
                alt="Profile Image"
            >

            <div class="profile-name">
                {{ session('auth.user.name') }}
            </div>

            <div class="profile-email">
                {{ session('auth.user.email') }}
            </div>
        </div>

        <!-- User Profile -->
        <div class="card-box">
            <h6 class="mb-3 fw-bold">Profile Anda</h6>

            <div class="user-info">
                <div>
                    <span>No. Telepon</span>
                    <strong>{{ $profile['phone'] ?? '-' }}</strong>
                </div>
                <div>
                    <span>Bio</span>
                    <strong>{{ $profile['bio'] ?? '-' }}</strong>
                </div>
                <div>
                    <span>Pendidikan</span>
                    <strong>{{ $profile['education'] ?? '-' }}</strong>
                </div>
                <div>
                    <span>Keahlian</span>
                    <strong>{{ $profile['skills'] ?? '-' }}</strong>
                </div>
                <div>
                    <span>Pengalaman</span>
                    <strong>{{ $profile['experience'] ?? '-' }}</strong>
                </div>
                <div>
                    <span>Testimoni</span>
                    <strong>{{ $profile['testimonial'] ?? '-' }}</strong>
                </div>
                <div>
                    <span>LinkedIn</span>
                    <strong>
                        @if (!empty($profile['linkedin_url']))
                            <a href="{{ $profile['linkedin_url'] }}" target="_blank">
                                {{ $profile['linkedin_url'] }}
                            </a>
                        @else
                            <div>-</div>
                        @endif
                    </strong>
                </div>
                <div>
                    <span>CV</span>
                    <strong>
                        @if (!empty($profile['cv_file']))
                            <a href="{{ asset('storage/' . $profile['cv_file']) }}" target="_blank">
                                Lihat CV
                            </a>
                        @else
                            <div>-</div>
                        @endif
                    </strong>
                </div>
            </div>
        </div>

        <!-- Edit Profile -->
        <div class="card-box">
            <a href="{{ route('profile.edit') }}" class="btn btn-logout w-100">
                Edit Profile
            </a>
        </div>
    @endif

</div>
@endsection
