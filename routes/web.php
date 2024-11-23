<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\permissionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/permissions/list', [permissionController::class, 'index'])->name('permission.list');
    Route::get('/permissions/create', [permissionController::class, 'create'])->name('permission.create');
    Route::post('/permissions/store', [permissionController::class, 'store'])->name('permission.store');
});

require __DIR__.'/auth.php';
