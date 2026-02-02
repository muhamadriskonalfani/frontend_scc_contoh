@extends('layouts.app')

@section('title', 'Magang Saya')

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
       CARD ITEM
    ========================== */
    .apprenticeship-card {
        background: var(--white);
        border-radius: 14px;
        border: 1px solid var(--border);
        padding: 12px;
        display: flex;
        gap: 12px;
        margin-bottom: 12px;
    }

    /* IMAGE */
    .card-image {
        width: 72px;
        height: 72px;
        border-radius: 12px;
        object-fit: cover;
        background: #eee;
        flex-shrink: 0;
    }

    /* BODY */
    .card-body {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    .card-subtitle {
        font-size: 12px;
        color: var(--text-dark);
        margin-bottom: 6px;
    }

    .card-text {
        font-size: 11px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* =========================
       CARD FOOTER
    ========================== */
    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px dashed var(--border);
    }

    /* STATUS */
    .status-badge {
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 999px;
        font-weight: 600;
        text-transform: capitalize;
        color: #fff;
    }

    .status-pending { background: #f0ad4e; }
    .status-approved { background: #28a745; }
    .status-rejected { background: #dc3545; }
    .status-ended { background: #6c757d; }

    /* ACTIONS */
    .card-actions {
        display: flex;
        gap: 14px;
    }

    .card-actions a {
        color: var(--text-dark);
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ route('profile.career_info') }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>

    <div class="title">Magang Saya</div>

    <a href="{{ route('apprenticeship.create') }}" class="action-btn">
        <i data-feather="plus"></i>
    </a>
</div>
@endsection

@section('content')
<div class="content-offset">

    @forelse ($apprenticeships as $item)
        <div class="apprenticeship-card">

            {{-- IMAGE --}}
            @if (!empty($item['image']))
                <img src="{{ $item['image'] }}" class="card-image">
            @else
                <div class="card-image d-flex align-items-center justify-content-center text-muted">
                    <i data-feather="image"></i>
                </div>
            @endif

            {{-- BODY --}}
            <div class="card-body">

                <div class="card-title">
                    {{ $item['title'] }}
                </div>

                <div class="card-subtitle">
                    {{ $item['company_name'] }}
                </div>

                <div class="card-text">
                    <i data-feather="map-pin" style="width: 15px;"></i>
                    {{ $item['location'] }}
                </div>

                <div class="card-text">
                    <i data-feather="clock" style="width: 15px;"></i>
                    Dibuat {{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d M Y') }}
                </div>

                {{-- FOOTER --}}
                <div class="card-footer">
                    <span class="status-badge status-{{ $item['status'] }}">
                        {{ $item['status'] }}
                    </span>

                    <div class="card-actions">
                        <a href="{{ route('apprenticeship.show', $item['id']) }}" title="Detail">
                            <i data-feather="eye" style="width: 20px;"></i>
                        </a>

                        <a href="{{ route('apprenticeship.edit', $item['id']) }}" title="Edit">
                            <i data-feather="edit-2" style="width: 20px;"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    @empty
        <div class="text-center text-muted mt-4">
            Anda belum memiliki data magang.
        </div>
    @endforelse

</div>
@endsection
