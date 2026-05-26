@extends('layouts.app')

@php
    $userRole = auth()->user()->role ?? session('role', 'admin');
    $isAdmin = $userRole === 'admin';
@endphp

@section('title', 'Laporan')
@section('page-title', 'Laporan')
@section('page-subtitle', $isAdmin ? 'Lihat dan export laporan data' : 'Lihat laporan data (read-only)')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="bi bi-file-earmark-text"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Laporan</p>
                <h3 class="stat-value">{{ $stats['total_reports'] ?? 12 }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="bi bi-calendar-check"></i></div>
            <div class="stat-info">
                <p class="stat-label">Bulan Ini</p>
                <h3 class="stat-value">{{ $stats['this_month'] ?? 4 }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="bi bi-download"></i></div>
            <div class="stat-info">
                <p class="stat-label">Total Download</p>
                <h3 class="stat-value">{{ $stats['downloads'] ?? 48 }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 py-3">
        <div class="row align-items-center g-3">
            <div class="col-md-4">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text"
                           class="form-control"
                           id="reportSearchInput"
                           placeholder="Cari laporan..."
                           autocomplete="off">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="reportFilter">
                    <option value="">Semua Periode</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="tahunan">Tahunan</option>
                </select>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="btn-group">
                    <a href="{{ route('laporan.export.pdf') }}" class="btn btn-danger" id="btnExportPdf">
                        <i class="bi bi-file-earmark-pdf me-1"></i>Export PDF
                    </a>
                    <a href="{{ route('laporan.export.excel') }}" class="btn btn-success" id="btnExportExcel">
                        <i class="bi bi-file-earmark-excel me-1"></i>Export Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle" id="reportTable">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Judul Laporan</th>
                        <th>Periode</th>
                        <th>Total Data</th>
                        <th>Tanggal Dibuat</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="reportTableBody">
                    @php
                        $reports = $reportList ?? [
                            ['id' => 1, 'judul' => 'Laporan Data Bulanan Mei 2026', 'periode' => 'Bulanan', 'total' => 128, 'tanggal' => '26 Mei 2026'],
                            ['id' => 2, 'judul' => 'Laporan Kategori Elektronik', 'periode' => 'Bulanan', 'total' => 45, 'tanggal' => '25 Mei 2026'],
                            ['id' => 3, 'judul' => 'Laporan Data Tahunan 2026', 'periode' => 'Tahunan', 'total' => 512, 'tanggal' => '20 Mei 2026'],
                            ['id' => 4, 'judul' => 'Laporan Status Nonaktif', 'periode' => 'Bulanan', 'total' => 32, 'tanggal' => '18 Mei 2026'],
                            ['id' => 5, 'judul' => 'Laporan Ringkasan Q2 2026', 'periode' => 'Tahunan', 'total' => 256, 'tanggal' => '15 Mei 2026'],
                        ];
                    @endphp
                    @foreach($reports as $index => $report)
                        <tr data-periode="{{ strtolower($report['periode']) }}">
                            <td>{{ $index + 1 }}</td>
                            <td class="col-judul">
                                <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                {{ $report['judul'] }}
                            </td>
                            <td>
                                <span class="badge {{ $report['periode'] === 'Bulanan' ? 'bg-primary' : 'bg-info' }}">
                                    {{ $report['periode'] }}
                                </span>
                            </td>
                            <td>{{ $report['total'] }}</td>
                            <td>{{ $report['tanggal'] }}</td>
                            <td class="text-center">
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary btn-view-report"
                                        data-id="{{ $report['id'] }}"
                                        data-judul="{{ $report['judul'] }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal detail laporan --}}
<div class="modal fade" id="reportDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title"><i class="bi bi-file-earmark-bar-graph me-2"></i>Detail Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="reportDetailContent">
                <p class="text-muted">Memuat detail laporan...</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('laporan.export.pdf') }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf me-1"></i>Download PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#reportSearchInput').on('keyup', function () {
            const keyword = $(this).val().toLowerCase();
            $('#reportTableBody tr').each(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
            });
        });

        $('#reportFilter').on('change', function () {
            const filter = $(this).val();
            $('#reportTableBody tr').each(function () {
                if (!filter) {
                    $(this).show();
                } else {
                    $(this).toggle($(this).data('periode') === filter);
                }
            });
        });

        $('.btn-view-report').on('click', function () {
            const judul = $(this).data('judul');
            const id = $(this).data('id');

            $('#reportDetailContent').html(
                '<h6>' + judul + '</h6>' +
                '<p class="text-muted">Laporan #' + id + '</p>' +
                '<hr>' +
                '<p>Ini adalah preview detail laporan. Pada tahap berikutnya, data akan diambil dari database melalui Ajax.</p>' +
                '<ul>' +
                '<li>Total record: 128</li>' +
                '<li>Data aktif: 96</li>' +
                '<li>Data nonaktif: 32</li>' +
                '</ul>'
            );

            new bootstrap.Modal('#reportDetailModal').show();
        });

        $('#btnExportPdf, #btnExportExcel').on('click', function (e) {
            $(this).append(' <span class="spinner-border spinner-border-sm"></span>');
        });
    });
</script>
@endpush
