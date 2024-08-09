<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', ProductController::class . '@index')->name('products.list');
    Route::delete('/{id}', ProductController::class . '@destroy')->name('products.delete');
    Route::post('/', ProductController::class . '@store')->name('products.create');
    Route::post('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.forms.edit');
    Route::get('/create', ProductController::class . '@create')->name('products.forms.create');
});
