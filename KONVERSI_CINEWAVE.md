# Panduan Konversi CineWave dari React ke Laravel

## Status Konversi

### ✅ Selesai
1. **Project Laravel** sudah dibuat
2. **Tailwind CSS** sudah diinstall dan dikonfigurasi
3. **Routes** sudah didefinisikan di `routes/web.php`
4. **Controllers** sudah dibuat:
   - HomeController
   - MovieController
   - AuthController
   - PlatformController
   - CommunityController
5. **Model & Migration** untuk Movies sudah dibuat
6. **Migration movies** sudah disesuaikan dengan struktur data

### 🔄 Perlu Dilengkapi

#### 1. Selesaikan CSS & Assets
```bash
cd d:\CineWave2\cinewave-laravel

# Edit resources/css/app.css
# Tambahkan Tailwind directives
```

File `resources/css/app.css` perlu berisi:
```css
@tailwind base;
@tailwind components;
@tailwind utilities;

/* Custom styles dari React app */
```

#### 2. Install NPM dependencies dan compile
```bash
npm install
npm install alpinejs
npm run dev
```

#### 3. Run Migrations
```bash
php artisan migrate
```

#### 4. Seed Database dengan Data Movies
File `database/seeders/MovieSeeder.php` perlu diisi dengan data dari React app.

#### 5. Implementasi Controllers
Setiap controller perlu diisi dengan logic:
- **HomeController**: landing, home, profile, myList, category, genre, search
- **MovieController**: show (detail), play, toggleWatchlist
- **AuthController**: login, register, logout
- **PlatformController**: show platform content
- **CommunityController**: community feed

#### 6. Buat Blade Views
Struktur views yang diperlukan:
```
resources/views/
├── layouts/
│   ├── app.blade.php (main layout)
│   └── guest.blade.php (untuk landing/auth)
├── landing.blade.php
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── payment/
│   └── plan.blade.php
├── home.blade.php
├── movie/
│   ├── show.blade.php (detail)
│   └── play.blade.php
├── profile.blade.php
├── mylist.blade.php
├── category.blade.php
├── genre.blade.php
├── platform.blade.php
├── community.blade.php
└── components/
    ├── header.blade.php
    ├── footer.blade.php
    ├── movie-card.blade.php
    ├── movie-row.blade.php
    └── hero-slider.blade.php
```

## Fitur React yang Perlu Dikonversi

### State Management
React menggunakan `useState` dan `localStorage`. Di Laravel:
- **Session** untuk user state
- **Database** untuk persistent data (watchlist, user preferences)
- **Middleware** untuk auth check

### Routing
React menggunakan state untuk routing. Di Laravel:
- Gunakan Laravel routes (sudah dibuat)
- Middleware untuk protected routes
- Named routes untuk navigasi

### Data Movies
Data movies dari `src/data/movies.ts` perlu di-seed ke database.

### Interactive Features
- **Search**: Implementasi di HomeController::search
- **Watchlist**: Toggle via AJAX/Livewire
- **Player**: Video player page
- **Community Feed**: Post dan comment system

## Langkah Selanjutnya

1. **Setup Assets & Compile**
   ```bash
   npm install
   npm run dev
   ```

2. **Jalankan Migration**
   ```bash
   php artisan migrate
   ```

3. **Seed Data**
   ```bash
   php artisan db:seed --class=MovieSeeder
   ```

4. **Start Development Server**
   ```bash
   php artisan serve
   ```

5. **Buat Blade Views** satu per satu, mulai dari:
   - Layout (app.blade.php)
   - Landing page
   - Login/Register
   - Home
   - Movie detail
   - Movie player

## Catatan Penting

- **Styling**: Gunakan Tailwind CSS yang sama seperti React app
- **Images**: Path image dari Unsplash sudah ada di data movies
- **Authentication**: Gunakan Laravel Breeze atau custom auth
- **Video Player**: Bisa gunakan Video.js atau HTML5 video player
- **Interactivity**: Pertimbangkan Alpine.js (sudah kompatibel dengan Tailwind) atau Livewire untuk reactive components

## File React Sumber
Lokasi: `d:\CineWave2\project-pemweb\Downloads\Tampilan CineWave\`
- Component files di `src/components/`
- Data di `src/data/`
- Styles di `src/styles/`

## Tips Konversi
1. **Baca component React** untuk memahami UI structure
2. **Convert JSX to Blade** dengan syntax:
   - `{variable}` → `{{ $variable }}`
   - `{condition && <Component />}` → `@if($condition) ... @endif`
   - `map()` → `@foreach` loop
3. **State → Session/Database**
4. **Props → View data**
