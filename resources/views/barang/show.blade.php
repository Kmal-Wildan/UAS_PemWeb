@extends('layouts.app')

@php
    $isAdmin = auth()->user()->isAdmin();
@endphp

@section('title', 'Detail Barang')
@section('page-title', 'Detail Barang')
@section('page-subtitle', 'Informasi lengkap barang yang dipilih')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle me-2 text-info"></i>Detail Barang #{{ $barang->id }}
                </h5>
                @if($isAdmin)
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('barang.edit', $barang) }}" class="btn btn-outline-warning">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <button type="button"
                                class="btn btn-outline-danger btn-delete"
                                data-id="{{ $barang->id }}"
                                data-name="{{ $barang->nama_barang }}"
                                data-url="{{ route('barang.destroy', $barang) }}">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <dl class="row detail-list mb-0">
                    <dt class="col-sm-4">Kode Barang</dt>
                    <dd class="col-sm-8"><code>{{ $barang->kode_barang }}</code></dd>

                    <dt class="col-sm-4">Nama Barang</dt>
                    <dd class="col-sm-8">{{ $barang->nama_barang }}</dd>

                    <dt class="col-sm-4">Kategori</dt>
                    <dd class="col-sm-8">
                        <span class="badge bg-light text-dark">{{ $barang->kategori }}</span>
                    </dd>

                    <dt class="col-sm-4">Stok</dt>
                    <dd class="col-sm-8">{{ number_format($barang->stok, 0, ',', '.') }} unit</dd>

                    <dt class="col-sm-4">Harga</dt>
                    <dd class="col-sm-8">{{ $barang->harga_formatted }}</dd>

                    <dt class="col-sm-4">Total Nilai</dt>
                    <dd class="col-sm-8">
                        Rp {{ number_format($barang->stok * $barang->harga, 0, ',', '.') }}
                    </dd>

                    <dt class="col-sm-4">Dibuat</dt>
                    <dd class="col-sm-8 text-muted small">{{ $barang->created_at->format('d M Y H:i') }}</dd>

                    <dt class="col-sm-4">Diperbarui</dt>
                    <dd class="col-sm-8 text-muted small">{{ $barang->updated_at->format('d M Y H:i') }}</dd>
                </dl>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="{{ route('barang.index') }}" class="btn btn-light">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
