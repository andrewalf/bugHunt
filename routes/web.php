<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', ProductController::class . '@index')->name('products.list');
    Route::delete('/{id}', ProductController::class . '@destroy')->name('products.delete');
    Route::get('/{id}/edit', ProductController::class . '@edit')->name('products.forms.edit');
});
