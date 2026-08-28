<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/movies/{movie}', [GalleryController::class, 'show'])->name('gallery.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('movies', MovieController::class)->except('show');
});
