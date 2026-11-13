<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect('/index');
});

Route::get('/register', [BasicController::class, 'register'])->name('register');
Route::post('/register', [BasicController::class, 'submit_register'])->name('register.post');

Route::get('/login', [BasicController::class, 'login'])->name('login');
Route::post('/login', [BasicController::class, 'submit_login'])->name('login.post');

Route::get('/index', [BasicController::class, 'index'])->name('index');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/reviews', [ReviwController::class, 'store'])->middleware('auth')->name('reviews.store');

Route::post('/logout', [BasicController::class, 'logout'])->name('logout');