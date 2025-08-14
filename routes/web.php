<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/tour/{name}', [TourController::class, 'show'])->name('tour.show');

Route::prefix('booking')->group(function () {
    Route::get('/{tour?}', [BookingController::class, 'form'])->name('booking.form');
    Route::post('/preview', [BookingController::class, 'preview'])->name('booking.preview');
    Route::post('/send', [BookingController::class, 'send'])->name('booking.send');
});

Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
Route::get('/trips/{trip}', [TripController::class, 'show'])->name('trips.show');
