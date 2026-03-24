<?php

use App\Http\Controllers\Admin\AdminArtistController;
use App\Http\Controllers\Admin\AdminArtworkController;
use App\Http\Controllers\Admin\AdminExhibitionController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Exhibitions
Route::get('/now', [ExhibitionController::class, 'now'])->name('exhibitions.now');
Route::get('/soon', [ExhibitionController::class, 'soon'])->name('exhibitions.soon');
Route::get('/past', [ExhibitionController::class, 'past'])->name('exhibitions.past');
Route::get('/exhibition/{slug}', [ExhibitionController::class, 'show'])->name('exhibitions.show');

// Artists
Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artist/{slug}', [ArtistController::class, 'show'])->name('artists.show');

// Available Works
Route::get('/available', [ArtworkController::class, 'available'])->name('artworks.available');
Route::get('/artwork/{slug}', [ArtworkController::class, 'show'])->name('artworks.show');

// Shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Info & Press
Route::get('/info', [PageController::class, 'info'])->name('pages.info');
Route::get('/press', [PageController::class, 'press'])->name('pages.press');

// Admin (protected by auth middleware)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('exhibitions', AdminExhibitionController::class);
    Route::resource('artists', AdminArtistController::class);
    Route::resource('artworks', AdminArtworkController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('news', AdminNewsController::class);
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
