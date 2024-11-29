<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::get('/product-registration', [ProductController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('product-registration');

Route::get('/product-visualization', function () {
    return view('product-visualization');
})->middleware(['auth', 'verified'])->name('product-visualization');

Route::get('/product-visualization', [ProductController::class, 'visualizar'])->middleware(['auth', 'verified'])->name('product-visualization');
Route::get('/produto/{id}', [ProductController::class, 'getProduto']);

Route::post('/enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');
Route::post('/produtos', [ProductController::class, 'store'])->name('produtos.store');

Route::get('/painel', [DashboardController::class, 'index'])->name('painel');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
