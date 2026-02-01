@extends('layouts.app')

@section('title', 'Info Magang')

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
       FILTER
    ========================== */
    .filter-box {
        background: var(--white);
        border-radius: 10px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid var(--border);
    }

    .filter-box input {
        border: none;
        outline: none;
        font-size: 13px;
        width: 100%;
        color: var(--text-dark);
    }

    .filter-box i {
        width: 16px;
        height: 16px;
        color: var(--text-muted);
    }

    /* =========================
       LIST ITEM
    ========================== */
    .apprenticeship-item {
        background: var(--white);
        border-radius: 12px;
        padding: 12px;
        display: flex;
        gap: 12px;
        border: 1px solid var(--border);
        transition: .2s;
    }

    .apprenticeship-item:hover {
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
        margin-bottom: 2px;
    }

    .item-company {
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 6px;
    }

    .item-meta {
        font-size: 11px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 4px;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>
    <div class="title">Info Magang</div>
</div>
@endsection

@section('content')
<div class="content-offset">

    {{-- FILTER TANGGAL --}}
    <div class="mb-3">
        <div class="filter-box">
            <i data-feather="calendar"></i>
            <input type="text" name="filter_date" placeholder="Filter Tanggal">
        </div>
    </div>

    {{-- LIST --}}
    <div class="d-flex flex-column gap-2">

        @forelse ($apprenticeships as $item)
            <a href="{{ route('apprenticeship.show', $item['id']) }}"
               class="text-decoration-none">

                <div class="apprenticeship-item">

                    {{-- IMAGE --}}
                    @if (!empty($item['image']))
                        <img src="{{ $item['image'] }}" class="item-image">
                    @else
                        <div class="item-image d-flex align-items-center justify-content-center text-muted">
                            <i data-feather="image"></i>
                        </div>
                    @endif

                    {{-- BODY --}}
                    <div class="item-body">
                        <div class="item-title">
                            {{ $item['title'] }}
                        </div>

                        <div class="item-company">
                            {{ $item['company_name'] }}
                        </div>

                        <div class="item-meta">
                            <i data-feather="map-pin" style="width: 15px; height: 15px;"></i>
                            {{ $item['location'] }}
                        </div>

                        <div class="item-meta">
                            <i data-feather="clock" style="width: 15px; height: 15px;"></i>
                            {{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d M Y') }}
                        </div>

                        @if(!empty($item['expired_at']))
                            <div class="item-meta">
                                <i data-feather="alert-circle" style="width: 15px; height: 15px;"></i>
                                Berakhir {{ \Carbon\Carbon::parse($item['expired_at'])->translatedFormat('d M Y') }}
                            </div>
                        @endif
                    </div>

                </div>
            </a>
        @empty
            <div class="text-center text-muted mt-4">
                Belum ada informasi magang.
            </div>
        @endforelse

    </div>

</div>
@endsection
