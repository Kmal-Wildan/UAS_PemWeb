# UAS PEMWEB — Sistem Manajemen Barang

Aplikasi Laravel dengan dua role **Admin** (CRUD penuh) dan **User** (read-only).

**Branch demo-ready:** `phase-3-demo-ready`

Panduan presentasi lengkap: **[DEMO.md](DEMO.md)**

## Persyaratan Sistem

| Software | Versi |
|----------|-------|
| **PHP** | **8.4.x** (disarankan) — juga kompatibel dengan 8.2 / 8.3 |
| Composer | 2.x |
| Database | SQLite (default) atau MySQL |
| Extension PHP | `zip`, `mbstring`, `openssl`, `pdo_sqlite`, `fileinfo`, `curl`, `xml`, `gd` |

> **Penting:** Gunakan **PHP 8.4**. PHP **8.5** saat ini **tidak didukung** oleh dependency Excel (`phpoffice/phpspreadsheet`) yang terkunci di `composer.lock`. Jika Anda memakai PHP 8.5, `composer install` akan gagal.

### Cek versi PHP

```bash
php -v
php -m
```

Pastikan output menunjukkan `PHP 8.4.x` dan extension `zip` aktif.

### Windows — install PHP 8.4

**Opsi A — Laragon (paling mudah):**
1. Install [Laragon](https://laragon.org/)
2. Menu → PHP → pilih **8.4**
3. Buka terminal baru, jalankan `php -v`

**Opsi B — Manual:**
1. Download PHP 8.4 (VS16 x64 Thread Safe) dari [windows.php.net](https://windows.php.net/download/)
2. Ekstrak ke folder, misalnya `C:\tools\php84\`
3. Edit `php.ini` — aktifkan extension:
   ```ini
   extension=zip
   extension=mbstring
   extension=openssl
   extension=pdo_sqlite
   extension=fileinfo
   extension=curl
   extension=gd
   ```
4. Tambahkan folder PHP ke PATH sistem

## Quick Start

```bash
git checkout phase-3-demo-ready
composer install
cp .env.example .env          # Windows: copy .env.example .env
php artisan key:generate
touch database/database.sqlite  # Windows: New-Item database\database.sqlite -ItemType File -Force
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

Laravel 11 · PHP 8.4 · Bootstrap 5 · jQuery · DomPDF · Maatwebsite Excel · SQLite/MySQL
