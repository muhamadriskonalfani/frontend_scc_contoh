@extends('layouts.app')

@section('title', 'Career Info Selection')

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
    .content-offset {
        padding: 16px;
        padding-top: 75px;
    }

    /* =========================
       CAREER MENU
    ========================== */
    .career-menu {
        padding: 12px 16px;
    }

    .career-item {
        display: flex;
        align-items: center;
        gap: 14px;
        background: var(--white);
        border-radius: 8px;
        padding: 14px 16px;
        margin-bottom: 12px;
        text-decoration: none;
        color: #333;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        transition: all 0.2s ease;
    }

    .career-item:hover {
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transform: translateY(-1px);
    }

    .career-icon {
        width: 42px;
        height: 42px;
        background: var(--blue-light); 
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue);
    }

    .career-icon svg {
        width: 20px;
        height: 20px;
    }

    .career-text {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .career-text .title {
        font-weight: 600;
        font-size: 14px;
    }

    .career-text .subtitle {
        font-size: 12px;
        color: #777;
    }

    .career-arrow {
        color: #bbb;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ route('dashboard.index') }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>
    <div class="title">Pilih Info Karir</div>
</div>
@endsection

@section('content')
<div class="content-offset">

    <div class="career-menu">

        <a href="{{ route('apprenticeship.index') }}" class="career-item">
            <div class="career-icon">
                <i data-feather="briefcase"></i>
            </div>
            <div class="career-text">
                <span class="title">Informasi Magang</span>
                <span class="subtitle">Program magang & internship</span>
            </div>
            <div class="career-arrow">
                <i data-feather="chevron-right"></i>
            </div>
        </a>

        <a href="{{ route('job_vacancy.index') }}" class="career-item">
            <div class="career-icon">
                <i data-feather="clipboard"></i>
            </div>
            <div class="career-text">
                <span class="title">Lowongan Kerja</span>
                <span class="subtitle">Info karier & rekrutmen</span>
            </div>
            <div class="career-arrow">
                <i data-feather="chevron-right"></i>
            </div>
        </a>

    </div>

</div>
@endsection
