@extends('layouts.app')

@section('title', 'Beranda')

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

    /* MENU GRID */
    .menu-grid {
        display: flex;  
        flex-direction: column;
        align-items: center;
        justify-content: center;

        text-align: center;
        padding: 14px 8px;
        height: 70px; 
        border-radius: 12px;
        transition: all .2s;
    }

    .menu-grid:hover {
        background: var(--fresh-orange);
        color: #fff;
    }

    .menu-grid i {
        width: 26px;
        height: 26px;
        margin-bottom: 6px;
        display: block; 
        color: var(--fresh-orange);
    }

    .menu-grid span {
        display: block;
        font-size: 12px;
        font-weight: 500;
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
</style>
@endsection

@section('header')
<div class="topbar">
    <div class="title-text">
        <span>🔥</span>
        <span>BERANDA</span>
    </div>

    <div class="d-flex gap-3 align-items-center">
        <a href="#"><i data-feather="search"></i></a>
        <a href="#"><i data-feather="bell"></i></a>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    {{-- MENU --}}
    <div class="card-box">
        <h6 class="mb-3 fw-bold">Menu</h6>

        <div class="row g-3">
            <div class="col-3">
                <a href="#" class="menu-grid text-decoration-none text-dark">
                    <i data-feather="activity"></i>
                    <span>Tracer</span>
                </a>
            </div>
            <div class="col-3">
                <a href="#" class="menu-grid text-decoration-none text-dark">
                    <i data-feather="briefcase"></i>
                    <span>Karir</span>
                </a>
            </div>
            <div class="col-3">
                <a href="#" class="menu-grid text-decoration-none text-dark">
                    <i data-feather="book-open"></i>
                    <span>Kampus</span>
                </a>
            </div>
            <div class="col-3">
                <a href="#" class="menu-grid text-decoration-none text-dark">
                    <i data-feather="user"></i>
                    <span>Profil</span>
                </a>
            </div>
        </div>
    </div>

    {{-- USER INFO --}}
    <div class="card-box">
        <h6 class="mb-3 fw-bold">Informasi Akun</h6>

        <div class="user-info">
            <div>
                <span>Nama</span>
                <strong>{{ session('auth.user.name') }}</strong>
            </div>
            <div>
                <span>Email</span>
                <strong>{{ session('auth.user.email') }}</strong>
            </div>
            <div>
                <span>Role</span>
                <strong>{{ session('auth.user.role') }}</strong>
            </div>
            <div>
                <span>Status</span>
                <strong>{{ session('auth.user.status') }}</strong>
            </div>
        </div>
    </div>

    {{-- LOGOUT --}}
    <div class="card-box">
        <form action="{{ route('auth.logout') }}" method="POST"
              onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
            @csrf
            <button type="submit" class="btn btn-logout w-100">
                Logout
            </button>
        </form>
    </div>

</div>
@endsection
