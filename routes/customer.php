<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Information;
use Illuminate\Support\Facades\Route;

Route::prefix('customer')->group(function () {

    Route::get('login', [CustomerAuthController::class, 'login'])->name('customer.login');
    Route::post('login', [CustomerAuthController::class, 'postLogin'])->name('customer.postLogin');

    Route::get('register', [CustomerAuthController::class, 'register'])->name('customer.register');
    Route::post('register', [CustomerAuthController::class, 'postRegister'])->name('customer.postRegister');

    Route::get('logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

    Route::resource('/san', HomeController::class);
    Route::get('/checkout', [BookingController::class,'checkout'])->name('booking.checkout');
    Route::post('/booking/store', [BookingController::class,'store'])->name('booking.store');
    Route::get('/booking/success/{id}', [BookingController::class,'success'])->name('booking.success');

    Route::get('/information', [Information::class, 'index'])->name('information.index');
    Route::post('/information', [Information::class, 'postProfile'])->name('information.postProfile');
});