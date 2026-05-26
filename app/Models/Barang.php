<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
    public function scopeSearch(Builder $query, ?string $keyword): Builder
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

    /**
     * Scope filter laporan: kategori dan rentang tanggal (created_at).
     */
    public function scopeFilterLaporan(
        Builder $query,
        ?string $keyword = null,
        ?string $kategori = null,
        ?string $tanggalDari = null,
        ?string $tanggalSampai = null,
    ): Builder {
        return $query
            ->search($keyword)
            ->when($kategori, fn ($q) => $q->where('kategori', $kategori))
            ->when($tanggalDari, fn ($q) => $q->whereDate('created_at', '>=', $tanggalDari))
            ->when($tanggalSampai, fn ($q) => $q->whereDate('created_at', '<=', $tanggalSampai));
    }

    public function getHargaFormattedAttribute(): string
    {
        return 'Rp '.number_format((float) $this->harga, 0, ',', '.');
    }

    public function getTotalNilaiAttribute(): float
    {
        return (float) $this->stok * (float) $this->harga;
    }
}
