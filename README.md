# CineWave - Laravel Streaming Platform

Project CineWave telah berhasil dikonversi dari React + TypeScript ke Laravel + Blade + Tailwind CSS.

## 🚀 Quick Start

```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
copy .env.example .env
php artisan key:generate

# 3. Setup database
php artisan migrate
php artisan db:seed --class=MovieSeeder

# 4. Compile assets & run
npm run dev
php artisan serve
```

Akses: `http://localhost:8000`

## 📋 Fitur yang Sudah Diimplementasi

✅ **Authentication** - Login, Register, Payment Plan
✅ **Movie Catalog** - Trending, Popular, New Releases, Action, Sci-Fi
✅ **Movie Details** - Full info dengan cast, director, genres
✅ **Movie Player** - Video player page
✅ **Watchlist** - Add/remove movies to My List
✅ **Responsive Design** - Netflix-style dark theme
✅ **Interactive UI** - Alpine.js components

## 📁 Struktur Lengkap

Semua file penting sudah dibuat:
- Routes: `routes/web.php`
- Controllers: HomeController, MovieController, AuthController
- Models: Movie dengan scopes dan casts
- Views: Landing, Auth, Home, Movie detail/player
- Components: Header, Footer, Movie Card
- Migrations & Seeders: Movies table dengan sample data

## 📚 Dokumentasi Detail

Lihat `KONVERSI_CINEWAVE.md` untuk dokumentasi lengkap konversi dan panduan development.

## 🎨 Technology Stack

- Laravel 11
- Tailwind CSS 3
- Alpine.js
- SQLite/MySQL
- Vite

---

**Original React App**: `d:\CineWave2\project-pemweb` (branch: tampilan)


Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
