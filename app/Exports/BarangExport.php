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
        protected ?string $tanggalDari = null,
        protected ?string $tanggalSampai = null,
    ) {}

    public function collection()
    {
        return Barang::query()
            ->filterLaporan($this->keyword, $this->kategori, $this->tanggalDari, $this->tanggalSampai)
            ->orderBy('kategori')
            ->orderBy('nama_barang')
            ->get();
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
            $barang->total_nilai,
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
