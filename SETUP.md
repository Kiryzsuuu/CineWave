# 🎬 CineWave Laravel - Panduan Setup Lengkap

## ✅ Status Konversi

Project **CineWave** telah berhasil dikonversi dari React ke Laravel!

### Yang Sudah Selesai:
- ✅ Laravel Project Structure
- ✅ Tailwind CSS Configuration
- ✅ Routes (Landing, Auth, Home, Movies)
- ✅ Controllers (Home, Movie, Auth, Platform, Community)
- ✅ Movie Model dengan Scopes
- ✅ Database Migration (Movies table)
- ✅ Movie Seeder (6 trending movies)
- ✅ Blade Views (Landing, Login, Register, Payment, Home, Movie Detail, Movie Player)
- ✅ Components (Header, Footer, Movie Card)
- ✅ Authentication Flow
- ✅ CSS Styling dengan Tailwind

## 🚀 Cara Menjalankan

### Step 1: Install Dependencies

```bash
cd d:\CineWave2\cinewave-laravel

# Install PHP packages
composer install

# Install Node packages
npm install
```

### Step 2: Setup Database

Database sudah di-migrate dan di-seed! Tapi jika perlu reset:

```bash
# Fresh migration
php artisan migrate:fresh

# Seed data
php artisan db:seed --class=MovieSeeder
```

### Step 3: Compile Assets

```bash
# Development mode dengan hot reload
npm run dev
```

**PENTING**: Biarkan `npm run dev` tetap running di terminal!

### Step 4: Jalankan Server (Terminal Baru)

Buka terminal PowerShell baru:

```bash
cd d:\CineWave2\cinewave-laravel
php artisan serve
```

### Step 5: Buka Browser

Akses: **http://localhost:8000**

## 🔐 Test Account

Belum ada default user. Silakan:
1. Klik "Get Started" di landing page
2. Register dengan email & password
3. Pilih payment plan
4. Masuk ke home page

## 📱 Fitur yang Bisa Dicoba

1. **Landing Page** (`/`)
   - Hero section dengan CTA
   - Features showcase
   - FAQ accordion (dengan Alpine.js)

2. **Authentication**
   - Register (`/register`)
   - Login (`/login`)
   - Payment Plan Selection (`/payment-plan`)

3. **Home Page** (`/home`)
   - Featured movie hero
   - Movie rows: Trending, Popular, New Releases, Action, Sci-Fi
   - Hover effects pada movie cards
   - Watchlist toggle

4. **Movie Detail** (`/movie/{id}`)
   - Full backdrop hero
   - Movie description
   - Cast information
   - Related movies
   - Play & Add to List buttons

5. **Movie Player** (`/movie/{id}/play`)
   - Video player placeholder
   - Back button
   - Movie info bar

6. **My List** (`/my-list`)
   - Watchlist collection

7. **Profile** (`/profile`)
   - User settings (template)

## 🎨 Styling & Theme

**Color Scheme:**
- Primary (Red): `#e50914`
- Secondary (Dark Red): `#831010`
- Background (Dark): `#141414`

**Tailwind Classes:**
- `bg-dark` - Background hitam
- `text-primary` - Warna merah Netflix
- `bg-primary` - Background merah
- `hover:bg-secondary` - Hover merah gelap

## 📊 Database

**Movies Table** sudah terisi dengan 6 film trending:
1. Quantum Nexus (Sci-Fi, Thriller, Action)
2. Shadow Protocol (Action, Spy, Drama)
3. The Last Expedition (Adventure, Mystery, Fantasy)
4. Crimson Dawn (Thriller, Crime, Mystery)
5. Realm of Legends (Fantasy, Epic, Adventure)
6. Nightfall Chronicles (Horror, Mystery, Thriller)

Setiap movie punya:
- Title, Image, Backdrop
- Genre (JSON array)
- Rating, Description
- Year, Duration
- Director, Cast (JSON array)
- Category

## 🛠 Troubleshooting

### CSS Tidak Muncul

```bash
# Pastikan npm run dev sedang berjalan
npm run dev

# Atau build untuk production
npm run build
```

### Halaman Blank / Error

```bash
# Clear cache
php artisan optimize:clear

# Check logs
tail storage/logs/laravel.log
```

### Migration Error

```bash
# Reset database
php artisan migrate:fresh --seed
```

### Alpine.js Tidak Bekerja

Pastikan di `resources/views/layouts/app.blade.php` ada:
```html
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

## 📁 File Structure

```
cinewave-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php       ✅ Home, Landing, Category
│   │   ├── MovieController.php      ✅ Detail, Player, Watchlist
│   │   ├── AuthController.php       ✅ Login, Register, Logout
│   │   ├── PlatformController.php   📝 Perlu implementasi
│   │   └── CommunityController.php  📝 Perlu implementasi
│   └── Models/
│       └── Movie.php                ✅ Model dengan scopes
├── database/
│   ├── migrations/
│   │   └── xxxx_create_movies_table.php  ✅
│   └── seeders/
│       └── MovieSeeder.php          ✅ 6 trending movies
├── resources/
│   ├── css/
│   │   └── app.css                  ✅ Tailwind + custom styles
│   ├── js/
│   │   └── app.js                   ✅ Alpine.js import
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php        ✅ Main layout
│       │   └── guest.blade.php      ✅ Guest layout
│       ├── components/
│       │   ├── header.blade.php     ✅ Navigation
│       │   ├── footer.blade.php     ✅ Footer
│       │   └── movie-card.blade.php ✅ Reusable card
│       ├── auth/
│       │   ├── login.blade.php      ✅
│       │   └── register.blade.php   ✅
│       ├── payment/
│       │   └── plan.blade.php       ✅ 3 plans
│       ├── movie/
│       │   ├── show.blade.php       ✅ Detail page
│       │   └── play.blade.php       ✅ Player page
│       ├── landing.blade.php        ✅ Hero + Features + FAQ
│       ├── home.blade.php           ✅ Movie catalog
│       ├── mylist.blade.php         📝 Perlu dibuat
│       ├── profile.blade.php        📝 Perlu dibuat
│       ├── category.blade.php       📝 Perlu dibuat
│       └── genre.blade.php          📝 Perlu dibuat
├── routes/
│   └── web.php                      ✅ Semua routes defined
└── tailwind.config.js               ✅ Custom colors
```

## 🎯 Next Steps (Opsional)

### Halaman yang Belum Dibuat:

1. **My List Page** (`mylist.blade.php`)
2. **Profile Page** (`profile.blade.php`)
3. **Category Page** (`category.blade.php`)
4. **Genre Page** (`genre.blade.php`)
5. **Community Page** (`community.blade.php`)
6. **Platform Page** (`platform.blade.php`)
7. **Search Modal** (component)
8. **Notification Panel** (component)

### Fitur Enhancement:

1. **Tambah lebih banyak movies** - Edit `MovieSeeder.php`
2. **Real Video Player** - Integrate Video.js atau Plyr.io
3. **AJAX Watchlist** - Real-time tanpa page reload
4. **Search Functionality** - Live search dengan autocomplete
5. **User Reviews** - Rating dan review system
6. **Admin Panel** - Manage movies, users
7. **API Integration** - TMDB API untuk real movie data

## 📞 Support

Jika ada masalah, check:
1. `storage/logs/laravel.log` - Laravel errors
2. Browser console - JavaScript errors
3. `npm run dev` output - Build errors

## 🎉 Selesai!

Project sudah ready to use! Silakan explore dan customize sesuai kebutuhan.

**Dokumentasi lengkap ada di `KONVERSI_CINEWAVE.md`**
