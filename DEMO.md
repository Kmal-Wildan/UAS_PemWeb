# Panduan Demo — UAS PEMWEB

Dokumentasi lengkap untuk presentasi tugas kuliah aplikasi manajemen barang Laravel.

---

## Cara Menjalankan Project

```bash
# 1. Clone & masuk ke branch demo
git checkout phase-3-demo-ready

# 2. Install dependencies
composer install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Setting database (pilih salah satu)

# Opsi A — SQLite (paling mudah untuk demo)
touch database/database.sqlite
# Pastikan di .env:
# DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite

# Opsi B — MySQL
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=uas_pemweb
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Migrasi & data dummy
php artisan migrate:fresh --seed

# 6. Jalankan server
php artisan serve
```

Buka browser: **http://127.0.0.1:8000**

---

## Akun Login Demo

| Role | Email | Password |
|------|-------|----------|
| **Admin** | admin@gmail.com | password123 |
| **User** | user@gmail.com | password123 |

---

## Data Dummy

Seeder menyediakan **18 barang** di 4 kategori:

- **Elektronik** — Laptop, Mouse, Monitor, Keyboard, Headset
- **Fashion** — Kaos, Jaket, Jeans, Dress, Topi
- **Makanan** — Beras, Minyak, Teh, Kopi
- **Olahraga** — Sepatu, Raket, Bola, Matras

Tanggal `created_at` dispread 2–80 hari terakhir agar **filter tanggal** pada laporan bisa didemokan.

---

## Checklist Demo Project

Gunakan checklist ini sebelum presentasi:

- [ ] `composer install` berhasil tanpa error
- [ ] File `.env` sudah dibuat dan `APP_KEY` terisi
- [ ] Database sudah dimigrasi (`php artisan migrate:fresh --seed`)
- [ ] Server berjalan di `http://127.0.0.1:8000`
- [ ] Login Admin berhasil → Dashboard Admin
- [ ] Login User berhasil → Dashboard User
- [ ] Dashboard menampilkan 4 statistik (barang, kategori, stok, nilai)
- [ ] CRUD barang (Admin): tambah, edit, hapus berfungsi
- [ ] Alert sukses muncul setelah tambah/edit/hapus
- [ ] Validasi form menampilkan pesan error (coba submit kosong)
- [ ] Search barang via input pencarian (Ajax)
- [ ] User tidak bisa akses halaman tambah/edit (403)
- [ ] Halaman laporan: filter kategori berfungsi
- [ ] Halaman laporan: filter tanggal dari–sampai berfungsi
- [ ] Export PDF terunduh
- [ ] Export Excel terunduh
- [ ] Logout berfungsi untuk kedua role

---

## Urutan Presentasi Demo

### Bagian 1 — Pembukaan (2 menit)

1. Jelaskan judul: **Sistem Manajemen Barang dengan Role Admin & User**
2. Sebutkan tech stack: Laravel 11, Bootstrap 5, jQuery Ajax, SQLite/MySQL
3. Tunjukkan halaman login

### Bagian 2 — Demo Admin (8–10 menit)

1. **Login Admin** (`admin@gmail.com` / `password123`)
2. **Dashboard Admin** — jelaskan 4 statistik card
3. **Data Barang** — tampilkan tabel 18 data dummy
4. **Search** — ketik "laptop" atau "elektronik" di search box
5. **Tambah Barang** — isi form, submit → tunjukkan alert sukses
6. **Edit Barang** — ubah stok/harga → alert sukses
7. **Detail Barang** — klik tombol mata (eye)
8. **Hapus Barang** — klik hapus → modal konfirmasi → alert sukses
9. **Validasi** — coba tambah dengan kode duplikat → tunjukkan error
10. **Laporan** — filter kategori "Elektronik"
11. **Filter Tanggal** — set rentang 30 hari terakhir
12. **Export PDF** — klik tombol merah, file terunduh
13. **Export Excel** — klik tombol hijau, file terunduh
14. **Logout**

### Bagian 3 — Demo User (3–5 menit)

1. **Login User** (`user@gmail.com` / `password123`)
2. **Dashboard User** — statistik read-only + banner "Mode Read-Only"
3. **Lihat Barang** — tidak ada tombol tambah/edit/hapus
4. **Detail Barang** — hanya tombol lihat
5. **Laporan** — bisa lihat & export, tidak bisa CRUD
6. **Proteksi Role** — (opsional) buka URL `/barang/create` → tampil 403
7. **Logout**

### Bagian 4 — Penutup (1–2 menit)

1. Ringkas fitur yang sudah diimplementasi
2. Sebutkan keamanan: middleware auth + role
3. Tanya sesi tanya jawab

---

## Penjelasan Singkat Fitur (Untuk Presentasi)

| Fitur | Penjelasan |
|-------|------------|
| **Login/Logout** | Autentikasi Laravel menggunakan `Auth::attempt()` dengan session. Password di-hash bcrypt. |
| **Role Admin & User** | Kolom `role` di tabel users. Middleware `RoleMiddleware` membatasi akses route. |
| **CRUD Barang (Admin)** | Create, Read, Update, Delete data barang dengan validasi Form Request. |
| **Read-only (User)** | User hanya bisa index, detail, dan laporan. Route write dilindungi middleware `role:admin`. |
| **Dashboard** | Statistik real-time: total barang, kategori, stok, dan nilai inventori (stok × harga). |
| **Searching** | Pencarian Ajax jQuery pada nama, kode, dan kategori barang. |
| **Reporting** | Laporan dengan ringkasan per kategori, filter kategori & rentang tanggal. |
| **Export PDF** | Generate PDF via DomPDF dari template Blade. |
| **Export Excel** | Export .xlsx via Maatwebsite Excel dengan data terfilter. |
| **Validasi Form** | Form Request dengan pesan error Bahasa Indonesia. |
| **Alert Sukses** | Flash message session ditampilkan setelah CRUD berhasil. |
| **Modal Hapus** | Konfirmasi Bootstrap modal sebelum delete. |
| **Responsif** | Layout Bootstrap 5 mobile-friendly dengan sidebar collapsible. |

---

## Alur Demo Aplikasi (End-to-End)

```
[Halaman Login]
      │
      ├── Admin login ──► Dashboard Admin
      │                        │
      │                        ├── Data Barang (CRUD + Search)
      │                        ├── Laporan (Filter + Export)
      │                        └── Logout
      │
      └── User login ───► Dashboard User
                               │
                               ├── Lihat Barang (Read-only)
                               ├── Lihat Laporan (Export OK)
                               └── Logout
```

---

## Tips Presentasi

1. Jalankan `php artisan migrate:fresh --seed` **sebelum demo** agar data fresh
2. Siapkan 1 barang baru untuk demo tambah (contoh: BRG-019)
3. Untuk demo filter tanggal: gunakan rentang 30–60 hari terakhir
4. Buka PDF/Excel yang terunduh untuk bukti export berfungsi
5. Bookmark URL penting: `/login`, `/dashboard/admin`, `/barang`, `/laporan`

---

## Troubleshooting

| Masalah | Solusi |
|---------|--------|
| `No application encryption key` | `php artisan key:generate` |
| Database error | Cek `.env`, pastikan SQLite file ada atau MySQL running |
| Export PDF error | `composer require barryvdh/laravel-dompdf` |
| Export Excel error | `composer require maatwebsite/excel` |
| 403 on all pages | Pastikan login dengan akun yang benar |
| Halaman kosong | `php artisan config:clear && php artisan cache:clear` |
