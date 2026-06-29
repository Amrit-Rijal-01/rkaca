# AGENTS.md

## Project
Laravel 12 CMS (accounting/consulting firm). PHP 8.2+, Vite + Tailwind v4, SQLite default, database queue, role-based auth (`admin`/`user`).

## Structure
```
app/Http/Controllers/
  Auth/        # login, register, password reset
  Admin/       # 22 CRUD controllers
  Front/       # 12 public controllers
  *.php        # misc/legacy root-level controllers
app/Models/    # 33 Eloquent models
app/Helpers/   # JumbotronHelper, SeoHelper
app/Mail/      # AppointmentBooked
database/migrations/  # 55 files
database/seeders/     # 19 classes
resources/views/admin/ front/ auth/ components/ layouts/ partials/
routes/web.php        # all routes (~430 lines)
```

## Routing

| Section | Prefix | Middleware |
|---|---|---|
| Public | `/` | none |
| Auth | `/login`, `/register` | none |
| Admin | `/admin/*` | `auth` |
| Appointments | `/consultation`, `/appointments` | none |
| Search | `/search`, `/api/search` | none — returns JSON |
| Newsletter | `/newsletter/*` | none |

Admin routes use `Route::resource()->names([...])`. Toggles/bulk ops are individual named routes.

⚠️ `/consultation` is defined **twice** in `web.php`. Do not add more — consolidate if editing.

## Controllers
- **Admin\***: index/create/store/edit/update/destroy + `toggleStatus()`/`toggleFeatured()`. Images stored to `public` disk.
- **Front\***: Thin — load data, pass to Blade. Logic belongs in models/helpers.
- **Auth\***: login, register, password reset.

## Models
Always use `$fillable` (never `$guarded = []`). Declare `$casts` for booleans/JSON. Cache invalidation uses `boot()` with `saved`/`deleted` events — see `Jumbotron` as canonical example.

| Model | Table | Notes |
|---|---|---|
| `User` | `users` | `isAdmin()` / `isUser()`; roles: `admin`, `user` |
| `Jumbotron` | `jumbotrons` | Hero banner; single & multi-slide |
| `Service` | `services` | `status`: `active`/`inactive` |
| `Industry` | `industries` | `status` field |
| `Insight` | `insights` | `is_active` (bool), `is_featured` (bool) |
| `Blog` | `blogs` | **Legacy.** `status`: `published`/`draft` |
| `Post` | `posts` | **Preferred** blog system; has tags/categories |
| `Event` | `events` | `status` field |
| `Career` | `careers` | Career landing content |
| `JobOpening` | `job_openings` | Job listings |
| `JobApplication` | `job_applications` | Applicant submissions |
| `Appointment` | `appointments` | Consultation bookings |
| `Newsletter` | `newsletters` | Email subscriptions |
| `Office` | `offices` | Physical locations |
| `NavigationSetting` | `navigation_settings` | CMS nav |
| `HomeSetting` | `home_settings` | CMS homepage |
| `FooterSetting` | `footer_settings` | CMS footer |
| `About` | `abouts` | About page content |

## Helpers

**`JumbotronHelper`** — never query `Jumbotron` directly; always use this.
```php
JumbotronHelper::getJumbotron('services');
JumbotronHelper::getSlides('home');
JumbotronHelper::getJumbotronWithFallback('about', ['title' => 'About Us']);
JumbotronHelper::clearCache($slug); // manual only — Eloquent events auto-clear
```
Cache TTL: 3600s. **Manual DB updates bypass events — call `clearCache()` yourself.**

**`SeoHelper`** — SEO meta tags for layouts. ⚠️ Stub file — verify contents before use.

## Auth
- Email + password only.
- `Auth::user()->isAdmin()` → `role === 'admin'`.
- `auth` middleware on all `/admin/*` routes.
- No email verification (`MustVerifyEmail` commented out in `User`).

## Frontend
Entry points: `resources/css/app.css`, `resources/js/app.js`.
- `composer run dev` — starts PHP + queue + Pail + Vite together.
- `npm run build` — production build.

## Setup
```bash
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate --seed
composer run dev   # http://localhost:8000 | admin at /admin
php artisan test
```

## Code Style
- PSR-12; run `./vendor/bin/pint` before committing.
- No raw PHP in Blade; use components/directives.
- Sanitise rich text with `mews/purifier`.
- Images: `Storage::disk('public')` + `php artisan storage:link`.

## Pitfalls
1. **Duplicate routes**: `/consultation` defined twice. Check before adding routes.
2. **Two blog systems**: `Blog` (legacy) vs `Post`/`Category`/`Tag` (preferred). Use `Post` for new work.
3. **Status inconsistency**: `Insight` → `is_active` (bool); `Blog` → `status` string. Don't mix.
4. **Jumbotron cache**: Eloquent events fire on model saves. Manual DB updates do not — call `JumbotronHelper::clearCache($slug)` explicitly.
5. **SeoHelper** is a stub — verify before use.
6. **Search fallback**: Returns hardcoded data when DB is empty. Remove or gate in production.