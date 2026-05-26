@extends('layouts.app')

@section('title', 'Detail Data')
@section('page-title', 'Detail Data')
@section('page-subtitle', 'Informasi lengkap data yang dipilih')

@php
    $userRole = auth()->user()->role ?? session('role', 'user');
    $isAdmin = $userRole === 'admin';

    $item = $data ?? [
        'id' => request()->route('id') ?? 1,
        'nama' => 'Produk Alpha',
        'kategori' => 'Elektronik',
        'status' => 'aktif',
        'deskripsi' => 'Ini adalah contoh deskripsi data untuk tampilan Progres I.',
        'tanggal' => '26 Mei 2026',
        'created_at' => '26 Mei 2026 10:30',
        'updated_at' => '26 Mei 2026 14:15',
    ];
@endphp

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle me-2 text-info"></i>Detail Data #{{ $item['id'] }}
                </h5>
                @if($isAdmin)
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('data.edit', $item['id']) }}" class="btn btn-outline-warning">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <button type="button"
                                class="btn btn-outline-danger btn-delete"
                                data-id="{{ $item['id'] }}"
                                data-name="{{ $item['nama'] }}"
                                data-url="{{ route('data.destroy', $item['id']) }}">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <dl class="row detail-list mb-0">
                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8">{{ $item['nama'] }}</dd>

                    <dt class="col-sm-4">Kategori</dt>
                    <dd class="col-sm-8">
                        <span class="badge bg-light text-dark">{{ $item['kategori'] }}</span>
                    </dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        @php $status = $item['status'] ?? 'aktif'; @endphp
                        <span class="badge {{ $status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($status) }}
                        </span>
                    </dd>

                    <dt class="col-sm-4">Tanggal</dt>
                    <dd class="col-sm-8">{{ $item['tanggal'] ?? '-' }}</dd>

                    <dt class="col-sm-4">Deskripsi</dt>
                    <dd class="col-sm-8">{{ $item['deskripsi'] ?? '-' }}</dd>

                    <dt class="col-sm-4">Dibuat</dt>
                    <dd class="col-sm-8 text-muted small">{{ $item['created_at'] ?? '-' }}</dd>

                    <dt class="col-sm-4">Diperbarui</dt>
                    <dd class="col-sm-8 text-muted small">{{ $item['updated_at'] ?? '-' }}</dd>
                </dl>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('data.index') }}" class="btn btn-light">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
