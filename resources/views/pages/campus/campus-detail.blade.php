@extends('layouts.app')

@section('title', 'Detail Info Kampus')

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
        align-items: center;
        gap: 5px;
        background: var(--white-box);
        z-index: 999;
        border-bottom: 1px solid #eee;
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

    /* DETAIL CARD */
    .detail-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .detail-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #eee;
    }

    .detail-body {
        padding: 16px;
    }

    .detail-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--fresh-orange);
        margin-bottom: 6px;
        line-height: 1.3;
    }

    .detail-date {
        font-size: 12px;
        color: #999;
        margin-bottom: 12px;
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
    <a href="{{ route('campus.info.index') }}" class="text-decoration-none text-dark">
        <i data-feather="arrow-left" style="color: var(--fresh-orange);"></i>
    </a>

    <div class="title-text">
        <span>INFO KAMPUS</span>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    <div class="detail-card">

        {{-- IMAGE --}}
        @if (!empty($information['image']))
            <img src="{{ $information['image'] }}" class="detail-image">
        @else
            <div class="detail-image d-flex align-items-center justify-content-center text-muted">
                <small>Tidak ada gambar</small>
            </div>
        @endif

        {{-- BODY --}}
        <div class="detail-body">
            <div class="detail-title">
                {{ $information['title'] }}
            </div>

            <div class="detail-date">
                Dipublikasikan {{ $information['created_at'] }}
            </div>

            <div class="detail-description">
                {!! nl2br(e($information['description'])) !!}
            </div>
        </div>

    </div>

</div>
@endsection
