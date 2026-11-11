<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicController;

Route::get('/', [BasicController::class, 'login'])->name('register');
Route::post('/', [BasicController::class, 'submit_login'])->name('register.post');

Route::get('/authorization', [BasicController::class, 'authorization'])->name('login');
Route::post('/authorization', [BasicController::class, 'submit_authorization'])->name('login.post');


Route::middleware('auth')->group(function (){
    Route::get('/index', [BasicController::class, 'index'])->name('index');
    Route::post('/logout', [BasicController::class, 'logout'])->name('logout');
});
