@extends('layouts.app')

@section('title', 'Lowongan Saya')

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
        padding-top: 10px;
        padding-bottom: 20px;
    }

    /* CARD */
    .apprenticeship-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 16px rgba(0,0,0,0.05);
        height: 100%;
        transition: all .2s;
        position: relative;
    }

    .apprenticeship-card:hover {
        transform: translateY(-3px);
    }

    .apprenticeship-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
        background: #eee;
    }

    .apprenticeship-body {
        padding: 12px;
    }

    .apprenticeship-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--fresh-blue);
        margin-bottom: 4px;
    }

    .apprenticeship-company {
        font-size: 12px;
        font-weight: 600;
        color: #333;
    }

    .apprenticeship-location {
        font-size: 11px;
        color: #777;
        margin-bottom: 6px;
    }

    .apprenticeship-date {
        font-size: 11px;
        color: #999;
        margin-top: 8px;
    }

    /* STATUS BADGE */
    .status-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        padding: 4px 8px;
        font-size: 10px;
        border-radius: 12px;
        color: #fff;
        text-transform: uppercase;
        font-weight: 600;
    }

    .status-pending { background: #f0ad4e; }
    .status-approved { background: #28a745; }
    .status-rejected { background: #dc3545; }
    .status-ended { background: #6c757d; }
</style>
@endsection

@section('header')
<div class="topbar">
    <div class="title-text">
        <span>💼</span>
        <span>LOWONGAN SAYA</span>
    </div>

    <div class="d-flex gap-3 align-items-center">
        <a href="{{ route('job_vacancy.create') }}">
            <i data-feather="plus"></i>
        </a>
        <a href="#">
            <i data-feather="search"></i>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    <div class="row g-3">

        @forelse ($jobVacancies as $item)
            <div class="col-6">
                <a href="{{ route('job_vacancy.show', $item['id']) }}"
                   class="text-decoration-none text-dark">

                    <div class="apprenticeship-card">

                        {{-- STATUS --}}
                        <div class="status-badge status-{{ $item['status'] }}">
                            {{ $item['status'] }}
                        </div>

                        {{-- IMAGE --}}
                        @if (!empty($item['image']))
                            <img src="{{ $item['image'] }}" class="apprenticeship-image">
                        @else
                            <div class="apprenticeship-image d-flex align-items-center justify-content-center text-muted">
                                <small>Tidak ada gambar</small>
                            </div>
                        @endif

                        {{-- BODY --}}
                        <div class="apprenticeship-body">
                            <div class="apprenticeship-title">
                                {{ $item['title'] }}
                            </div>

                            <div class="apprenticeship-company">
                                {{ $item['company_name'] }}
                            </div>

                            <div class="apprenticeship-location">
                                <i data-feather="map-pin" style="width:12px;height:12px;"></i>
                                {{ $item['location'] }}
                            </div>

                            <div class="apprenticeship-date">
                                Dibuat:
                                {{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d M Y') }}
                            </div>
                        </div>

                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted mt-4">
                Anda belum memiliki lowongan pekerjaan.
            </div>
        @endforelse

    </div>

</div>
@endsection
