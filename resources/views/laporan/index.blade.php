@extends('layouts.app')

@php
    $isAdmin = auth()->user()->isAdmin();
@endphp

@section('title', 'Laporan')
@section('page-title', 'Laporan Barang')
@section('page-subtitle', $isAdmin ? 'Lihat dan export laporan data barang' : 'Lihat laporan data barang (read-only)')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Barang</p>
                <h3 class="stat-value">{{ number_format($stats['total_barang']) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="bi bi-tags"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Kategori</p>
                <h3 class="stat-value">{{ number_format($stats['total_kategori']) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="bi bi-stack"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Stok</p>
                <h3 class="stat-value">{{ number_format($stats['total_stok']) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-warning">
            <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Nilai Barang</p>
                <h3 class="stat-value">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-0 py-3">
        <h5 class="card-title mb-0"><i class="bi bi-pie-chart me-2"></i>Ringkasan per Kategori</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kategori</th>
                        <th>Jumlah Barang</th>
                        <th>Total Stok</th>
                        <th>Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporanPerKategori as $row)
                        <tr>
                            <td><span class="badge bg-light text-dark">{{ $row->kategori }}</span></td>
                            <td>{{ $row->jumlah }}</td>
                            <td>{{ number_format($row->total_stok) }}</td>
                            <td>Rp {{ number_format($row->total_nilai, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 py-3">
        <form method="GET" action="{{ route('laporan.index') }}" class="row align-items-end g-3">
            <div class="col-md-3">
                <label class="form-label small text-muted">Pencarian</label>
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text"
                           class="form-control"
                           name="q"
                           value="{{ $keyword }}"
                           placeholder="Nama, kode, kategori...">
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted">Kategori</label>
                <select class="form-select" name="kategori">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat }}" {{ $kategori === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted">Tanggal Dari</label>
                <input type="date" class="form-control" name="tanggal_dari" value="{{ $tanggal_dari }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted">Tanggal Sampai</label>
                <input type="date" class="form-control" name="tanggal_sampai" value="{{ $tanggal_sampai }}">
            </div>
            <div class="col-md-3 text-md-end">
                <button type="submit" class="btn btn-primary me-1">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
                <a href="{{ route('laporan.index') }}" class="btn btn-light me-1">Reset</a>
                <a href="{{ route('laporan.export.pdf', request()->query()) }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i>
                </a>
                <a href="{{ route('laporan.export.excel', request()->query()) }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel"></i>
                </a>
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Total Nilai</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $index => $barang)
                        <tr>
                            <td>{{ $barangs->firstItem() + $index }}</td>
                            <td><code>{{ $barang->kode_barang }}</code></td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td><span class="badge bg-light text-dark">{{ $barang->kategori }}</span></td>
                            <td>{{ number_format($barang->stok) }}</td>
                            <td>{{ $barang->harga_formatted }}</td>
                            <td>Rp {{ number_format($barang->total_nilai, 0, ',', '.') }}</td>
                            <td>{{ $barang->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Tidak ada data laporan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($barangs->hasPages())
        <div class="card-footer bg-white border-0">
            {{ $barangs->links() }}
        </div>
    @endif
</div>
@endsection
