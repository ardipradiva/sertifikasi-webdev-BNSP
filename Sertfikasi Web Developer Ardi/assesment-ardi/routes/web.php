<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

// alias /admin.php
Route::get('/admin.php', [AdminController::class, 'dashboard'])->name('admin');

// default
Route::get('/', fn() => redirect()->route('admin'));
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// product
Route::resource('products', ProductController::class);
Route::get('products-export/csv', [ProductController::class, 'exportCsv'])->name('products.export.csv');
