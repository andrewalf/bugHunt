<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductExportController;
use App\Http\Controllers\ProductImportController;
use App\Http\Controllers\QaHelperController;
use App\Http\Middleware\SuperPuperAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page.main');
});

//Route::middleware('auth')->prefix('products')->group(function () {
Route::middleware([SuperPuperAuthMiddleware::class])->prefix('products')->group(function () {
    Route::get('/export', [ProductExportController::class, 'index'])->name('products.export');
    Route::get('/import/example', [ProductImportController::class, 'downloadExampleFile'])->name('products.import_example');
    Route::get('/', ProductController::class . '@index')->name('products.list');
    Route::delete('/{product}', ProductController::class . '@destroy')->name('products.delete');
    Route::post('/', ProductController::class . '@store')->name('products.create');
    Route::post('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.forms.edit');
    Route::get('/create', ProductController::class . '@create')->name('products.forms.create');
    Route::get('/create/import', ProductController::class . '@import')->name('products.forms.import');
    Route::post('/import', [ProductImportController::class, 'index'])->name('products.import');
});

Route::withoutMiddleware([SuperPuperAuthMiddleware::class])->prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.forms.login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('auth.forms.register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('/logs', [LogController::class, 'index']);

Route::get('/qa/i_want_to_test', [QaHelperController::class, 'gitCheckout'])->name('git.checkout');
