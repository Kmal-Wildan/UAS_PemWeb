<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    private function sampleData(): array
    {
        return [
            ['id' => 1, 'nama' => 'Produk Alpha', 'kategori' => 'Elektronik', 'status' => 'aktif', 'tanggal' => '26 Mei 2026'],
            ['id' => 2, 'nama' => 'Produk Beta', 'kategori' => 'Fashion', 'status' => 'aktif', 'tanggal' => '25 Mei 2026'],
            ['id' => 3, 'nama' => 'Produk Gamma', 'kategori' => 'Makanan', 'status' => 'nonaktif', 'tanggal' => '24 Mei 2026'],
            ['id' => 4, 'nama' => 'Produk Delta', 'kategori' => 'Elektronik', 'status' => 'aktif', 'tanggal' => '23 Mei 2026'],
            ['id' => 5, 'nama' => 'Produk Epsilon', 'kategori' => 'Olahraga', 'status' => 'aktif', 'tanggal' => '22 Mei 2026'],
        ];
    }

    public function index()
    {
        return view('data.index', [
            'dataList' => $this->sampleData(),
        ]);
    }

    public function create()
    {
        return view('data.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        return redirect()->route('data.index')
            ->with('success', 'Data "' . $request->nama . '" berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = collect($this->sampleData())->firstWhere('id', (int) $id);

        return view('data.show', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = collect($this->sampleData())->firstWhere('id', (int) $id);

        return view('data.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        return redirect()->route('data.index')
            ->with('success', 'Data #' . $id . ' berhasil diperbarui.');
    }

    public function destroy($id)
    {
        return redirect()->route('data.index')
            ->with('success', 'Data #' . $id . ' berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = strtolower($request->get('q', ''));

        $filtered = collect($this->sampleData())->filter(function ($item) use ($keyword) {
            return str_contains(strtolower($item['nama']), $keyword)
                || str_contains(strtolower($item['kategori']), $keyword)
                || str_contains(strtolower($item['status']), $keyword);
        })->values();

        return response()->json(['data' => $filtered]);
    }
}
