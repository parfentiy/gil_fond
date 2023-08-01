<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/catalog', [\App\Http\Controllers\CatalogController::class, 'index']);

    Route::post('/add-to-cart', [\App\Http\Controllers\CartController::class, 'create'])->name('addToCart');
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('showCart');
    Route::post('/delete-cart', [\App\Http\Controllers\CartController::class, 'delete'])->name('deleteFromCart');
    Route::get('/clear-cart', [\App\Http\Controllers\CartController::class, 'clear']);

    Route::post('/add-order', [\App\Http\Controllers\OrderController::class, 'add']);
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index']);
    Route::post('/delete-order', [\App\Http\Controllers\OrderController::class, 'delete']);

});

require __DIR__.'/auth.php';
