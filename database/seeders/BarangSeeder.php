<?php

namespace Database\Seeders;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            ['kode_barang' => 'BRG-001', 'nama_barang' => 'Laptop ASUS VivoBook 15', 'kategori' => 'Elektronik', 'stok' => 25, 'harga' => 8500000, 'days_ago' => 2],
            ['kode_barang' => 'BRG-002', 'nama_barang' => 'Kaos Polo Premium', 'kategori' => 'Fashion', 'stok' => 120, 'harga' => 150000, 'days_ago' => 5],
            ['kode_barang' => 'BRG-003', 'nama_barang' => 'Beras Organik 5kg', 'kategori' => 'Makanan', 'stok' => 80, 'harga' => 75000, 'days_ago' => 8],
            ['kode_barang' => 'BRG-004', 'nama_barang' => 'Sepatu Running Nike Air', 'kategori' => 'Olahraga', 'stok' => 45, 'harga' => 1200000, 'days_ago' => 12],
            ['kode_barang' => 'BRG-005', 'nama_barang' => 'Mouse Wireless Logitech M331', 'kategori' => 'Elektronik', 'stok' => 60, 'harga' => 250000, 'days_ago' => 15],
            ['kode_barang' => 'BRG-006', 'nama_barang' => 'Jaket Hoodie Fleece', 'kategori' => 'Fashion', 'stok' => 35, 'harga' => 320000, 'days_ago' => 20],
            ['kode_barang' => 'BRG-007', 'nama_barang' => 'Minyak Goreng 2L', 'kategori' => 'Makanan', 'stok' => 200, 'harga' => 35000, 'days_ago' => 25],
            ['kode_barang' => 'BRG-008', 'nama_barang' => 'Raket Badminton Yonex', 'kategori' => 'Olahraga', 'stok' => 30, 'harga' => 450000, 'days_ago' => 30],
            ['kode_barang' => 'BRG-009', 'nama_barang' => 'Monitor LG 24 Inch', 'kategori' => 'Elektronik', 'stok' => 18, 'harga' => 2200000, 'days_ago' => 35],
            ['kode_barang' => 'BRG-010', 'nama_barang' => 'Celana Jeans Slim Fit', 'kategori' => 'Fashion', 'stok' => 55, 'harga' => 280000, 'days_ago' => 40],
            ['kode_barang' => 'BRG-011', 'nama_barang' => 'Teh Celup Box 25pcs', 'kategori' => 'Makanan', 'stok' => 150, 'harga' => 18000, 'days_ago' => 45],
            ['kode_barang' => 'BRG-012', 'nama_barang' => 'Bola Sepak Adidas', 'kategori' => 'Olahraga', 'stok' => 40, 'harga' => 350000, 'days_ago' => 50],
            ['kode_barang' => 'BRG-013', 'nama_barang' => 'Keyboard Mechanical RGB', 'kategori' => 'Elektronik', 'stok' => 22, 'harga' => 750000, 'days_ago' => 55],
            ['kode_barang' => 'BRG-014', 'nama_barang' => 'Dress Floral Summer', 'kategori' => 'Fashion', 'stok' => 28, 'harga' => 420000, 'days_ago' => 60],
            ['kode_barang' => 'BRG-015', 'nama_barang' => 'Kopi Bubuk Premium 200g', 'kategori' => 'Makanan', 'stok' => 90, 'harga' => 65000, 'days_ago' => 65],
            ['kode_barang' => 'BRG-016', 'nama_barang' => 'Matras Yoga 6mm', 'kategori' => 'Olahraga', 'stok' => 50, 'harga' => 180000, 'days_ago' => 70],
            ['kode_barang' => 'BRG-017', 'nama_barang' => 'Headset Gaming Razer', 'kategori' => 'Elektronik', 'stok' => 15, 'harga' => 950000, 'days_ago' => 75],
            ['kode_barang' => 'BRG-018', 'nama_barang' => 'Topi Snapback', 'kategori' => 'Fashion', 'stok' => 70, 'harga' => 85000, 'days_ago' => 80],
        ];

        foreach ($barangs as $item) {
            $daysAgo = $item['days_ago'];
            unset($item['days_ago']);

            $barang = Barang::updateOrCreate(
                ['kode_barang' => $item['kode_barang']],
                $item
            );

            $createdAt = Carbon::now()->subDays($daysAgo)->setTime(10, 0, 0);
            $barang->created_at = $createdAt;
            $barang->updated_at = $createdAt->copy()->addHours(2);
            $barang->saveQuietly();
        }
    }
}
