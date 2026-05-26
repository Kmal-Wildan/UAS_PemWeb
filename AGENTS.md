# AGENTS.md

## Cursor Cloud specific instructions

### Repository state

Progres I (View) telah ditambahkan pada branch `cursor/phase-1-637a`. Berisi Blade views, CSS/JS assets, routes demo, dan controller stubs.

**Catatan:** Lingkungan cloud saat ini tidak memiliki PHP/Composer. File view dan controller stubs siap disalin ke project Laravel lokal.

### Struktur Progres I

- `resources/views/` — Semua Blade templates
- `public/css/app.css` — Custom stylesheet
- `public/js/app.js` — jQuery interactions (sidebar, delete modal, Ajax setup)
- `routes/web.php` — Route definitions untuk demo view
- `app/Http/Controllers/` — Controller stubs (Auth, Dashboard, Data, Laporan)

### Setup lokal (setelah PHP tersedia)

```bash
composer create-project laravel/laravel .
# Salin file dari branch cursor/phase-1-637a
php artisan serve
```

### Demo login

- Admin: email mengandung "admin" → dashboard admin
- User: email lainnya → dashboard user

### Available system tools

- **Node.js**: v22 (via nvm)
- **npm**: v10
- **Python**: 3.12
- **Git**: 2.43
- **PHP/Composer**: Tidak tersedia di cloud VM (install lokal)
