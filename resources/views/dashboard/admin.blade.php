@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Ringkasan data dan aktivitas sistem')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="bi bi-database"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Data</p>
                <h3 class="stat-value">{{ $stats['total_data'] ?? 128 }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
            <div class="stat-info">
                <p class="stat-label">Data Aktif</p>
                <h3 class="stat-value">{{ $stats['active_data'] ?? 96 }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-warning">
            <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
            <div class="stat-info">
                <p class="stat-label">Pending</p>
                <h3 class="stat-value">{{ $stats['pending'] ?? 18 }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total User</p>
                <h3 class="stat-value">{{ $stats['total_users'] ?? 24 }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><i class="bi bi-bar-chart me-2 text-primary"></i>Data Terbaru</h5>
                <a href="{{ route('data.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentData ?? [] as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item['nama'] ?? '-' }}</td>
                                    <td><span class="badge bg-light text-dark">{{ $item['kategori'] ?? '-' }}</span></td>
                                    <td>
                                        @php $status = $item['status'] ?? 'aktif'; @endphp
                                        <span class="badge {{ $status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td>{{ $item['tanggal'] ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>1</td>
                                    <td>Contoh Data A</td>
                                    <td><span class="badge bg-light text-dark">Kategori 1</span></td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>26 Mei 2026</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Contoh Data B</td>
                                    <td><span class="badge bg-light text-dark">Kategori 2</span></td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>25 Mei 2026</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Contoh Data C</td>
                                    <td><span class="badge bg-light text-dark">Kategori 1</span></td>
                                    <td><span class="badge bg-secondary">Nonaktif</span></td>
                                    <td>24 Mei 2026</td>
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
                    <a href="{{ route('data.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Data
                    </a>
                    <a href="{{ route('data.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-table me-2"></i>Kelola Data
                    </a>
                    <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i>Lihat Laporan
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0"><i class="bi bi-bell me-2 text-info"></i>Notifikasi</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex gap-3">
                        <i class="bi bi-info-circle text-primary mt-1"></i>
                        <div>
                            <p class="mb-0 small fw-semibold">5 data baru ditambahkan</p>
                            <small class="text-muted">2 jam yang lalu</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex gap-3">
                        <i class="bi bi-exclamation-circle text-warning mt-1"></i>
                        <div>
                            <p class="mb-0 small fw-semibold">3 data menunggu verifikasi</p>
                            <small class="text-muted">5 jam yang lalu</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex gap-3">
                        <i class="bi bi-check-circle text-success mt-1"></i>
                        <div>
                            <p class="mb-0 small fw-semibold">Laporan bulanan siap</p>
                            <small class="text-muted">Kemarin</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
