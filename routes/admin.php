<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\FieldPriceController;
use App\Http\Controllers\FieldTypeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TimeSlotController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    // Trang chính admin
    Route::get('/admins', [DashboardController::class, 'index'])->name('admins.index');

    Route::resource('admins/nhanVien', EmployeeController::class);
    Route::post('admins/nhanVien/{nhanVien}/restore', [EmployeeController::class, 'restore'])->name('nhanVien.restore');
    Route::resource('admins/khachHang', CustomerController::class);
    Route::post('admins/khachHang/{khachHang}/restore', [CustomerController::class, 'restoreCus'])->name('khachHang.restore');
});