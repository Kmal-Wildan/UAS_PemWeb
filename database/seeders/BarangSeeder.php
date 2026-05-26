<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            [
                'kode_barang' => 'BRG-001',
                'nama_barang' => 'Laptop ASUS VivoBook',
                'kategori' => 'Elektronik',
                'stok' => 25,
                'harga' => 8500000,
            ],
            [
                'kode_barang' => 'BRG-002',
                'nama_barang' => 'Kaos Polo Premium',
                'kategori' => 'Fashion',
                'stok' => 120,
                'harga' => 150000,
            ],
            [
                'kode_barang' => 'BRG-003',
                'nama_barang' => 'Beras Organik 5kg',
                'kategori' => 'Makanan',
                'stok' => 80,
                'harga' => 75000,
            ],
            [
                'kode_barang' => 'BRG-004',
                'nama_barang' => 'Sepatu Running Nike',
                'kategori' => 'Olahraga',
                'stok' => 45,
                'harga' => 1200000,
            ],
            [
                'kode_barang' => 'BRG-005',
                'nama_barang' => 'Mouse Wireless Logitech',
                'kategori' => 'Elektronik',
                'stok' => 60,
                'harga' => 250000,
            ],
            [
                'kode_barang' => 'BRG-006',
                'nama_barang' => 'Jaket Hoodie',
                'kategori' => 'Fashion',
                'stok' => 35,
                'harga' => 320000,
            ],
            [
                'kode_barang' => 'BRG-007',
                'nama_barang' => 'Minyak Goreng 2L',
                'kategori' => 'Makanan',
                'stok' => 200,
                'harga' => 35000,
            ],
            [
                'kode_barang' => 'BRG-008',
                'nama_barang' => 'Raket Badminton',
                'kategori' => 'Olahraga',
                'stok' => 30,
                'harga' => 450000,
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::updateOrCreate(
                ['kode_barang' => $barang['kode_barang']],
                $barang
            );
        }
    }
}
