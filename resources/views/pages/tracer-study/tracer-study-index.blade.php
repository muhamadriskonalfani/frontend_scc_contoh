@extends('layouts.app')

@section('title', 'Tracer Study')

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

    .topbar .title {
        font-size: 17px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .topbar .back-btn {
        position: absolute;
        left: 16px;
        color: var(--text-dark);
    }

    /* =========================
        CONTENT
    ========================== */
    .content-wrapper {
        padding: 16px;
        padding-top: 75px;
    }

    /* CARD */
    .card-box {
        background: var(--white);
        border-radius: 8px;
        padding: 14px;
        margin-bottom: 14px;
        border: 1px solid var(--border);
    }

    .card-title {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--text-dark);
    }

    /* INFO LIST */
    .info-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        font-size: 13px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 8px;
        border-bottom: 1px dashed var(--border);
    }

    .info-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-label {
        color: var(--text-muted);
        max-width: 45%;
    }

    .info-value {
        font-weight: 500;
        color: var(--text-dark);
        text-align: right;
    }

    /* BUTTON */
    .btn-update {
        width: 100%;
        height: 44px;
        border-radius: 8px;
        border: none;
        background: linear-gradient(90deg, var(--blue), var(--blue-dark));
        color: #fff;
        font-weight: 500;
        font-size: 14px;
    }
</style>
@endsection

@section('header')
<div class="topbar">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i data-feather="chevron-left"></i>
    </a>
    <div class="title">Tracer Study</div>
</div>
@endsection

@section('content')
<div class="content-wrapper">

    {{-- CARD DATA TRACER --}}
    <div class="card-box">
        <div class="card-title">Data Tracer Study Anda</div>

        <div class="info-list">

            <div class="info-item">
                <div class="info-label">User ID</div>
                <div class="info-value">{{ data_get($tracerStudy, 'user_id', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value">{{ data_get($tracerStudy, 'full_name', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">NIM</div>
                <div class="info-value">{{ data_get($tracerStudy, 'student_id_number', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Fakultas</div>
                <div class="info-value">{{ data_get($tracerStudy, 'faculty.name', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Program Studi</div>
                <div class="info-value">{{ data_get($tracerStudy, 'study_program.name', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Tahun Masuk</div>
                <div class="info-value">{{ data_get($tracerStudy, 'entry_year', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Tahun Lulus</div>
                <div class="info-value">{{ data_get($tracerStudy, 'graduation_year', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Domisili</div>
                <div class="info-value">{{ data_get($tracerStudy, 'domicile', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">WhatsApp</div>
                <div class="info-value">{{ data_get($tracerStudy, 'whatsapp_number', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Tempat Bekerja</div>
                <div class="info-value">{{ data_get($tracerStudy, 'current_workplace', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Lama Bekerja</div>
                <div class="info-value">
                    {{ data_get($tracerStudy, 'current_job_duration_months', '-') }} bulan
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Skala Perusahaan</div>
                <div class="info-value">{{ data_get($tracerStudy, 'company_scale', '-') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Jabatan</div>
                <div class="info-value">{{ data_get($tracerStudy, 'job_title', '-') }}</div>
            </div>

        </div>
    </div>

    {{-- ACTION --}}
    <div class="card-box p-0">
        <a href="{{ route('tracer_study.update') }}" class="btn btn-primary w-100 py-2">
            Lengkapi / Perbarui Data
        </a>
    </div>

</div>
@endsection
