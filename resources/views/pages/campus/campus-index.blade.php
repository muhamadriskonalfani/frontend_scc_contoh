@extends('layouts.app')

@section('title', 'Info Kampus')

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
        z-index: 999;
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
       LIST ITEM
    ========================== */
    .campus-item {
        background: var(--white);
        border-radius: 12px;
        padding: 12px;
        display: flex;
        gap: 12px;
        border: 1px solid var(--border);
        transition: .2s;
    }

    .campus-item:hover {
        background: #f9fafb;
    }

    .item-image {
        width: 64px;
        height: 64px;
        border-radius: 10px;
        object-fit: cover;
        background: #eee;
        flex-shrink: 0;
    }

    .item-body {
        flex: 1;
        min-width: 0;
    }

    .item-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.3;
        margin-bottom: 4px;
    }

    .item-excerpt {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.4;
        margin-bottom: 6px;
    }

    .item-meta {
        font-size: 11px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .item-meta i {
        width: 12px;
        height: 12px;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ route('dashboard.index') }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>

    <div class="title">Info Kampus</div>

    <a href="#" class="action-btn">
        <i data-feather="search"></i>
    </a>
</div>
@endsection

@section('content')
<div class="content-offset">

    <div class="d-flex flex-column gap-2">

        @forelse ($informations as $info)
            <a href="{{ route('campus.info.show', $info['id']) }}"
               class="text-decoration-none">

                <div class="campus-item">

                    {{-- IMAGE --}}
                    @if (!empty($info['image']))
                        <img src="{{ $info['image'] }}" class="item-image">
                    @else
                        <div class="item-image d-flex align-items-center justify-content-center text-muted">
                            <i data-feather="image"></i>
                        </div>
                    @endif

                    {{-- BODY --}}
                    <div class="item-body">
                        <div class="item-title">
                            {{ $info['title'] }}
                        </div>

                        <div class="item-excerpt">
                            {{ $info['excerpt'] }}
                        </div>

                        <div class="item-meta">
                            <i data-feather="clock" style="width: 15px; height: 15px;"></i>
                            {{ \Carbon\Carbon::parse($info['created_at'])->translatedFormat('d M Y') }}
                        </div>
                    </div>

                </div>
            </a>
        @empty
            <div class="text-center text-muted mt-4">
                Tidak ada informasi kampus.
            </div>
        @endforelse

    </div>

</div>
@endsection
