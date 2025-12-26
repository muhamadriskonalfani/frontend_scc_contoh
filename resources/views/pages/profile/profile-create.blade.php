@extends('layouts.app')

@section('title', 'Buat Profil')

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

    /* FORM */
    .auth-form {
        padding: 10px 15px;
    }

    .auth-form label {
        font-size: 14px;
        margin-bottom: 6px;
        display: block;
        color: #444;
    }

    .auth-form .form-control {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        margin-bottom: 16px;
        font-size: 14px;
    }

    .auth-form button {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: none;
        background: var(--fresh-orange);
        color: #fff;
        font-size: 15px;
        font-weight: 500;
    }

    textarea {
        resize: none;
    }

    .preview-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 8px;
        display: none;
        border: 1px solid var(--border);
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <div class="title-text">
        <span>🔥</span>
        <span>BUAT PROFIL</span>
    </div>

    <div class="d-flex gap-3 align-items-center">
        <a href="#"><i data-feather="search"></i></a>
        <a href="#"><i data-feather="bell"></i></a>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset container">
    <!-- Alert -->
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Form Create Profile -->
    <div class="auth-form">
        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Foto Profil</label>
                <input type="file" class="form-control" 
                    name="image" accept="image/*" onchange="previewImage(this)">
            </div>

            <div class="mb-3">
                <label>No. Telepon</label>
                <input type="text" class="form-control"
                    name="phone" value="{{ old('phone') }}">
            </div>

            <div class="mb-3">
                <label>Bio</label>
                <textarea name="bio" rows="3" class="form-control">
                    {{ old('bio') }}
                </textarea>
            </div>
            
            <div class="mb-3">
                <label>Pendidikan</label>
                <textarea name="education" rows="2" class="form-control">
                    {{ old('education') }}
                </textarea>
            </div>
            
            <div class="mb-3">
                <label>Keahlian</label>
                <textarea name="skills" rows="2" class="form-control">
                    {{ old('skills') }}
                </textarea>
            </div>
            
            <div class="mb-3">
                <label>Pengalaman</label>
                <textarea name="experience" rows="3" class="form-control">
                    {{ old('experience') }}
                </textarea>
            </div>

            <div class="mb-3">
                <label>Testimoni</label>
                <textarea name="testimonial" rows="3" class="form-control">
                    {{ old('testimonial') }}
                </textarea>
            </div>

            <div class="mb-3">
                <label>LinkedIn URL</label>
                <input type="url" class="form-control"
                    name="linkedin_url" value="{{ old('linkedin_url') }}">
            </div>

            <div class="mb-3">
                <label>Upload CV (PDF)</label>
                <input type="file" class="form-control"
                    name="cv_file" accept="application/pdf">
            </div>

            <button type="submit" class="btn btn-light w-100">
                Simpan Profil
            </button>
        </form>
    </div>
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
