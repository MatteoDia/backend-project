<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\FaqItemController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{newsItem}', [NewsController::class, 'show'])->name('news.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // News Management
    Route::get('/news', [AdminNewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [AdminNewsController::class, 'create'])->name('news.create');
    Route::post('/news', [AdminNewsController::class, 'store'])->name('news.store');
    Route::get('/news/{newsItem}/edit', [AdminNewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{newsItem}', [AdminNewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{newsItem}', [AdminNewsController::class, 'destroy'])->name('news.destroy');
    Route::post('/news/{newsItem}/toggle-publish', [AdminNewsController::class, 'togglePublish'])->name('news.toggle-publish');

    // FAQ Management
    Route::get('/faq/categories/create', [FaqCategoryController::class, 'create'])->name('faq.categories.create');
    Route::post('/faq/categories', [FaqCategoryController::class, 'store'])->name('faq.categories.store');
    Route::get('/faq/categories/{category}/edit', [FaqCategoryController::class, 'edit'])->name('faq.categories.edit');
    Route::put('/faq/categories/{category}', [FaqCategoryController::class, 'update'])->name('faq.categories.update');
    Route::delete('/faq/categories/{category}', [FaqCategoryController::class, 'destroy'])->name('faq.categories.destroy');

    Route::get('/faq/items/create', [FaqItemController::class, 'create'])->name('faq.items.create');
    Route::post('/faq/items', [FaqItemController::class, 'store'])->name('faq.items.store');
    Route::get('/faq/items/{faqItem}/edit', [FaqItemController::class, 'edit'])->name('faq.items.edit');
    Route::put('/faq/items/{faqItem}', [FaqItemController::class, 'update'])->name('faq.items.update');
    Route::delete('/faq/items/{faqItem}', [FaqItemController::class, 'destroy'])->name('faq.items.destroy');
    Route::post('/faq/items/{faqItem}/move-up', [FaqItemController::class, 'moveUp'])->name('faq.items.move-up');
    Route::post('/faq/items/{faqItem}/move-down', [FaqItemController::class, 'moveDown'])->name('faq.items.move-down');

    // Contact Management
    Route::get('/contact', [ContactController::class, 'adminIndex'])->name('contact.index');
    Route::get('/contact/{message}', [ContactController::class, 'show'])->name('contact.show');
    Route::delete('/contact/{message}', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::post('/contact/{message}/read', [ContactController::class, 'markAsRead'])->name('contact.read');
    Route::post('/contact/{message}/unread', [ContactController::class, 'markAsUnread'])->name('contact.unread');

    // User Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggle-admin');
});

// Public Profile Routes
Route::get('/users/{user}', [ProfileController::class, 'show'])->name('profile.show');

require __DIR__.'/auth.php';
