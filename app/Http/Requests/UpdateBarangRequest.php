<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $barangId = $this->route('barang')?->id ?? $this->route('barang');

        return [
            'kode_barang' => [
                'required',
                'string',
                'max:50',
                Rule::unique('barangs', 'kode_barang')->ignore($barangId),
            ],
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'kode_barang.unique' => 'Kode barang sudah digunakan.',
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.min' => 'Stok minimal 0.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.min' => 'Harga minimal 0.',
        ];
    }
}
