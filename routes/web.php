<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\Admin\AdminUserController;

// Landing & Auth Routes
Route::get('/', [HomeController::class, 'landing'])->name('landing');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// OTP Verification Routes
Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify.otp.form');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');

// Forgot Password Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'sendForgotPasswordOtp'])->name('forgot.password.send');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('reset.password.form');
Route::post('/reset-password', [AuthController::class, 'verifyResetPassword'])->name('reset.password.verify');

// Payment Plan
Route::get('/payment-plan', [HomeController::class, 'paymentPlan'])->name('payment.plan')->middleware('auth');
Route::post('/payment-plan', [HomeController::class, 'selectPlan'])->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('movies', AdminMovieController::class);
    Route::resource('users', AdminUserController::class)->except(['create', 'store', 'show']);
});

// Protected Routes (requires auth and plan)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/my-list', [HomeController::class, 'myList'])->name('mylist');
    
    // Movie Routes
    Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movie.show');
    Route::get('/movie/{id}/play', [MovieController::class, 'play'])->name('movie.play');
    Route::post('/movie/{id}/watchlist', [MovieController::class, 'toggleWatchlist'])->name('movie.watchlist');
    Route::post('/movie/{id}/rating', [MovieController::class, 'storeRating'])->name('movie.rating');
    Route::post('/movie/{id}/comment', [MovieController::class, 'storeComment'])->name('movie.comment');
    Route::delete('/comment/{id}', [MovieController::class, 'deleteComment'])->name('comment.delete');
    
    // Category Routes
    Route::get('/category/{type}', [HomeController::class, 'category'])->name('category');
    Route::get('/genre/{genre}', [HomeController::class, 'genre'])->name('genre');
    
    // Platform Routes
    Route::get('/platform/{platform}', [PlatformController::class, 'show'])->name('platform');
    
    // Community Routes
    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::post('/community/comment', [CommunityController::class, 'storeComment'])->name('community.comment');
    Route::delete('/community/comment/{id}', [CommunityController::class, 'deleteComment'])->name('community.comment.delete');
    
    // Search
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    
    // Footer Pages
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
    Route::get('/support', [HomeController::class, 'support'])->name('support');
    Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
});
