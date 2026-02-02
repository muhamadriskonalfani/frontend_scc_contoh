@extends('layouts.app')

@section('title', 'Tambah Informasi Magang')

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
       FORM CARD
    ========================== */
    .profile-form-card {
        padding: 10px 15px;
    }

    .form-group {
        margin-bottom: 14px;
    }

    .form-group label {
        font-size: 14px;
        margin-bottom: 6px;
        display: block;
        color: #444;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid var(--border);
        margin-bottom: 16px;
        font-size: 14px;
    }

    textarea {
        resize: none;
    }

    .btn-orange {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: none;
        background: var(--blue);
        color: #fff;
        font-size: 15px;
        font-weight: 500;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ route('apprenticeship.my') }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>
    <div class="title">Tambah Info Magang</div>
</div>
@endsection

@section('content')
<div class="content-offset">

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('apprenticeship.store') }}" method="POST">
        @csrf

        <div class="profile-form-card">

            {{-- TITLE --}}
            <div class="form-group">
                <label>Judul Magang</label>
                <input type="text" name="title" value="{{ old('title') }}" required>
            </div>

            {{-- COMPANY --}}
            <div class="form-group">
                <label>Nama Perusahaan</label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" required>
            </div>

            {{-- LOCATION --}}
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="location" value="{{ old('location') }}" required>
            </div>

            {{-- DESCRIPTION --}}
            <div class="form-group">
                <label>Deskripsi Magang</label>
                <textarea name="description" rows="4" required>{{ old('description') }}</textarea>
            </div>

            {{-- EXPIRED --}}
            <div class="form-group">
                <label>Tanggal Berakhir (Opsional)</label>
                <input type="date" name="expired_at" value="{{ old('expired_at') }}">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4">
                Simpan Informasi Magang
            </button>
        </div>
    </form>

</div>
@endsection
