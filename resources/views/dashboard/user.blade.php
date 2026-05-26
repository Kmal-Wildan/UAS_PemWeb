@extends('layouts.app')

@section('title', 'Dashboard User')
@section('page-title', 'Dashboard User')
@section('page-subtitle', 'Lihat data dan laporan (read-only)')

@section('content')
<div class="alert alert-info d-flex align-items-center mb-4" role="alert">
    <i class="bi bi-info-circle fs-5 me-3"></i>
    <div>
        <strong>Mode Read-Only</strong> — Sebagai User, Anda hanya dapat melihat data dan laporan tanpa melakukan perubahan.
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="bi bi-database"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Data</p>
                <h3 class="stat-value">{{ $stats['total_data'] ?? 128 }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="bi bi-check-circle"></i></div>
            <div class="stat-info">
                <p class="stat-label">Data Aktif</p>
                <h3 class="stat-value">{{ $stats['active_data'] ?? 96 }}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="bi bi-file-earmark-text"></i></div>
            <div class="stat-info">
                <p class="stat-label">Laporan Tersedia</p>
                <h3 class="stat-value">{{ $stats['reports'] ?? 12 }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><i class="bi bi-eye me-2 text-primary"></i>Data Terbaru</h5>
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
                                <th>Aksi</th>
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
                                    <td>
                                        <a href="{{ route('data.show', $item['id'] ?? 1) }}"
                                           class="btn btn-sm btn-outline-info" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>1</td>
                                    <td>Contoh Data A</td>
                                    <td><span class="badge bg-light text-dark">Kategori 1</span></td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>
                                        <a href="{{ route('data.show', 1) }}" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Contoh Data B</td>
                                    <td><span class="badge bg-light text-dark">Kategori 2</span></td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>
                                        <a href="{{ route('data.show', 2) }}" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0"><i class="bi bi-link-45deg me-2"></i>Menu Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('data.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-table me-2"></i>Lihat Data
                    </a>
                    <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i>Lihat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
