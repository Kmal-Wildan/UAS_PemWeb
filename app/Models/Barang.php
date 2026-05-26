<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'stok',
        'harga',
    ];

    protected function casts(): array
    {
        return [
            'stok' => 'integer',
            'harga' => 'decimal:2',
        ];
    }

    /**
     * Scope pencarian berdasarkan nama_barang, kode_barang, dan kategori.
     */
    public function scopeSearch($query, ?string $keyword)
    {
        if (blank($keyword)) {
            return $query;
        }

        return $query->where(function ($q) use ($keyword) {
            $q->where('nama_barang', 'like', "%{$keyword}%")
                ->orWhere('kode_barang', 'like', "%{$keyword}%")
                ->orWhere('kategori', 'like', "%{$keyword}%");
        });
    }

    public function getHargaFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
