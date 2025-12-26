@extends('layouts.app')

@section('title', 'Update Informasi Magang')

@section('styles')
<style>
    body {
        font-size: 14px;
        background: #f6f7fb;
    }

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

    .content-offset {
        padding-top: 10px;
        padding-bottom: 20px;
    }

    .profile-form-card {
        background: var(--white-box);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.05);
    }

    .form-group {
        margin-bottom: 14px;
    }

    .form-group label {
        font-size: 12px;
        font-weight: 500;
        color: #666;
        margin-bottom: 4px;
        display: block;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        border-radius: 8px;
        border: 1px solid var(--border);
        padding: 10px;
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
        background: var(--fresh-orange);
        color: #fff;
        font-size: 15px;
        font-weight: 500;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <div class="title-text">
        <span>✏️</span>
        <span>UPDATE MAGANG</span>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset">

    <form action="{{ route('apprenticeship.update', $apprenticeship['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="profile-form-card">

            {{-- TITLE --}}
            <div class="form-group">
                <label>Judul Magang</label>
                <input type="text" name="title"
                    value="{{ old('title', $apprenticeship['title']) }}" required>
            </div>

            {{-- COMPANY --}}
            <div class="form-group">
                <label>Nama Perusahaan</label>
                <input type="text" name="company_name"
                    value="{{ old('company_name', $apprenticeship['company_name']) }}" required>
            </div>

            {{-- LOCATION --}}
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="location"
                    value="{{ old('location', $apprenticeship['location']) }}" required>
            </div>

            {{-- DESCRIPTION --}}
            <div class="form-group">
                <label>Deskripsi Magang</label>
                <textarea name="description" rows="4" required>{{ old('description', $apprenticeship['description']) }}</textarea>
            </div>

            {{-- EXPIRED --}}
            <div class="form-group">
                <label>Tanggal Berakhir</label>
                <input type="date" name="expired_at"
                    value="{{ old('expired_at', $apprenticeship['expired_at']) }}">
            </div>

            <button type="submit" class="btn-orange">
                Update & Ajukan Ulang
            </button>
        </div>
    </form>

</div>
@endsection
