# AGENTS.md

## Cursor Cloud specific instructions

### Repository state

- **Progres I** (`cursor/phase-1-637a`): Blade views, layout, CSS/JS
- **Progres II** (`cursor/phase-2-637a`): Migration, Model, Controller, Middleware, Seeder, Export PDF/Excel

### Setup lokal

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

### Demo login

- Admin: `admin@example.com` / `password`
- User: `user@example.com` / `password`

### Available system tools

- **Node.js**: v22 (via nvm)
- **npm**: v10
- **Python**: 3.12
- **Git**: 2.43
- **PHP/Composer**: Install lokal (tidak tersedia di cloud VM)

### Middleware

- `auth` — wajib login
- `role:admin` — hanya admin
- `role:user` — hanya user
- `role:admin,user` — admin dan user (read access)
