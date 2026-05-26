<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function __construct(
        protected ?string $keyword = null,
        protected ?string $kategori = null,
    ) {}

    public function collection()
    {
        $query = Barang::query()->search($this->keyword);

        if ($this->kategori) {
            $query->where('kategori', $this->kategori);
        }

        return $query->orderBy('kategori')->orderBy('nama_barang')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Stok',
            'Harga',
            'Total Nilai',
            'Tanggal Dibuat',
        ];
    }

    public function map($barang): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $barang->kode_barang,
            $barang->nama_barang,
            $barang->kategori,
            $barang->stok,
            $barang->harga,
            $barang->stok * $barang->harga,
            $barang->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
