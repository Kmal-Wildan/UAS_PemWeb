@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Ringkasan data barang dan aktivitas sistem')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Barang</p>
                <h3 class="stat-value">{{ number_format($stats['total_barang']) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="bi bi-tags"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Kategori</p>
                <h3 class="stat-value">{{ number_format($stats['total_kategori']) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="bi bi-stack"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Stok</p>
                <h3 class="stat-value">{{ number_format($stats['total_stok']) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-warning">
            <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Nilai Barang</p>
                <h3 class="stat-value">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><i class="bi bi-bar-chart me-2 text-primary"></i>Barang Terbaru</h5>
                <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBarangs as $barang)
                                <tr>
                                    <td><code>{{ $barang->kode_barang }}</code></td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td><span class="badge bg-light text-dark">{{ $barang->kategori }}</span></td>
                                    <td>{{ number_format($barang->stok) }}</td>
                                    <td>{{ $barang->harga_formatted }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Belum ada data barang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0"><i class="bi bi-lightning me-2 text-warning"></i>Aksi Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('barang.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Barang
                    </a>
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-table me-2"></i>Kelola Barang
                    </a>
                    <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i>Lihat Laporan
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0"><i class="bi bi-pie-chart me-2 text-info"></i>Per Kategori</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($kategoriStats as $stat)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $stat->kategori }}</span>
                            <span class="badge bg-primary">{{ $stat->jumlah }} item</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted small">Belum ada data.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
