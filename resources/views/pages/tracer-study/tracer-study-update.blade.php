@extends('layouts.app')

@section('title', 'Update Tracer Study')

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
</style>
@endsection

@section('header')
<div class="topbar">
    <div class="title-text">
        <span>🔥</span>
        <span>UPDATE TRACER STUDY</span>
    </div>

    <div class="d-flex gap-3 align-items-center">
        <a href="#"><i data-feather="search"></i></a>
        <a href="#"><i data-feather="bell"></i></a>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    {{-- FORM TRACER STUDY --}}
    <div class="auth-form">
        <form action="{{ route('tracer_study.save_update') }}" method="POST">
            @csrf

            {{-- ======================
                DATA IDENTITAS (READONLY)
            ====================== --}}
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control"
                    value="{{ $tracerStudy['full_name'] ?? '-' }}"
                    disabled>
            </div>

            <div class="mb-3">
                <label>NIM</label>
                <input type="text" class="form-control"
                    value="{{ $tracerStudy['student_id_number'] ?? '-' }}"
                    disabled>
            </div>

            <div class="mb-3">
                <label>Fakultas</label>
                <input type="text" class="form-control"
                    value="{{ data_get($tracerStudy, 'faculty.name', '-') }}"
                    disabled>
            </div>

            <div class="mb-3">
                <label>Program Studi</label>
                <input type="text" class="form-control"
                    value="{{ data_get($tracerStudy, 'study_program.name', '-') }}"
                    disabled>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label>Tahun Masuk</label>
                    <input type="text" class="form-control"
                        value="{{ $tracerStudy['entry_year'] ?? '-' }}"
                        disabled>
                </div>
                <div class="col-6">
                    <label>Tahun Lulus</label>
                    <input type="text" class="form-control"
                        value="{{ $tracerStudy['graduation_year'] ?? '-' }}"
                        disabled>
                </div>
            </div>

            <hr>

            {{-- ======================
                DATA YANG BISA DIUBAH
            ====================== --}}
            <div class="mb-3">
                <label>Domicile</label>
                <input type="text" name="domicile"
                    value="{{ old('domicile', data_get($tracerStudy, 'domicile')) }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label>WhatsApp</label>
                <input type="text" name="whatsapp_number"
                    value="{{ old('whatsapp_number', data_get($tracerStudy, 'whatsapp_number')) }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tempat Kerja</label>
                <input type="text" name="current_workplace"
                    value="{{ old('current_workplace', data_get($tracerStudy, 'current_workplace')) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label>Lama Kerja (bulan)</label>
                <input type="number" name="current_job_duration_months"
                    value="{{ old('current_job_duration_months', data_get($tracerStudy, 'current_job_duration_months')) }}"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label>Skala Perusahaan</label>
                <select name="company_scale" class="form-control">
                    <option value="">- Pilih -</option>
                    <option value="local" @selected(old('company_scale', data_get($tracerStudy,'company_scale')) == 'local')>Lokal</option>
                    <option value="national" @selected(old('company_scale', data_get($tracerStudy,'company_scale')) == 'national')>Nasional</option>
                    <option value="international" @selected(old('company_scale', data_get($tracerStudy,'company_scale')) == 'international')>Internasional</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Jabatan</label>
                <input type="text" name="job_title"
                    value="{{ old('job_title', data_get($tracerStudy, 'job_title')) }}"
                    class="form-control">
            </div>

            <button class="btn btn-primary w-100">
                Simpan Perubahan
            </button>
        </form>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="text-danger text-center mt-3">
                {{ $errors->first() }}
            </div>
        @endif
    </div>

</div>
@endsection
