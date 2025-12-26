@extends('layouts.app')

@section('title', 'Info Kampus')

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

    /* CARD */
    .card-box {
        background: #fff;
        border-radius: 5px;
        padding: 16px;
        margin-bottom: 18px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.05);
    }

    .card-box h6 {
        color: var(--fresh-orange);
    }

    /* CARD INFO CAMPUS */
    .campus-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 16px rgba(0,0,0,0.05);
        height: 100%;
        transition: all .2s;
    }

    .campus-card:hover {
        transform: translateY(-3px);
    }

    .campus-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
        background: #eee;
    }

    .campus-body {
        padding: 12px;
    }

    .campus-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--fresh-orange);
        margin-bottom: 6px;
    }

    .campus-excerpt {
        font-size: 12px;
        color: #555;
        line-height: 1.4;
    }

    .campus-date {
        font-size: 11px;
        color: #999;
        margin-top: 8px;
    }

</style>
@endsection

@section('header')
<div class="topbar">
    <div class="title-text">
        <span>🔥</span>
        <span>INFO KAMPUS</span>
    </div>

    <div class="d-flex gap-3 align-items-center">
        <a href="#"><i data-feather="search"></i></a>
        <a href="#"><i data-feather="bell"></i></a>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    <div class="row g-3">

        @forelse ($informations as $info)
            <div class="col-6">
                <a href="{{ route('campus.info.show', $info['id']) }}"
                   class="text-decoration-none text-dark">

                    <div class="campus-card">
                        
                        {{-- IMAGE --}}
                        @if (!empty($info['image']))
                            <img src="{{ $info['image'] }}" class="campus-image">
                        @else
                            <div class="campus-image d-flex align-items-center justify-content-center text-muted">
                                <small>Tidak ada gambar</small>
                            </div>
                        @endif

                        {{-- BODY --}}
                        <div class="campus-body">
                            <div class="campus-title">
                                {{ $info['title'] }}
                            </div>

                            <div class="campus-excerpt">
                                {{ $info['excerpt'] }}
                            </div>

                            <div class="campus-date">
                                {{ $info['created_at'] }}
                            </div>
                        </div>

                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Tidak ada informasi kampus.
            </div>
        @endforelse

    </div>

</div>
@endsection
