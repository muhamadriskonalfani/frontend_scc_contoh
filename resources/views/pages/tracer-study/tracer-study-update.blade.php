@extends('layouts.app')

@section('title', 'Update Tracer Study')

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
    .form-card {
        padding: 10px 15px;
    }

    .form-card label {
        font-size: 14px;
        margin-bottom: 6px;
        display: block;
        color: #444;
    }

    .form-card .form-control {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        margin-bottom: 16px;
        font-size: 14px;
    }

    /* =========================
       BUTTON
    ========================== */
    .btn-primary {
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 15px;
        font-weight: 500;
    }

    .btn-primary:active {
        background: var(--blue-dark);
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>
    <div class="title">Update Tracer Study</div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    {{-- FORM TRACER STUDY --}}
    <div class="form-card">
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

            <button class="btn btn-primary w-100 mt-4">
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
