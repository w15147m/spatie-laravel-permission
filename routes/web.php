<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\RoleController;
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
   
    // ****** Permission routes
    Route::get('/permissions/list', [permissionController::class, 'index'])->name('permission.list');
    Route::get('/permissions/create', [permissionController::class, 'create'])->name('permission.create');
    Route::get('/permissions/edit/{id}', [permissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permissions/store', [permissionController::class, 'store'])->name('permission.store');
    Route::put('/permissions/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permission.delete');


    // ****** roles routes
    Route::get('/roles/list', [RoleController::class, 'index'])->name('role.list');
    Route::get('/roles/create', [roleController::class, 'create'])->name('role.create');
    Route::get('/roles/edit/{id}', [roleController::class, 'edit'])->name('role.edit');
    Route::post('/roles/store', [roleController::class, 'store'])->name('role.store');
    Route::put('/roles/update/{id}', [roleController::class, 'update'])->name('role.update');
    Route::delete('/roles/delete/{id}', [roleController::class, 'destroy'])->name('role.delete');


});

require __DIR__.'/auth.php';
