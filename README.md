# UAS PEMWEB — Sistem Manajemen Barang

Aplikasi Laravel dengan dua role **Admin** (CRUD penuh) dan **User** (read-only).

**Branch demo-ready:** `phase-3-demo-ready`

Panduan presentasi lengkap: **[DEMO.md](DEMO.md)**

## Quick Start

```bash
git checkout main
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan serve
```

Buka: http://127.0.0.1:8000

## Akun Demo

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | password123 |
| User | user@gmail.com | password123 |

## Fitur

- Login / Logout dengan Laravel Auth
- Role Admin & User (middleware)
- CRUD Barang (Admin only)
- Dashboard statistik (barang, kategori, stok, nilai)
- Pencarian Ajax
- Laporan + filter kategori & tanggal
- Export PDF & Excel
- Validasi form + flash messages
- 18 data dummy siap demo

## Progres

| Branch | Tahap |
|--------|-------|
| `phase-1` | View (Blade) |
| `phase-2` | Model & Controller |
| `phase-3-demo-ready` | Demo-ready + dokumentasi presentasi |

## Tech Stack

Laravel 11 · Bootstrap 5 · jQuery · DomPDF · Maatwebsite Excel · SQLite/MySQL
