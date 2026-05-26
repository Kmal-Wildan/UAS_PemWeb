# AGENTS.md

## Repository state

Branch **`phase-3-demo-ready`** — project Laravel lengkap siap demo presentasi.

## PHP requirement

**Use PHP 8.4.x** for local development and demo.

- Recommended: PHP **8.4**
- Also works: PHP 8.2, 8.3
- **Not supported:** PHP 8.5+ (locked `phpoffice/phpspreadsheet` requires `<8.5.0`)

Required extensions: `zip`, `mbstring`, `openssl`, `pdo_sqlite`, `fileinfo`, `curl`, `gd`

Verify before setup:
```bash
php -v    # should show 8.4.x
php -m    # should include zip
```

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan serve
```

## Demo accounts

- Admin: `admin@gmail.com` / `password123`
- User: `user@gmail.com` / `password123`

## Demo guide

Lihat **[DEMO.md](DEMO.md)** untuk checklist, urutan presentasi, dan troubleshooting.

## Available tools (cloud VM)

- PHP 8.3 (cloud) — local dev should use **PHP 8.4**
- Composer 2.x
- Node.js v22, npm v10
- Python 3.12, Git 2.43
