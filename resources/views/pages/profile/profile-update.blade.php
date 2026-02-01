@extends('layouts.app')

@section('title', 'Update Profile')

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
       CARD
    ========================== */
    .form-card {
        background: var(--white);
        border-radius: 14px;
        padding: 16px;
        margin: 16px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    }

    /* =========================
       PHOTO
    ========================== */
    .photo-wrapper {
        text-align: center;
        margin-bottom: 20px;
    }

    .photo-wrapper img {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid var(--border);
        margin-bottom: 10px;
    }

    .photo-wrapper input {
        font-size: 13px;
    }

    /* =========================
       FORM
    ========================== */
    .form-group {
        margin-bottom: 14px;
    }

    .form-group label {
        font-size: 12px;
        font-weight: 500;
        color: var(--text-muted);
        margin-bottom: 6px;
        display: block;
    }

    .form-group input,
    .form-group textarea {
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

    .file-info {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 6px;
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
    <div class="title">Update Profil</div>
</div>
@endsection

@section('content')
<div class="content-offset">

    {{-- ALERT --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-card">

            {{-- FOTO --}}
            <div class="photo-wrapper">
                <img
                    id="previewImage"
                    src="{{ $profile['image']
                        ? asset('storage/' . $profile['image'])
                        : asset('assets/img/noimage.jpg') }}"
                    alt="Foto Profil"
                >
                <input type="file" name="image" accept="image/*" onchange="previewImage(this)">
            </div>

            {{-- PHONE --}}
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="phone"
                       value="{{ old('phone', $profile['phone']) }}">
            </div>

            {{-- BIO --}}
            <div class="form-group">
                <label>Bio</label>
                <textarea name="bio" rows="3">{{ old('bio', $profile['bio']) }}</textarea>
            </div>

            {{-- EDUCATION --}}
            <div class="form-group">
                <label>Pendidikan</label>
                <textarea name="education" rows="2">{{ old('education', $profile['education']) }}</textarea>
            </div>

            {{-- SKILLS --}}
            <div class="form-group">
                <label>Keahlian</label>
                <textarea name="skills" rows="2">{{ old('skills', $profile['skills']) }}</textarea>
            </div>

            {{-- EXPERIENCE --}}
            <div class="form-group">
                <label>Pengalaman</label>
                <textarea name="experience" rows="3">{{ old('experience', $profile['experience']) }}</textarea>
            </div>

            {{-- TESTIMONIAL --}}
            <div class="form-group">
                <label>Testimoni</label>
                <textarea name="testimonial" rows="3">{{ old('testimonial', $profile['testimonial']) }}</textarea>
            </div>

            {{-- LINKEDIN --}}
            <div class="form-group">
                <label>LinkedIn URL</label>
                <input type="url" name="linkedin_url"
                       value="{{ old('linkedin_url', $profile['linkedin_url']) }}">
            </div>

            {{-- CV --}}
            <div class="form-group">
                <label>Upload CV (PDF)</label>
                <input type="file" name="cv_file" accept="application/pdf">

                @if (!empty($profile['cv_file']))
                    <div class="file-info">
                        CV saat ini:
                        <a href="{{ asset('storage/' . $profile['cv_file']) }}" target="_blank">
                            Lihat CV
                        </a>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn-save">
                Simpan Perubahan
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
        }
    }
</script>
@endsection
