# Fine Gas Online - CodeIgniter 4 Application

## Project Structure

```
app/
├── Controllers/       # Public pages (Home, About, Service, Product, etc.) + Admin/
├── Config/            # Routes, Database, Filters, etc.
├── Models/            # Database models
├── Views/             # Pages, admin layouts, partials
├── Helpers/           # Custom helpers
├── Libraries/         # GoogleAuthenticator
├── Filters/           # AdminAuthFilter
└── Database/Migrations/

public/                # Web root (entry point is public/index.php)
writable/              # Logs, sessions, uploads, cache
tests/                 # PHPUnit tests
vendor/                # Composer dependencies
```

## Key Commands

- `php spark serve` - Start local dev server (requires PHP 8.2+)
- `php spark migrate` - Run database migrations
- `php spark migrate:status` - Check migration status
- `composer test` - Run PHPUnit tests
- `php spark` - List all CLI commands

## Routes

Public routes: `/`, `/about`, `/service`, `/product`, `/feature`, `/quote`, `/team`, `/testimonial`, `/safety-tips`, `/contact`

Admin routes (protected): `/admin`, `/admin/home`, `/admin/profile`, `/admin/settings`, `/admin/users`

Auth routes: `/login`, `/logout`, `/forgot-password`, `/reset-password/(:any)`

## Database

MySQL: `finegas_website` (configured in `.env`). Admin users table via migration at `app/Database/Migrations/2026-05-07-000001_CreateAdminUsersTable.php`.

## Important Notes

- Entry point is `public/index.php`, not root (CI4 standard)
- Admin routes use `admin_auth` filter for protection
- Uses MySQLi driver, requires `mysqlnd` extension
- Session storage in `writable/session/`
- Logs in `writable/logs/`

## Testing

PHPUnit configured in `phpunit.xml.dist`. Tests bootstrap via `vendor/codeigniter4/framework/system/Test/bootstrap.php`.