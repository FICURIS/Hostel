<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;

Route::get('/', function () {
    return redirect('/index');
});

Route::get('/register', [BasicController::class, 'register'])->name('register');
Route::post('/register', [BasicController::class, 'submit_register'])->name('register.post');

Route::get('/login', [BasicController::class, 'login'])->name('login');
Route::post('/login', [BasicController::class, 'submit_login'])->name('login.post');

Route::get('/index', [BasicController::class, 'index'])->name('index');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
Route::get('/my-applications', [ApplicationController::class, 'index'])->middleware('auth')->name('applications.index');

Route::middleware('auth')->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/payment', [ApplicationController::class, 'showPayment'])->name('applications.payment');
    Route::post('/applications/payment', [ApplicationController::class, 'processPayment'])->name('applications.payment.process');
});

Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::patch('/applications/{application}/status', [AdminApplicationController::class, 'updateStatus'])->name('applications.status');
});



Route::post('/logout', [BasicController::class, 'logout'])->name('logout');