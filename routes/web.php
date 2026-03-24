<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Public uploads (bypasses public/storage symlink; fixes 403 on some hosts)
Route::get('/media/{path}', function (string $path) {
    $normalized = ltrim(str_replace('\\', '/', $path), '/');
    if ($normalized === '' || str_contains($normalized, '..')) {
        abort(404);
    }

    $disk = Storage::disk('public');
    if (! $disk->exists($normalized)) {
        abort(404);
    }

    return $disk->response($normalized);
})->where('path', '.*')->name('storage.public');

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

require __DIR__.'/auth.php';
