@extends('layouts.app')

@php
    $isAdmin = auth()->user()->isAdmin();
@endphp

@section('title', 'Data Barang')
@section('page-title', 'Data Barang')
@section('page-subtitle', $isAdmin ? 'Kelola semua data barang' : 'Lihat data barang (read-only)')

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
                           value="{{ $keyword ?? '' }}"
                           placeholder="Cari nama, kode, atau kategori..."
                           autocomplete="off">
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                @if($isAdmin)
                    <a href="{{ route('barang.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Barang
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
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th width="180" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataTableBody">
                    @forelse($barangs as $index => $barang)
                        <tr data-id="{{ $barang->id }}">
                            <td>{{ $barangs->firstItem() + $index }}</td>
                            <td class="col-kode"><code>{{ $barang->kode_barang }}</code></td>
                            <td class="col-nama">{{ $barang->nama_barang }}</td>
                            <td class="col-kategori">
                                <span class="badge bg-light text-dark">{{ $barang->kategori }}</span>
                            </td>
                            <td class="col-stok">{{ number_format($barang->stok, 0, ',', '.') }}</td>
                            <td class="col-harga">{{ $barang->harga_formatted }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('barang.show', $barang) }}"
                                       class="btn btn-outline-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if($isAdmin)
                                        <a href="{{ route('barang.edit', $barang) }}"
                                           class="btn btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-outline-danger btn-delete"
                                                title="Hapus"
                                                data-id="{{ $barang->id }}"
                                                data-name="{{ $barang->nama_barang }}"
                                                data-url="{{ route('barang.destroy', $barang) }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data barang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="searchLoading" class="text-center py-3 d-none">
            <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            <span class="ms-2 text-muted small">Mencari data...</span>
        </div>

        <div id="emptyState" class="text-center py-5 d-none">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <p class="text-muted mt-2 mb-0">Tidak ada data yang ditemukan.</p>
        </div>
    </div>

    @if($barangs->hasPages())
        <div class="card-footer bg-white border-0">
            {{ $barangs->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        const searchUrl = '{{ route("barang.search") }}';
        const isAdmin = {{ $isAdmin ? 'true' : 'false' }};
        let searchTimeout;

        $('#searchInput').on('keyup', function () {
            const keyword = $(this).val().trim();
            clearTimeout(searchTimeout);

            if (keyword.length === 0) {
                window.location.href = '{{ route("barang.index") }}';
                return;
            }

            searchTimeout = setTimeout(function () {
                $('#searchLoading').removeClass('d-none');
                $('#dataTableBody').addClass('opacity-50');

                $.get(searchUrl, { q: keyword }, function (response) {
                    renderTable(response.data || []);
                }).fail(function () {
                    filterTableClient(keyword);
                }).always(function () {
                    $('#searchLoading').addClass('d-none');
                    $('#dataTableBody').removeClass('opacity-50');
                });
            }, 400);
        });

        function filterTableClient(keyword) {
            const lower = keyword.toLowerCase();
            let visible = 0;
            $('#dataTableBody tr').each(function () {
                const match = $(this).text().toLowerCase().indexOf(lower) > -1;
                $(this).toggle(match);
                if (match) visible++;
            });
            $('#emptyState').toggleClass('d-none', visible > 0);
        }

        function renderTable(data) {
            let html = '';
            if (data.length === 0) {
                $('#dataTableBody').html('');
                $('#emptyState').removeClass('d-none');
                return;
            }
            $('#emptyState').addClass('d-none');

            data.forEach(function (item, index) {
                html += '<tr data-id="' + item.id + '">';
                html += '<td>' + (index + 1) + '</td>';
                html += '<td><code>' + item.kode_barang + '</code></td>';
                html += '<td>' + item.nama_barang + '</td>';
                html += '<td><span class="badge bg-light text-dark">' + item.kategori + '</span></td>';
                html += '<td>' + item.stok + '</td>';
                html += '<td>' + item.harga + '</td>';
                html += '<td class="text-center"><div class="btn-group btn-group-sm">';
                html += '<a href="/barang/' + item.id + '" class="btn btn-outline-info"><i class="bi bi-eye"></i></a>';
                if (isAdmin) {
                    html += '<a href="/barang/' + item.id + '/edit" class="btn btn-outline-warning"><i class="bi bi-pencil"></i></a>';
                    html += '<button type="button" class="btn btn-outline-danger btn-delete" data-id="' + item.id + '" data-name="' + item.nama_barang + '" data-url="/barang/' + item.id + '"><i class="bi bi-trash"></i></button>';
                }
                html += '</div></td></tr>';
            });
            $('#dataTableBody').html(html);
        }
    });
</script>
@endpush
