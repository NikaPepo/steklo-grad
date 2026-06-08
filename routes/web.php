<?php

use App\Http\Controllers\AdminDashboard\AlbumController;
use App\Http\Controllers\AdminDashboard\CategoryController;
use App\Http\Controllers\AdminDashboard\AlbumImageController;
use App\Http\Controllers\AdminDashboard\ContactRequestController;
use App\Http\Controllers\AdminDashboard\OptionController;
use App\Http\Controllers\AdminDashboard\ProductController;
use App\Http\Controllers\AdminDashboard\ReviewController;
use App\Http\Controllers\AdminDashboard\ServiceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Guest\AboutController;
use App\Http\Controllers\Guest\CategoryController as CategoryControllerGuest;
use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\Guest\ContactRequestController as ContactRequestControllerGuest;
use App\Http\Controllers\Guest\GalleryController;
use App\Http\Controllers\Guest\PrivacyPolicyController;
use App\Http\Controllers\Guest\ProductController as ProductControllerGuest;
use App\Http\Controllers\Guest\ReviewController as ReviewControllerGuest;
use App\Http\Controllers\Guest\ServiceController as ServiceControllerGuest;
use App\Http\Controllers\Guest\WelcomePageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomePageController::class, 'index'])->name('welcome');

Route::prefix('categories')->group(function () {
    Route::get('/{path}', [CategoryControllerGuest::class, 'show'])->where('path', '.*')->name('category.show');
});

Route::prefix('products')->group(function () {
    Route::get('{product:slug}', [ProductControllerGuest::class, 'show'])
        ->name('product.show');
});

Route::prefix('services')->group(function () {
    Route::get('/', [ServiceControllerGuest::class, 'index'])->name('services.index');
    Route::get('{service:slug}', [ServiceControllerGuest::class, 'show'])->name('service.show');
});

Route::get('about', [AboutController::class, 'index'])->name('about.index');
Route::get('contacts',[ContactController::class, 'index'])->name('contacts.index');
Route::get('privacy-policy',[PrivacyPolicyController::class, 'index'])->name('privacy.index');
Route::get('gallery',[GalleryController::class, 'index'])->name('gallery.index');
Route::post('contact-request',[ContactRequestControllerGuest::class, 'store'])->name('contact-request.store');

Route::prefix('reviews')->group(function () {
    Route::get('/',[ReviewControllerGuest::class, 'index'])->name('reviews.index');
    Route::post('/request', [ReviewControllerGuest::class, 'store'])->name('review-request.store');
});

Route::prefix('admin')->middleware('guest')->group(function () {
    Route::prefix('login')->group(function () {
        Route::get('/', [AuthController::class, 'showLoginForm'])->name('login-form');
        Route::post('/', [AuthController::class, 'login'])->name('login');
    });
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::prefix('dashboard',)->group(function () {
        Route::get('/', [ContactRequestController::class, 'index'])->name('dashboard');
        Route::post('/', [ContactRequestController::class, 'store'])->name('contact-request.store');
        Route::put('/{contactRequest}', [ContactRequestController::class, 'update'])->name('contact-request.update');
        Route::delete('/{contactRequest}', [ContactRequestController::class, 'destroy'])->name('contact-request.destroy');
    });
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::post('/list', [CategoryController::class, 'list'])->name('categories.list');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    });
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::post('/parentList', [ProductController::class, 'parentList'])->name('products.parentList');
    });
    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('services');
        Route::post('/', [ServiceController::class, 'store'])->name('services.store');
        Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
        Route::put('/{service}', [ServiceController::class, 'update'])->name('services.update');
    });
    Route::prefix('albums')->group(function () {
        Route::get('/', [AlbumController::class, 'index'])->name('albums');
        Route::post('/', [AlbumController::class, 'store'])->name('albums.store');
        Route::delete('/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');
        Route::put('/{album}', [AlbumController::class, 'update'])->name('albums.update');
        Route::post('/list', [AlbumController::class, 'list'])->name('albums.list');
    });
    Route::prefix('album-images')->group(function () {
        Route::get('/', [AlbumImageController::class, 'index'])->name('album-images');
        Route::post('/', [AlbumImageController::class, 'store'])->name('album-images.store');
        Route::delete('/{albumImage}', [AlbumImageController::class, 'destroy'])->name('album-images.destroy');
        Route::put('/{albumImage}', [AlbumImageController::class, 'update'])->name('album-images.update');
    });
    Route::prefix('reviews')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('reviews');
        Route::post('/', [ReviewController::class, 'store'])->name('reviews.store');
        Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::put('/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    });
    Route::prefix('options')->group(function () {
        Route::get('/', [OptionController::class, 'index'])->name('options');
        Route::post('/', [OptionController::class, 'store'])->name('options.store');
        Route::delete('/{option}', [OptionController::class, 'destroy'])->name('options.destroy');
        Route::put('/{option}', [OptionController::class, 'update'])->name('options.update');
    });
});