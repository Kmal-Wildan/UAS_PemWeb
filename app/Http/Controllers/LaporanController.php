<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');
        $kategori = $request->get('kategori');

        $query = Barang::query()->search($keyword);

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $barangs = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'total_barang' => Barang::count(),
            'total_stok' => Barang::sum('stok'),
            'total_nilai' => Barang::selectRaw('SUM(stok * harga) as total')->value('total') ?? 0,
            'total_kategori' => Barang::distinct('kategori')->count('kategori'),
        ];

        $kategoriList = Barang::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $laporanPerKategori = Barang::selectRaw('kategori, COUNT(*) as jumlah, SUM(stok) as total_stok, SUM(stok * harga) as total_nilai')
            ->groupBy('kategori')
            ->orderBy('kategori')
            ->get();

        return view('laporan.index', compact(
            'barangs',
            'stats',
            'kategoriList',
            'laporanPerKategori',
            'keyword',
            'kategori'
        ));
    }

    public function exportPdf(Request $request)
    {
        $keyword = $request->get('q');
        $kategori = $request->get('kategori');

        $query = Barang::query()->search($keyword);

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $barangs = $query->orderBy('kategori')->orderBy('nama_barang')->get();

        $stats = [
            'total_barang' => $barangs->count(),
            'total_stok' => $barangs->sum('stok'),
            'total_nilai' => $barangs->sum(fn ($b) => $b->stok * $b->harga),
        ];

        $pdf = Pdf::loadView('exports.laporan-pdf', compact('barangs', 'stats', 'keyword', 'kategori'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-barang-' . now()->format('Y-m-d-His') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $keyword = $request->get('q');
        $kategori = $request->get('kategori');

        return Excel::download(
            new BarangExport($keyword, $kategori),
            'laporan-barang-' . now()->format('Y-m-d-His') . '.xlsx'
        );
    }
}
