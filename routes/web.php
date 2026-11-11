<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicController;

Route::get('/register', [BasicController::class, 'register'])->name('register');
Route::post('/register', [BasicController::class, 'submit_register'])->name('register.post');

Route::get('/login', [BasicController::class, 'login'])->name('login');
Route::post('/login', [BasicController::class, 'submit_login'])->name('login.post');


Route::middleware('auth')->group(function (){
    Route::get('/index', [BasicController::class, 'index'])->name('index');
    Route::post('/logout', [BasicController::class, 'logout'])->name('logout');
});
