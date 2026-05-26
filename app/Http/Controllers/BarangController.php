<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');

        $barangs = Barang::search($keyword)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('barang.index', compact('barangs', 'keyword'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(StoreBarangRequest $request)
    {
        Barang::create($request->validated());

        return redirect()->route('barang.index')
            ->with('success', 'Barang "' . $request->nama_barang . '" berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $barang->update($request->validated());

        return redirect()->route('barang.index')
            ->with('success', 'Barang "' . $barang->nama_barang . '" berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $nama = $barang->nama_barang;
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang "' . $nama . '" berhasil dihapus.');
    }

    /**
     * Pencarian Ajax berdasarkan nama_barang, kode_barang, dan kategori.
     */
    public function search(Request $request)
    {
        $keyword = $request->get('q', '');

        $barangs = Barang::search($keyword)
            ->latest()
            ->limit(50)
            ->get()
            ->map(fn (Barang $barang) => [
                'id' => $barang->id,
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'kategori' => $barang->kategori,
                'stok' => $barang->stok,
                'harga' => $barang->harga_formatted,
                'harga_raw' => $barang->harga,
                'created_at' => $barang->created_at->format('d M Y'),
            ]);

        return response()->json(['data' => $barangs]);
    }
}
