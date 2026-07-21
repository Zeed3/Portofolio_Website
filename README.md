# My Portfolio Website

My personal portfolio website, built as a Laravel application.

> Tech: Laravel 13 · PHP 8.5 · Blade · plain CSS · Docker
> Database: none. The site is entirely static content served through Laravel.

---

## Project structure

```
app/Http/Controllers/PortfolioController.php   # all page content, as arrays
routes/web.php                                 # GET / → PortfolioController@index
resources/views/portfolio.blade.php            # the page, driven by @foreach loops
resources/views/partials/icon.blade.php        # inline SVG icon helper
public/css/styles.css                          # stylesheet (served via asset())
Dockerfile, docker-compose.yml                 # containerised run
```

---

## Local host the website

### Option A: Docker (no PHP needed)

Requires only Docker Desktop. From the project root:

```bash
docker compose up --build
```

Then open <http://localhost:8000>. The container creates its own `.env`,
generates an app key on first run, and serves the site. Stop it with `Ctrl+C`
(or `docker compose down`).

### Option B: Local PHP

Requires **PHP 8.2+** and **Composer**.

```bash
composer install
cp .env.example .env        # Windows: copy .env.example .env
php artisan key:generate
php artisan serve
```

Then open <http://localhost:8000>.