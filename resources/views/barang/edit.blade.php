@extends('layouts.app')

@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang')
@section('page-subtitle', 'Perbarui informasi barang yang dipilih')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title mb-0">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Form Edit Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.update', $barang) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('kode_barang') is-invalid @enderror"
                               id="kode_barang"
                               name="kode_barang"
                               value="{{ old('kode_barang', $barang->kode_barang) }}"
                               required>
                        @error('kode_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('nama_barang') is-invalid @enderror"
                               id="nama_barang"
                               name="nama_barang"
                               value="{{ old('nama_barang', $barang->nama_barang) }}"
                               required>
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select @error('kategori') is-invalid @enderror"
                                id="kategori"
                                name="kategori"
                                required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach(['Elektronik', 'Fashion', 'Makanan', 'Olahraga'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $barang->kategori) === $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number"
                                   class="form-control @error('stok') is-invalid @enderror"
                                   id="stok"
                                   name="stok"
                                   value="{{ old('stok', $barang->stok) }}"
                                   min="0"
                                   required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number"
                                   class="form-control @error('harga') is-invalid @enderror"
                                   id="harga"
                                   name="harga"
                                   value="{{ old('harga', $barang->harga) }}"
                                   min="0"
                                   step="0.01"
                                   required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bi bi-check-lg me-1"></i>Perbarui
                        </button>
                        <a href="{{ route('barang.index') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
