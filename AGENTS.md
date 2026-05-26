# AGENTS.md

## Repository state

Branch **`phase-3-demo-ready`** — project Laravel lengkap siap demo presentasi.

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

- PHP 8.3, Composer
- Node.js v22, npm v10
- Python 3.12, Git 2.43
