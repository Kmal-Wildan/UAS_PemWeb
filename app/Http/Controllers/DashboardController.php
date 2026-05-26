<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class DashboardController extends Controller
{
    private function buildStats(): array
    {
        return [
            'total_barang' => Barang::count(),
            'total_kategori' => Barang::distinct('kategori')->count('kategori'),
            'total_stok' => (int) Barang::sum('stok'),
            'total_nilai' => (float) (Barang::selectRaw('SUM(stok * harga) as total')->value('total') ?? 0),
        ];
    }

    public function admin()
    {
        $stats = $this->buildStats();
        $recentBarangs = Barang::latest()->take(5)->get();

        $kategoriStats = Barang::selectRaw('kategori, COUNT(*) as jumlah, SUM(stok) as total_stok, SUM(stok * harga) as total_nilai')
            ->groupBy('kategori')
            ->orderByDesc('jumlah')
            ->get();

        return view('dashboard.admin', compact('stats', 'recentBarangs', 'kategoriStats'));
    }

    public function user()
    {
        $stats = $this->buildStats();
        $recentBarangs = Barang::latest()->take(5)->get();

        return view('dashboard.user', compact('stats', 'recentBarangs'));
    }
}
