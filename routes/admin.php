<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BillController;
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
    Route::resource('admins/sanBong', FieldController::class);
    Route::get('admins/api/facility-by-address', [FieldController::class, 'getFacilityByAddress'])->name('api.facilityByAddress');
    Route::resource('admins/loaiSan', FieldTypeController::class);
    Route::resource('admins/phuongThucThanhToan', PaymentMethodController::class);
    Route::resource('admins/cauHinhGiaGio', FieldPriceController::class);
    Route::get('admins/cauHinhGiaGio/facility/{facilityId}', [FieldPriceController::class, 'showFacility'])->name('cauHinhGiaGio.facility.show');
    Route::patch('admins/khungGio/{khungGio}/lock', [TimeSlotController::class, 'lock'])->name('khungGio.lock');
    Route::patch('admins/khungGio/{khungGio}/unlock', [TimeSlotController::class, 'unlock'])->name('khungGio.unlock');
    
    Route::resource('admins/donDatSan', BookingController::class);
    Route::get('admins/lichSuGiaoDich', [BillController::class, 'index'])->name('lichSuGiaoDich.index');
    Route::post('admins/donDatSan/store-at-field', [BookingController::class, 'storeAtField'])->name('donDatSan.storeAtField');
    Route::put('/don-dat-san/{id}/confirm', [BookingController::class, 'confirm'])->name('donDatSan.confirm');
    Route::put('/don-dat-san/{id}/reject', [BookingController::class, 'reject'])->name('donDatSan.reject');
    Route::get('/don-dat-san/{id}/complete', [BookingController::class, 'completePage'])->name('donDatSan.completePage');
    Route::put('/don-dat-san/{id}/complete', [BookingController::class, 'complete'])->name('donDatSan.complete');
    Route::put('/don-dat-san/{id}/cancel', [BookingController::class, 'cancel'])->name('donDatSan.cancel');

    Route::get('/profile', [EmployeeController::class, 'profile'])->name('admin.profile');
});
