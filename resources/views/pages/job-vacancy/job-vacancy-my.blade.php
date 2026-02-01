@extends('layouts.app')

@section('title', 'Lowongan Saya')

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
        padding: 16px;
        padding-top: 75px;
    }

    /* =========================
       LIST ITEM
    ========================== */
    .my-job-item {
        background: var(--white);
        border-radius: 12px;
        padding: 12px;
        display: flex;
        gap: 12px;
        border: 1px solid var(--border);
        transition: .2s;
        position: relative;
    }

    .my-job-item:hover {
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

    .item-meta i {
        width: 12px;
        height: 12px;
    }

    /* =========================
       STATUS BADGE
    ========================== */
    .status-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 10px;
        padding: 3px 8px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        color: #fff;
    }

    .status-pending { background: #f0ad4e; }
    .status-approved { background: #28a745; }
    .status-rejected { background: #dc3545; }
    .status-ended { background: #6c757d; }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>

    <div class="title">Lowongan Saya</div>

    <a href="{{ route('job_vacancy.create') }}" class="action-btn">
        <i data-feather="plus"></i>
    </a>
</div>
@endsection

@section('content')
<div class="content-offset">

    <div class="d-flex flex-column gap-2">

        @forelse ($jobVacancies as $item)
            <a href="{{ route('job_vacancy.show', $item['id']) }}"
               class="text-decoration-none">

                <div class="my-job-item">

                    {{-- STATUS --}}
                    <div class="status-badge status-{{ $item['status'] }}">
                        {{ $item['status'] }}
                    </div>

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
                            Dibuat {{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d M Y') }}
                        </div>
                    </div>

                </div>
            </a>
        @empty
            <div class="text-center text-muted mt-4">
                Anda belum memiliki lowongan pekerjaan.
            </div>
        @endforelse

    </div>

</div>
@endsection
