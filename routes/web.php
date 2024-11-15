<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/product-registration', function () {
    return view('product-registration');
})->middleware(['auth', 'verified'])->name('product-registration');

Route::get('/product-visualization', function () {
    return view('product-visualization');
})->middleware(['auth', 'verified'])->name('product-visualization');

Route::get('/product-visualization', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('product-visualization');


Route::get('/produtos/create', [ProductController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProductController::class, 'store'])->name('produtos.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
