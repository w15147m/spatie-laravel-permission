<?php

use App\Http\Controllers\ArticalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

    // Permission routes
    Route::prefix('permissions')->name('permission.')->group(function () {
        Route::get('/index', [permissionController::class, 'index'])->name('index');
        Route::get('/create', [permissionController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [permissionController::class, 'edit'])->name('edit');
        Route::post('/store', [permissionController::class, 'store'])->name('store');
        Route::put('/update/{id}', [permissionController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [permissionController::class, 'destroy'])->name('delete');
    });

    // Role routes
    Route::prefix('roles')->name('role.')->group(function () {
        Route::get('/index', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('delete');
    });
    // Role routes
    Route::resource('articles', ArticalController::class);
    //  GET|HEAD        articles .................... articles.index › ArticalController@index
    //  POST            articles .................... articles.store › ArticalController@store
    //  GET|HEAD        articles/create ........... articles.create › ArticalController@create
    //  GET|HEAD        articles/{article} ............ articles.show › ArticalController@show
    //  PUT|PATCH       articles/{article} ........ articles.update › ArticalController@update
    //  DELETE          articles/{article} ...... articles.destroy › ArticalController@destroy
    //  GET|HEAD        articles/{article}/edit ....... articles.edit › ArticalController@edit

    Route::resource('user', UserController::class);
    // GET|HEAD        user ............................................ user.index › ArticalController@index
    // POST            user ............................................ user.store › ArticalController@store
    // GET|HEAD        user/create ................................... user.create › ArticalController@create
    // GET|HEAD        user/{user} ....................................... user.show › ArticalController@show
    // PUT|PATCH       user/{user} ................................... user.update › ArticalController@update
    // DELETE          user/{user} ................................. user.destroy › ArticalController@destroy
    // GET|HEAD        user/{user}/edit .................................. user.edit › ArticalController@edit
    // GET|HEAD        verify-email ............ verification.notice › Auth\EmailVerificationPromptController
    // GET|HEAD        verify-email/{id}/{hash} ............ verification.verify › Auth\VerifyEmailController


});
require __DIR__ . '/auth.php';
