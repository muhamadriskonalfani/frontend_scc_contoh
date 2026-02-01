@extends('layouts.app')

@section('title', 'Detail Magang')

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

    /* =========================
        CARD
    ========================== */
    .detail-card {
        background: #fff;
        border-radius: 14px;
        padding: 16px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.05);
        margin-top: -40px;
        position: relative;
        z-index: 2;
    }

    .detail-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .detail-company {
        font-size: 13px;
        color: #666;
        margin-bottom: 12px;
    }

    .detail-meta {
        font-size: 12px;
        color: #777;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .detail-meta div {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .detail-meta i {
        width: 14px;
        height: 14px;
    }

    .badge-expired {
        display: inline-block;
        margin-top: 12px;
        font-size: 11px;
        padding: 5px 10px;
        border-radius: 20px;
        background: #fff3cd;
        color: #856404;
        font-weight: 600;
    }

    /* =========================
        SECTION
    ========================== */
    .section-box {
        background: #fff;
        border-radius: 14px;
        padding: 16px;
        margin-top: 12px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.04);
    }

    .section-title {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .section-title i {
        width: 16px;
        height: 16px;
        color: var(--text-dark);
    }

    .section-content {
        font-size: 14px;
        line-height: 1.7;
        color: #444;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ route('apprenticeship.index') }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>

    <div class="title">Detail Magang</div>

    @if ($apprenticeship['created_by'] === session('auth.user.id'))
        <a href="{{ route('apprenticeship.edit', $apprenticeship['id']) }}" class="action-btn">
            <i data-feather="edit-2"></i>
        </a>
    @endif
</div>
@endsection

@section('content')
<div class="content-offset container">

    {{-- IMAGE --}}
    @if (!empty($apprenticeship['image']))
        <img src="{{ $apprenticeship['image'] }}" class="detail-image">
    @else
        <div class="detail-image d-flex align-items-center justify-content-center text-muted">
            <small>Tidak ada gambar</small>
        </div>
    @endif

    {{-- MAIN INFO --}}
    <div class="detail-card">

        <div class="detail-title">
            {{ $apprenticeship['title'] }}
        </div>

        <div class="detail-company">
            {{ $apprenticeship['company_name'] }}
        </div>

        <div class="detail-meta">
            <div>
                <i data-feather="map-pin"></i>
                {{ $apprenticeship['location'] }}
            </div>

            <div>
                <i data-feather="calendar"></i>
                Dipublikasikan
                {{ \Carbon\Carbon::parse($apprenticeship['created_at'])->translatedFormat('d F Y') }}
            </div>
        </div>

        @if (!empty($apprenticeship['expired_at']))
            <div class="badge-expired">
                Berlaku sampai
                {{ \Carbon\Carbon::parse($apprenticeship['expired_at'])->translatedFormat('d F Y') }}
            </div>
        @endif
    </div>

    {{-- DESCRIPTION --}}
    <div class="section-box">
        <div class="section-title">
            <i data-feather="file-text"></i>
            Deskripsi Magang
        </div>

        <div class="section-content">
            {!! nl2br(e($apprenticeship['description'])) !!}
        </div>
    </div>

</div>
@endsection
