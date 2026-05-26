<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang — {{ config('app.name') }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; }
        h1 { font-size: 18px; margin-bottom: 4px; }
        .meta { font-size: 10px; color: #666; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background: #1e293b; color: #fff; font-size: 10px; }
        tr:nth-child(even) { background: #f8fafc; }
        .summary { margin-top: 16px; }
        .summary td { border: none; padding: 4px 8px; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h1>Laporan Data Barang</h1>
    <p class="meta">
        Dicetak: {{ now()->format('d F Y H:i') }}
        @if($keyword) | Pencarian: {{ $keyword }} @endif
        @if($kategori) | Kategori: {{ $kategori }} @endif
        @if($tanggal_dari) | Dari: {{ $tanggal_dari }} @endif
        @if($tanggal_sampai) | Sampai: {{ $tanggal_sampai }} @endif
    </p>

    <table>
        <thead>
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
            @foreach($barangs as $index => $barang)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $barang->kode_barang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori }}</td>
                    <td class="text-right">{{ number_format($barang->stok, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($barang->harga, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($barang->total_nilai, 0, ',', '.') }}</td>
                    <td>{{ $barang->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="summary">
        <tr>
            <td><strong>Total Barang:</strong> {{ $stats['total_barang'] }}</td>
            <td><strong>Total Kategori:</strong> {{ $stats['total_kategori'] }}</td>
            <td><strong>Total Stok:</strong> {{ number_format($stats['total_stok'], 0, ',', '.') }}</td>
            <td><strong>Total Nilai:</strong> Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</td>
        </tr>
    </table>
</body>
</html>
