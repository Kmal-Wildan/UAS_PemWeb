<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;

class DashboardController extends Controller
{
    public function admin()
    {
        $stats = [
            'total_barang' => Barang::count(),
            'total_stok' => Barang::sum('stok'),
            'total_nilai' => Barang::selectRaw('SUM(stok * harga) as total')->value('total') ?? 0,
            'total_users' => User::where('role', 'user')->count(),
        ];

        $recentBarangs = Barang::latest()->take(5)->get();

        $kategoriStats = Barang::selectRaw('kategori, COUNT(*) as jumlah, SUM(stok) as total_stok')
            ->groupBy('kategori')
            ->orderByDesc('jumlah')
            ->get();

        return view('dashboard.admin', compact('stats', 'recentBarangs', 'kategoriStats'));
    }

    public function user()
    {
        $stats = [
            'total_barang' => Barang::count(),
            'total_stok' => Barang::sum('stok'),
            'total_kategori' => Barang::distinct('kategori')->count('kategori'),
        ];

        $recentBarangs = Barang::latest()->take(5)->get();

        return view('dashboard.user', compact('stats', 'recentBarangs'));
    }
}
