@extends('layouts.app')

@section('title', 'Beranda')

@section('styles')
<style>
    .orange-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        padding: 10px;
        background: var(--white-box);
        background-image: url("{{ asset('assets/img/Animated Shape.svg') }}");
        background-repeat: repeat;
        background-size: 350px;
        border-bottom: 1px solid var(--border);
        z-index: 999;
    }

    .search-box input {
        background: var(--white-box);
        padding-left: 40px;
        border-radius: 10px;
        font-size: 14px;
    }

    .content-offset {
        padding-top: 0;
    }

    /* FEATURES */
    .menu-item {
        min-width: 67px;
        width: 67px;
        max-height: 80px;
        text-align: center;
        flex-shrink: 0;
    }

    .menu-item img {
        width: 35px;
        margin: 4px 0;
        /* border: 1px solid var(--border);
        border-radius: 2px; */
    }

    .menu-item-title {
        font-size: 10px;
        line-height: 1.2;
    }

    /* FLASH SALE */
    .horizontal-scroll {
        display: flex;
        gap: 10px;
        overflow-x: auto;
    }

    .horizontal-scroll::-webkit-scrollbar {
        display: none;
    }

    .product-card {
        width: 120px;
        background: var(--white-box);
        border-radius: 2px;
        overflow: hidden;
        border: 1px solid var(--border);
        flex-shrink: 0;
    }

    .product-name {
        font-size: 12px;
    }

    .product-price {
        color: var(--fresh-orange);
        font-weight: 700;
        font-size: 13px;
    }

    /* CATEGORY */
    .category-item {
        min-width: 107px;
        text-align: center;
        margin-bottom: 15px;
        flex-shrink: 0;
    }

    .category-item img {
        width: 107px;
        height: 107px;
        object-fit: contain;
    }

    .category-item div {
        font-size: 11px;
        margin-top: 4px;
    }
</style>
@endsection

@section('header')
<div class="orange-header">
    <div class="d-flex align-items-center">
        <div class="position-relative grow">
            <i data-feather="search" class="position-absolute ms-2"
                style="top:50%;transform:translateY(-50%);color:var(--fresh-orange);">
            </i>
            <input type="text" class="form-control ps-5" placeholder="Cari barang murah...">
        </div>

        <a href="" class="ms-3" style="color: var(--fresh-orange);">
            <i data-feather="shopping-cart"></i>
        </a>
        <a href="" class="ms-3" style="color: var(--fresh-orange);">
            <i data-feather="message-circle"></i>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset">

    <div class="mb-3">
        {{ session('auth.token') }}
    </div>

    <div class="mb-3">
        <ul>
            <li>{{ session('auth.user.id') }}</li>
            <li>{{ session('auth.user.name') }}</li>
            <li>{{ session('auth.user.email') }}</li>
            <li>{{ session('auth.user.role') }}</li>
            <li>{{ session('auth.user.status') }}</li>
        </ul>
    </div>

</div>
@endsection
