<?php

use Illuminate\Support\Facades\Route;

Route::name('wdevkit_admin.')->group(function () {

    Route::get('login', [\Wdevkit\Admin\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\Wdevkit\Admin\Http\Controllers\LoginController::class, 'login'])->name('login_post');
    Route::post('logout', [\Wdevkit\Admin\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:web_admin')->group(function () {
        Route::get('home', \Wdevkit\Admin\Http\Controllers\HomeController::class)->name('home');
    });
});
