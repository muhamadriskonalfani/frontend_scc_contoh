@extends('layouts.app')

@section('title', 'Tracer Study')

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
</style>
@endsection

@section('header')
<div class="topbar">
    <div class="title-text">
        <span>🔥</span>
        <span>TRACER STUDY</span>
    </div>

    <div class="d-flex gap-3 align-items-center">
        <a href="#"><i data-feather="search"></i></a>
        <a href="#"><i data-feather="bell"></i></a>
    </div>
</div>
@endsection

@section('content')
<div class="content-offset container">

    {{-- USER INFO --}}
    <div class="card-box">
        <h6 class="mb-3 fw-bold">Tracer Study Anda</h6>

        <div class="user-info">
            <div>
                <span>User ID</span>
                <strong>{{ data_get($tracerStudy, 'user_id', '-') }}</strong>
            </div>
            <div>
                <span>Nama Lengkap</span>
                <strong>{{ data_get($tracerStudy, 'full_name', '-') }}</strong>
            </div>
            <div>
                <span>Nomor Induk Mahasiswa</span>
                <strong>{{ data_get($tracerStudy, 'student_id_number', '-') }}</strong>
            </div>
            <div>
                <span>Fakultas</span>
                <strong>{{ data_get($tracerStudy, 'faculty.name', '-') }}</strong>
            </div>
            <div>
                <span>Program Studi</span>
                <strong>{{ data_get($tracerStudy, 'study_program.name', '-') }}</strong>
            </div>
            <div>
                <span>Tahun Masuk</span>
                <strong>{{ data_get($tracerStudy, 'entry_year', '-') }}</strong>
            </div>
            <div>
                <span>Tahun Lulus</span>
                <strong>{{ data_get($tracerStudy, 'graduation_year', '-') }}</strong>
            </div>
            <div>
                <span>Domisili</span>
                <strong>{{ data_get($tracerStudy, 'domicile', '-') }}</strong>
            </div>
            <div>
                <span>Nomor WhatsApp</span>
                <strong>{{ data_get($tracerStudy, 'whatsapp_number', '-') }}</strong>
            </div>
            <div>
                <span>Tempat Bekerja</span>
                <strong>{{ data_get($tracerStudy, 'current_workplace', '-') }}</strong>
            </div>
            <div>
                <span>Lama Bekerja</span>
                <strong>{{ data_get($tracerStudy, 'current_job_duration_months', '-') }}</strong>
            </div>
            <div>
                <span>Skala Perusahaan</span>
                <strong>{{ data_get($tracerStudy, 'company_scale', '-') }}</strong>
            </div>
            <div>
                <span>Jabatan</span>
                <strong>{{ data_get($tracerStudy, 'job_title', '-') }}</strong>
            </div>
        </div>
    </div>

    {{-- LOGOUT --}}
    <div class="card-box">
        <a href="{{ route('tracer_study.update') }}" class="btn btn-logout w-100">
            Lengkapi Data
        </a>
    </div>

</div>
@endsection
