<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\FaqItemController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// News routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{newsItem}', [NewsController::class, 'show'])->name('news.show');

// FAQ routes
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

// Contact routes
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Authentication routes
require __DIR__.'/auth.php';

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // User management
    Route::resource('users', UserController::class);

    // News management
    Route::resource('news', AdminNewsController::class);

    // FAQ management
    Route::resource('faq/categories', AdminFaqController::class);
    Route::resource('faq/items', AdminFaqController::class);

    // Contact messages
    Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index');
    Route::delete('/contact/{message}', [AdminContactController::class, 'destroy'])->name('contact.destroy');
});

// Public Profile Routes
Route::get('/users/{user}', [ProfileController::class, 'show'])->name('profile.show');
