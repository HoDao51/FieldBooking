<?php

use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('customer')->group(function () {

    Route::get('login', [CustomerAuthController::class, 'login'])->name('customer.login');
    Route::post('login', [CustomerAuthController::class, 'postLogin'])->name('customer.postLogin');

    Route::get('register', [CustomerAuthController::class, 'register'])->name('customer.register');
    Route::post('register', [CustomerAuthController::class, 'postRegister'])->name('customer.postRegister');

    Route::post('logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

    Route::resource('/san', HomeController::class);
});