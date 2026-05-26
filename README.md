# UAS PEMWEB

Aplikasi website Laravel dengan dua aktor: **Admin** dan **User**.

## Progres I — View (Blade)

Tahap ini berisi tampilan (View) menggunakan Laravel Blade, Bootstrap 5, CSS custom, dan jQuery Ajax.

### Struktur View

```
resources/views/
├── layouts/
│   ├── app.blade.php          # Layout utama (sidebar, navbar, footer)
│   └── auth.blade.php         # Layout halaman login
├── partials/
│   ├── sidebar.blade.php      # Sidebar dengan menu Admin/User
│   ├── navbar.blade.php       # Navbar atas
│   ├── footer.blade.php       # Footer
│   └── delete-modal.blade.php # Modal konfirmasi hapus
├── auth/
│   └── login.blade.php        # Halaman login
├── dashboard/
│   ├── admin.blade.php        # Dashboard Admin
│   └── user.blade.php         # Dashboard User (read-only)
├── data/
│   ├── index.blade.php        # Tabel data + search Ajax
│   ├── create.blade.php       # Form tambah data
│   ├── edit.blade.php         # Form edit data
│   └── show.blade.php         # Detail data
└── laporan/
    └── index.blade.php        # Halaman laporan + export PDF/Excel
```

### Fitur View

| No | Fitur | Keterangan |
|----|-------|------------|
| 1 | Halaman login | Form login dengan validasi |
| 2 | Layout utama | Sidebar, Navbar, Footer, Content area |
| 3 | Dashboard Admin | Statistik, data terbaru, aksi cepat |
| 4 | Dashboard User | Mode read-only |
| 5 | Tabel data | Tampilan data utama |
| 6 | Tombol CRUD | Tambah, Edit, Hapus, Detail (Admin only) |
| 7 | Form tambah/edit | Formulir input data |
| 8 | Search Ajax | Pencarian real-time dengan jQuery |
| 9 | Halaman laporan | Tabel laporan dengan filter |
| 10 | Export PDF/Excel | Tombol export (placeholder Progres II) |
| 11 | Modal hapus | Konfirmasi sebelum hapus |
| 12 | Responsif | Mobile-friendly layout |

### Menu Sidebar

**Admin:**
- Dashboard Admin
- Data Utama (CRUD)
- Laporan
- Keluar

**User (read-only):**
- Dashboard User
- Lihat Data
- Lihat Laporan
- Keluar

### Instalasi

```bash
# Buat project Laravel baru (jika belum ada)
composer create-project laravel/laravel .

# Salin folder resources/views, public/css, public/js, routes, dan app/Http/Controllers
# dari branch ini ke project Laravel Anda

# Jalankan server
php artisan serve
```

### Demo Login (Progres I)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | (bebas) |
| User | user@example.com | (bebas) |

### Branch

Progres I tersedia di branch: `cursor/phase-1-637a`

### Tech Stack

- Laravel Blade
- Bootstrap 5.3
- Bootstrap Icons
- jQuery 3.7 (Ajax)
- Custom CSS
