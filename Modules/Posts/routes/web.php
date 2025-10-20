<?php

use Illuminate\Support\Facades\Route;
use Modules\Posts\Http\Controllers\PostsController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('posts', PostsController::class)->names('posts');
// });

Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('index');
    Route::get('/create', [PostsController::class, 'create'])->name('create');
    Route::post('/', [PostsController::class, 'store'])->name('store');
    Route::get('/{post}', [PostsController::class, 'show'])->name('show');
    Route::get('/{post}/edit', [PostsController::class, 'edit'])->name('edit');
    Route::put('/{post}', [PostsController::class, 'update'])->name('update');
    Route::delete('/{post}', [PostsController::class, 'destroy'])->name('destroy');
});
