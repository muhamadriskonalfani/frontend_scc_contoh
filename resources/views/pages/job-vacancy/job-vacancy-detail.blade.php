@extends('layouts.app')

@section('title', 'Detail Lowongan')

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
        border-bottom: 1px solid #eee;
    }

    .topbar .title-text {
        color: var(--fresh-blue);
        font-weight: 700;
        font-size: 18px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .topbar a {
        color: var(--fresh-blue);
    }

    .content-offset {
        padding-top: 70px;
        padding-bottom: 20px;
    }

    /* DETAIL CARD */
    .detail-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .detail-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        background: #eee;
    }

    .detail-body {
        padding: 16px;
    }

    .detail-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--fresh-blue);
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .detail-meta {
        font-size: 13px;
        color: #666;
        margin-bottom: 12px;
    }

    .detail-meta div {
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .detail-description {
        font-size: 14px;
        line-height: 1.7;
        color: #444;
        margin-top: 10px;
    }

    .badge-expired {
        display: inline-block;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 8px;
        background: #fff3cd;
        color: #856404;
        margin-top: 10px;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <div class="d-flex gap-2 align-items-center">
        <a href="{{ route('job_vacancy.index') }}" class="text-decoration-none">
            <i data-feather="arrow-left"></i>
        </a>
        <div class="title-text">
            <span>DETAIL LOWONGAN</span>
        </div>
    </div>

    <div class="d-flex gap-3 align-items-center">
        @if ($jobVacancy['created_by'] === session('auth.user.id'))
            <a href="{{ route('job_vacancy.edit', $jobVacancy['id']) }}">
                <i data-feather="edit-2"></i>
            </a>
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    <div class="detail-card">

        {{-- IMAGE --}}
        @if (!empty($jobVacancy['image']))
            <img src="{{ $jobVacancy['image'] }}" class="detail-image">
        @else
            <div class="detail-image d-flex align-items-center justify-content-center text-muted">
                <small>Tidak ada gambar</small>
            </div>
        @endif

        {{-- BODY --}}
        <div class="detail-body">

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

            @if (!empty($jobVacancy['expired_at']))
                <div class="badge-expired">
                    Berlaku sampai
                    {{ \Carbon\Carbon::parse($jobVacancy['expired_at'])->translatedFormat('d F Y') }}
                </div>
            @endif

            <div class="detail-description">
                {!! nl2br(e($jobVacancy['description'])) !!}
            </div>

        </div>

    </div>

</div>
@endsection
