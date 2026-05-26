@extends('layouts.auth')

@section('title', 'Akses Ditolak')

@section('content')
<div class="auth-card">
    <div class="auth-card-header text-center">
        <div class="auth-logo bg-danger-subtle text-danger">
            <i class="bi bi-shield-x"></i>
        </div>
        <h2 class="auth-title">403 — Akses Ditolak</h2>
        <p class="auth-subtitle">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    </div>
    <div class="auth-card-body text-center">
        <p class="text-muted mb-4">
            {{ $exception->getMessage() ?: 'Halaman ini hanya dapat diakses oleh role yang sesuai.' }}
        </p>
        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('login') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>
@endsection
