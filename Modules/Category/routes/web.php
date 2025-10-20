<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('categories', CategoryController::class)->names('category');
// });

Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
});
