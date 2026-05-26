@extends('layouts.app')

@php
    $userRole = auth()->user()->role ?? session('role', 'admin');
    $isAdmin = $userRole === 'admin';
@endphp

@section('title', 'Data Utama')
@section('page-title', 'Data Utama')
@section('page-subtitle', $isAdmin ? 'Kelola semua data aplikasi' : 'Lihat data aplikasi (read-only)')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 py-3">
        <div class="row align-items-center g-3">
            <div class="col-md-6">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text"
                           class="form-control"
                           id="searchInput"
                           placeholder="Cari nama, kategori, atau status..."
                           autocomplete="off">
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                @if($isAdmin)
                    <a href="{{ route('data.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Data
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle" id="dataTable">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th width="180" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataTableBody">
                    @forelse($dataList ?? [] as $index => $item)
                        <tr data-id="{{ $item['id'] ?? $index + 1 }}">
                            <td>{{ $index + 1 }}</td>
                            <td class="col-nama">{{ $item['nama'] ?? '-' }}</td>
                            <td class="col-kategori"><span class="badge bg-light text-dark">{{ $item['kategori'] ?? '-' }}</span></td>
                            <td class="col-status">
                                @php $status = $item['status'] ?? 'aktif'; @endphp
                                <span class="badge {{ $status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="col-tanggal">{{ $item['tanggal'] ?? '-' }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('data.show', $item['id'] ?? $index + 1) }}"
                                       class="btn btn-outline-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if($isAdmin)
                                        <a href="{{ route('data.edit', $item['id'] ?? $index + 1) }}"
                                           class="btn btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-outline-danger btn-delete"
                                                title="Hapus"
                                                data-id="{{ $item['id'] ?? $index + 1 }}"
                                                data-name="{{ $item['nama'] ?? 'Data' }}"
                                                data-url="{{ route('data.destroy', $item['id'] ?? $index + 1) }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Data contoh untuk Progres I --}}
                        @php
                            $sampleData = [
                                ['id' => 1, 'nama' => 'Produk Alpha', 'kategori' => 'Elektronik', 'status' => 'aktif', 'tanggal' => '26 Mei 2026'],
                                ['id' => 2, 'nama' => 'Produk Beta', 'kategori' => 'Fashion', 'status' => 'aktif', 'tanggal' => '25 Mei 2026'],
                                ['id' => 3, 'nama' => 'Produk Gamma', 'kategori' => 'Makanan', 'status' => 'nonaktif', 'tanggal' => '24 Mei 2026'],
                                ['id' => 4, 'nama' => 'Produk Delta', 'kategori' => 'Elektronik', 'status' => 'aktif', 'tanggal' => '23 Mei 2026'],
                                ['id' => 5, 'nama' => 'Produk Epsilon', 'kategori' => 'Olahraga', 'status' => 'aktif', 'tanggal' => '22 Mei 2026'],
                            ];
                        @endphp
                        @foreach($sampleData as $index => $item)
                            <tr data-id="{{ $item['id'] }}">
                                <td>{{ $index + 1 }}</td>
                                <td class="col-nama">{{ $item['nama'] }}</td>
                                <td class="col-kategori"><span class="badge bg-light text-dark">{{ $item['kategori'] }}</span></td>
                                <td class="col-status">
                                    <span class="badge {{ $item['status'] === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($item['status']) }}
                                    </span>
                                </td>
                                <td class="col-tanggal">{{ $item['tanggal'] }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('data.show', $item['id']) }}"
                                           class="btn btn-outline-info" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if($isAdmin)
                                            <a href="{{ route('data.edit', $item['id']) }}"
                                               class="btn btn-outline-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-delete"
                                                    title="Hapus"
                                                    data-id="{{ $item['id'] }}"
                                                    data-name="{{ $item['nama'] }}"
                                                    data-url="{{ route('data.destroy', $item['id']) }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Loading indicator untuk Ajax search --}}
        <div id="searchLoading" class="text-center py-3 d-none">
            <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            <span class="ms-2 text-muted small">Mencari data...</span>
        </div>

        {{-- Empty state --}}
        <div id="emptyState" class="text-center py-5 d-none">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <p class="text-muted mt-2 mb-0">Tidak ada data yang ditemukan.</p>
        </div>
    </div>

    <div class="card-footer bg-white border-0">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <p class="text-muted small mb-0" id="resultInfo">Menampilkan semua data</p>
            <nav aria-label="Pagination">
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><span class="page-link">Sebelumnya</span></li>
                    <li class="page-item active"><span class="page-link">1</span></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Berikutnya</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        const searchUrl = '{{ route("data.search") }}';
        let searchTimeout;

        $('#searchInput').on('keyup', function () {
            const keyword = $(this).val().trim();
            clearTimeout(searchTimeout);

            searchTimeout = setTimeout(function () {
                if (keyword.length === 0) {
                    location.reload();
                    return;
                }

                $('#searchLoading').removeClass('d-none');
                $('#dataTableBody').addClass('opacity-50');

                $.ajax({
                    url: searchUrl,
                    method: 'GET',
                    data: { q: keyword },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        renderTable(response.data || []);
                    },
                    error: function () {
                        filterTableClient(keyword);
                    },
                    complete: function () {
                        $('#searchLoading').addClass('d-none');
                        $('#dataTableBody').removeClass('opacity-50');
                    }
                });
            }, 400);
        });

        function filterTableClient(keyword) {
            const lower = keyword.toLowerCase();
            let visible = 0;

            $('#dataTableBody tr').each(function () {
                const text = $(this).text().toLowerCase();
                const match = text.indexOf(lower) > -1;
                $(this).toggle(match);
                if (match) visible++;
            });

            $('#emptyState').toggleClass('d-none', visible > 0);
            $('#resultInfo').text('Menampilkan ' + visible + ' hasil untuk "' + keyword + '"');
        }

        function renderTable(data) {
            const isAdmin = {{ $isAdmin ? 'true' : 'false' }};
            let html = '';

            if (data.length === 0) {
                $('#dataTableBody').html('');
                $('#emptyState').removeClass('d-none');
                $('#resultInfo').text('Tidak ada data ditemukan');
                return;
            }

            $('#emptyState').addClass('d-none');

            data.forEach(function (item, index) {
                const statusClass = item.status === 'aktif' ? 'bg-success' : 'bg-secondary';
                html += '<tr data-id="' + item.id + '">';
                html += '<td>' + (index + 1) + '</td>';
                html += '<td class="col-nama">' + item.nama + '</td>';
                html += '<td class="col-kategori"><span class="badge bg-light text-dark">' + item.kategori + '</span></td>';
                html += '<td class="col-status"><span class="badge ' + statusClass + '">' + item.status.charAt(0).toUpperCase() + item.status.slice(1) + '</span></td>';
                html += '<td class="col-tanggal">' + item.tanggal + '</td>';
                html += '<td class="text-center"><div class="btn-group btn-group-sm">';
                html += '<a href="/data/' + item.id + '" class="btn btn-outline-info"><i class="bi bi-eye"></i></a>';
                if (isAdmin) {
                    html += '<a href="/data/' + item.id + '/edit" class="btn btn-outline-warning"><i class="bi bi-pencil"></i></a>';
                    html += '<button type="button" class="btn btn-outline-danger btn-delete" data-id="' + item.id + '" data-name="' + item.nama + '" data-url="/data/' + item.id + '"><i class="bi bi-trash"></i></button>';
                }
                html += '</div></td></tr>';
            });

            $('#dataTableBody').html(html);
            $('#resultInfo').text('Menampilkan ' + data.length + ' hasil');
        }
    });
</script>
@endpush
