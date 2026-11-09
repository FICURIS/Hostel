<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicController;

Route::get('/register', [BasicController::class, 'register'])->name('register');


Route::get('/login', [BasicController::class, 'login'])->name('login');

Route::get('/index', [BasicController::class, 'index'])->name('index');