@extends('layouts.app')

@section('title', 'Buat Profil')

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
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .topbar .back-btn {
        position: absolute;
        left: 16px;
        color: var(--text-dark);
    }

    .topbar .title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .content-offset {
        padding: 65px 0px 0px;
    }

    /* =========================
       FORM CARD
    ========================== */
    .profile-form-card {
        background: var(--white);
        border-radius: 14px;
        padding: 16px;
        margin: 16px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    }

    .form-group {
        margin-bottom: 14px;
    }

    .form-group label {
        font-size: 13px;
        font-weight: 500;
        color: var(--text-muted);
        margin-bottom: 6px;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border-radius: 10px;
        border: 1px solid var(--border);
        font-size: 14px;
    }

    .form-control:focus {
        border-color: var(--blue);
        box-shadow: none;
    }

    textarea {
        resize: none;
    }

    /* =========================
       FOTO PROFIL
    ========================== */
    .photo-wrapper {
        text-align: center;
        margin-bottom: 16px;
    }

    .preview-img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid var(--border);
        margin-bottom: 8px;
        display: none;
    }

    /* =========================
       BUTTON
    ========================== */
    .btn-save {
        width: 100%;
        height: 44px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(90deg, var(--blue), var(--blue-dark));
        color: #fff;
        font-size: 15px;
        font-weight: 500;
        margin-top: 8px;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ route('profile.index') }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>
    <div class="title">Buat Profil</div>
</div>
@endsection

@section('content')
<div class="content-offset">
    {{-- ALERT --}}
    @if (session('error'))
        <div class="alert alert-danger mx-3 mt-3">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="profile-form-card">

            {{-- FOTO --}}
            <div class="photo-wrapper">
                <img id="previewImage"
                    class="preview-img"
                    src="{{ asset('assets/img/noimage.jpg') }}">
                <div class="form-group">
                    <label>Foto Profil</label>
                    <input type="file"
                        name="image"
                        class="form-control"
                        accept="image/*"
                        onchange="previewImage(this)">
                </div>
            </div>

            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text"
                    name="phone"
                    class="form-control"
                    value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label>Bio</label>
                <textarea name="bio" rows="3" class="form-control">{{ old('bio') }}</textarea>
            </div>

            <div class="form-group">
                <label>Pendidikan</label>
                <textarea name="education" rows="2" class="form-control">{{ old('education') }}</textarea>
            </div>

            <div class="form-group">
                <label>Keahlian</label>
                <textarea name="skills" rows="2" class="form-control">{{ old('skills') }}</textarea>
            </div>

            <div class="form-group">
                <label>Pengalaman</label>
                <textarea name="experience" rows="3" class="form-control">{{ old('experience') }}</textarea>
            </div>

            <div class="form-group">
                <label>Testimoni</label>
                <textarea name="testimonial" rows="3" class="form-control">{{ old('testimonial') }}</textarea>
            </div>

            <div class="form-group">
                <label>LinkedIn URL</label>
                <input type="url"
                    name="linkedin_url"
                    class="form-control"
                    value="{{ old('linkedin_url') }}">
            </div>

            <div class="form-group">
                <label>Upload CV (PDF)</label>
                <input type="file"
                    name="cv_file"
                    class="form-control"
                    accept="application/pdf">
            </div>

            <button type="submit" class="btn-save">
                Simpan Profil
            </button>

        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(input) {
        const img = document.getElementById('previewImage');
        if (input.files && input.files[0]) {
            img.src = URL.createObjectURL(input.files[0]);
            img.style.display = 'inline-block';
        }
    }
</script>
@endsection
