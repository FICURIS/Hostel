<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controlles\BasicController;

Route::get('/', [BasicController::class, 'login'])->name('login');
Route::get('/authorization', [BasicController::class, 'authorization'])->name('authorization');

Route::post('/', [BasicController::class, 'submit_login'])->name('login.post');
Route::post('/authorization', [BasicController::class, 'submit_authorization'])->name('authorization.post');
