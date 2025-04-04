<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\CrudUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');

Route::get('/create', [CrudUserController::class, 'createUser'])->name('user.createUser');
Route::post('/create', [CrudUserController::class, 'postUser'])->name('user.postUser');

Route::get('/read/{id}', [CrudUserController::class, 'readUser'])->name('user.readUser');

Route::get('/delete/{id}', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');

Route::get('/update/{id}', [CrudUserController::class, 'updateUser'])->name('user.updateUser');
Route::post('/update/{id}', [CrudUserController::class, 'postUpdateUser'])->name('user.postUpdateUser');

Route::get('/list', [CrudUserController::class, 'listUser'])->name('user.list');

Route::get('/signOut', [CrudUserController::class, 'signOut'])->name('signOut');

Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);