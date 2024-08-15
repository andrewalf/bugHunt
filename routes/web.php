<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductExportController;
use App\Http\Controllers\ProductImportController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/export', [ProductExportController::class, 'index'])->name('products.export');
    Route::get('/import/example', [ProductImportController::class, 'downloadExampleFile'])->name('products.import_example');
    Route::get('/', ProductController::class . '@index')->name('products.list');
    Route::delete('/{id}', ProductController::class . '@destroy')->name('products.delete');
    Route::post('/', ProductController::class . '@store')->name('products.create');
    Route::post('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.forms.edit');
    Route::get('/create', ProductController::class . '@create')->name('products.forms.create');
    Route::get('/create/import', ProductController::class . '@import')->name('products.forms.import');
    Route::post('/import', [ProductImportController::class, 'index'])->name('products.import');
});
