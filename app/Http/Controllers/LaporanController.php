<?php

namespace App\Http\Controllers;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index', [
            'stats' => [
                'total_reports' => 12,
                'this_month' => 4,
                'downloads' => 48,
            ],
        ]);
    }

    public function exportPdf()
    {
        // Placeholder — implementasi export PDF pada Progres berikutnya
        return back()->with('success', 'Export PDF sedang diproses (fitur akan diimplementasikan pada Progres II).');
    }

    public function exportExcel()
    {
        // Placeholder — implementasi export Excel pada Progres berikutnya
        return back()->with('success', 'Export Excel sedang diproses (fitur akan diimplementasikan pada Progres II).');
    }
}
