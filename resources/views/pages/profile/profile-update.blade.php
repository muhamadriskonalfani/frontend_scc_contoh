@extends('layouts.app')

@section('title', 'Update Profile')

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

    /* USER INFO */
    .user-info div {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px dashed #eee;
        font-size: 13px;
    }

    .user-info div:last-child {
        border-bottom: none;
    }

    /* LOGOUT */
    .btn-logout {
        background: var(--fresh-orange);
        color: #fff;
        border-radius: 12px;
        padding: 12px;
        font-weight: 500;
        border: none;
    }

    .profile-form-card {
        background: var(--white-box);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
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

    .preview-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 8px;
        border: 1px solid var(--border);
    }

    .file-info {
        font-size: 12px;
        color: #777;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <div class="title-text">
        <span>🔥</span>
        <span>UPDATE PROFILE</span>
    </div>

    <div class="d-flex gap-3 align-items-center">
        <a href="#"><i data-feather="search"></i></a>
        <a href="#"><i data-feather="bell"></i></a>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset">

    {{-- ALERT --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="profile-form-card">

            {{-- FOTO --}}
            <div class="form-group text-center">
                <img
                    id="previewImage"
                    class="preview-img"
                    src="{{ $profile['image']
                            ? asset('storage/' . $profile['image'])
                            : asset('assets/img/noimage.jpg') }}"
                >
                <label class="text-start">Ganti Foto Profil</label>
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
                    <div class="file-info mt-1">
                        CV saat ini:
                        <a href="{{ asset('storage/' . $profile['cv_file']) }}" target="_blank">
                            Lihat CV
                        </a>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-light btn-orange w-100">
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
