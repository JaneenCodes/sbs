<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Models\Request;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('bookings')->group(function (){
        Route::get('/', [BookingController::class, 'index'])->name('bookings');
        Route::get('create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('store', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('edit', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::patch('{booking}/update', [BookingController::class, 'update'])->name('bookings.update');
        Route::delete('{booking}/destroy', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });

    Route::prefix('appointments')->group(function (){
        Route::get('/', [AppointmentsController::class, 'index'])->name('appointments');
        Route::post('{booking}/store', [AppointmentsController::class, 'store'])->name('appointments.store');


    });
    
});

require __DIR__.'/auth.php';
