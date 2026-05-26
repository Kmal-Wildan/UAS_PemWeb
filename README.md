# UAS PEMWEB

Aplikasi website Laravel dengan dua aktor: **Admin** (CRUD penuh) dan **User** (read-only).

## Progres

| Progres | Branch | Isi |
|---------|--------|-----|
| I — View | `cursor/phase-1` | Blade templates, layout, UI |
| II — Model & Controller | `phase-2` | Migration, Model, Controller, Middleware, Export |

## Instalasi

```bash
# Clone & checkout branch Progres II
git checkout phase-2

# Install Laravel + dependencies (jika belum ada project penuh)
composer install

# Environment
cp .env.example .env
php artisan key:generate

# Database (SQLite default)
touch database/database.sqlite
php artisan migrate --seed

# Jalankan server
php artisan serve
```

Buka http://localhost:8000

## Akun Demo

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| User | user@example.com | password |

## Hak Akses

| Fitur | Admin | User |
|-------|-------|------|
| Login / Logout | ✅ | ✅ |
| Dashboard | ✅ Admin | ✅ User |
| Lihat Barang (index, detail) | ✅ | ✅ |
| Tambah / Edit / Hapus Barang | ✅ | ❌ |
| Lihat Laporan | ✅ | ✅ |
| Export PDF / Excel | ✅ | ✅ |

## Struktur Backend (Progres II)

```
app/
├── Exports/BarangExport.php       # Export Excel (Maatwebsite)
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php     # Login/logout (Auth facade)
│   │   ├── BarangController.php   # CRUD + search Ajax
│   │   ├── DashboardController.php
│   │   └── LaporanController.php  # Laporan + export PDF/Excel
│   ├── Middleware/RoleMiddleware.php  # Pembatasan role admin/user
│   └── Requests/
│       ├── LoginRequest.php
│       ├── StoreBarangRequest.php
│       └── UpdateBarangRequest.php
└── Models/
    ├── User.php                   # Model user + role
    └── Barang.php                 # Model barang + scope search

database/
├── migrations/
│   ├── ..._create_users_table.php
│   └── ..._create_barangs_table.php
└── seeders/
    ├── DatabaseSeeder.php
    ├── UserSeeder.php
    └── BarangSeeder.php
```

## Entitas Barang

| Field | Tipe |
|-------|------|
| id | bigint |
| kode_barang | string (unique) |
| nama_barang | string |
| kategori | string |
| stok | unsigned integer |
| harga | decimal(15,2) |
| created_at / updated_at | timestamp |

## Dependencies Export

- **PDF**: `barryvdh/laravel-dompdf`
- **Excel**: `maatwebsite/excel`

## Tech Stack

- Laravel 11, PHP 8.2+
- Bootstrap 5, jQuery Ajax
- SQLite (default) / MySQL
