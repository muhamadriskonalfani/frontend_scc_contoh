@extends('layouts.app')

@section('title', 'Detail Lowongan')

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
        border-bottom: 1px solid #eee;
    }

    .topbar .back-btn {
        position: absolute;
        left: 16px;
        color: var(--text-dark);
    }

    .topbar .action-btn {
        position: absolute;
        right: 16px;
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
        padding-top: 70px;
        padding-bottom: 24px;
    }

    /* =========================
        IMAGE
    ========================== */
    .detail-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        background: #eee;
        border-radius: 14px;
    }

    /* CARD */
    .card-box {
        background: #fff;
        border-radius: 14px;
        padding: 16px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.05);
        margin-bottom: 16px;
    }

    .detail-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--fresh-blue);
        line-height: 1.4;
        margin-bottom: 10px;
    }

    .detail-meta {
        font-size: 13px;
        color: #666;
    }

    .detail-meta div {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
    }

    .detail-meta i {
        width: 14px;
        height: 14px;
    }

    /* DESCRIPTION */
    .section-title {
        font-size: 15px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .detail-description {
        font-size: 14px;
        line-height: 1.7;
        color: #444;
    }

    /* BADGE */
    .badge-expired {
        display: inline-block;
        font-size: 12px;
        padding: 6px 10px;
        border-radius: 8px;
        background: #fff3cd;
        color: #856404;
        font-weight: 600;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>

    <div class="title">Detail Lowongan Kerja</div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    {{-- IMAGE --}}
    @if (!empty($jobVacancy['image']))
        <img src="{{ $jobVacancy['image'] }}" class="detail-image mb-3">
    @else
        <div class="detail-image d-flex align-items-center justify-content-center text-muted mb-3">
            <small>Tidak ada gambar</small>
        </div>
    @endif

    {{-- INFO UTAMA --}}
    <div class="card-box">
        <div class="detail-title">
            {{ $jobVacancy['title'] }}
        </div>

        <div class="detail-meta">
            <div>
                <i data-feather="briefcase"></i>
                <span>{{ $jobVacancy['company_name'] }}</span>
            </div>
            <div>
                <i data-feather="map-pin"></i>
                <span>{{ $jobVacancy['location'] }}</span>
            </div>
            <div>
                <i data-feather="calendar"></i>
                <span>
                    Dipublikasikan
                    {{ \Carbon\Carbon::parse($jobVacancy['created_at'])->translatedFormat('d F Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- DESKRIPSI --}}
    <div class="card-box">
        <div class="section-title">
            Deskripsi Lowongan
        </div>

        <div class="detail-description">
            {!! nl2br(e($jobVacancy['description'])) !!}
        </div>
    </div>

    {{-- INFORMASI TAMBAHAN --}}
    @if (!empty($jobVacancy['expired_at']))
        <div class="card-box">
            <div class="section-title">
                Informasi Tambahan
            </div>

            <div class="badge-expired">
                Berlaku sampai
                {{ \Carbon\Carbon::parse($jobVacancy['expired_at'])->translatedFormat('d F Y') }}
            </div>
        </div>
    @endif

</div>
@endsection
