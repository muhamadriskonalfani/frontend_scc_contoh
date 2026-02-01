@extends('layouts.app')

@section('title', 'Detail Info Kampus')

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

    .topbar .action-btn {
        position: absolute;
        right: 16px;
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
        color: var(--fresh-orange);
        line-height: 1.4;
        margin-bottom: 6px;
    }

    .detail-date {
        font-size: 12px;
        color: #999;
    }

    /* SECTION */
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

    .detail-description p {
        margin-bottom: 12px;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ route('campus.info.index') }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>

    <div class="title">Detail Info Kampus</div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    {{-- IMAGE --}}
    @if (!empty($information['image']))
        <img src="{{ $information['image'] }}" class="detail-image mb-3">
    @else
        <div class="detail-image d-flex align-items-center justify-content-center text-muted mb-3">
            <small>Tidak ada gambar</small>
        </div>
    @endif

    {{-- INFO UTAMA --}}
    <div class="card-box">
        <div class="detail-title">
            {{ $information['title'] }}
        </div>

        <div class="detail-date">
            Dipublikasikan
            {{ \Carbon\Carbon::parse($information['created_at'])->translatedFormat('d F Y') }}
        </div>
    </div>

    {{-- DESKRIPSI --}}
    <div class="card-box">
        <div class="section-title">
            Deskripsi Informasi
        </div>

        <div class="detail-description">
            {!! nl2br(e($information['description'])) !!}
        </div>
    </div>

</div>
@endsection
