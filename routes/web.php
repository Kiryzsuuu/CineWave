<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\CommunityController;

// Landing & Auth Routes
Route::get('/', [HomeController::class, 'landing'])->name('landing');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Payment Plan
Route::get('/payment-plan', [HomeController::class, 'paymentPlan'])->name('payment.plan')->middleware('auth');
Route::post('/payment-plan', [HomeController::class, 'selectPlan'])->middleware('auth');

// Protected Routes (requires auth and plan)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/my-list', [HomeController::class, 'myList'])->name('mylist');
    
    // Movie Routes
    Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movie.show');
    Route::get('/movie/{id}/play', [MovieController::class, 'play'])->name('movie.play');
    Route::post('/movie/{id}/watchlist', [MovieController::class, 'toggleWatchlist'])->name('movie.watchlist');
    
    // Category Routes
    Route::get('/category/{type}', [HomeController::class, 'category'])->name('category');
    Route::get('/genre/{genre}', [HomeController::class, 'genre'])->name('genre');
    
    // Platform Routes
    Route::get('/platform/{platform}', [PlatformController::class, 'show'])->name('platform');
    
    // Community Routes
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::post('/community/post', [CommunityController::class, 'post'])->name('community.post');
    
    // Search
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    
    // Footer Pages
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
    Route::get('/support', [HomeController::class, 'support'])->name('support');
    Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
});
