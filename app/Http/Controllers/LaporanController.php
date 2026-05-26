<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    private function filters(Request $request): array
    {
        return [
            'keyword' => $request->get('q'),
            'kategori' => $request->get('kategori'),
            'tanggal_dari' => $request->get('tanggal_dari'),
            'tanggal_sampai' => $request->get('tanggal_sampai'),
        ];
    }

    private function baseQuery(array $filters)
    {
        return Barang::query()->filterLaporan(
            $filters['keyword'],
            $filters['kategori'],
            $filters['tanggal_dari'],
            $filters['tanggal_sampai']
        );
    }

    private function buildStats($query = null): array
    {
        $base = $query ?? Barang::query();

        return [
            'total_barang' => (clone $base)->count(),
            'total_kategori' => (clone $base)->distinct('kategori')->count('kategori'),
            'total_stok' => (int) (clone $base)->sum('stok'),
            'total_nilai' => (float) ((clone $base)->selectRaw('SUM(stok * harga) as total')->value('total') ?? 0),
        ];
    }

    public function index(Request $request)
    {
        $filters = $this->filters($request);
        extract($filters);

        $query = $this->baseQuery($filters);
        $barangs = (clone $query)->latest()->paginate(10)->withQueryString();

        $stats = $this->buildStats($query);

        $kategoriList = Barang::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $laporanPerKategori = (clone $query)
            ->selectRaw('kategori, COUNT(*) as jumlah, SUM(stok) as total_stok, SUM(stok * harga) as total_nilai')
            ->groupBy('kategori')
            ->orderBy('kategori')
            ->get();

        return view('laporan.index', compact(
            'barangs',
            'stats',
            'kategoriList',
            'laporanPerKategori',
            'keyword',
            'kategori',
            'tanggal_dari',
            'tanggal_sampai'
        ));
    }

    public function exportPdf(Request $request)
    {
        $filters = $this->filters($request);
        extract($filters);

        $barangs = $this->baseQuery($filters)
            ->orderBy('kategori')
            ->orderBy('nama_barang')
            ->get();

        $stats = $this->buildStats($this->baseQuery($filters));

        $pdf = Pdf::loadView('exports.laporan-pdf', compact(
            'barangs',
            'stats',
            'keyword',
            'kategori',
            'tanggal_dari',
            'tanggal_sampai'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('laporan-barang-'.now()->format('Y-m-d-His').'.pdf');
    }

    public function exportExcel(Request $request)
    {
        $filters = $this->filters($request);

        return Excel::download(
            new BarangExport(
                $filters['keyword'],
                $filters['kategori'],
                $filters['tanggal_dari'],
                $filters['tanggal_sampai']
            ),
            'laporan-barang-'.now()->format('Y-m-d-His').'.xlsx'
        );
    }
}
