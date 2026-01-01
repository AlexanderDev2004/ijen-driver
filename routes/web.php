<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\JournalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LanguageController;

Route::get('/lang/{lang}', [LanguageController::class, 'switch'])->name('lang.switch');

Route::get('/', [PublicController::class,'index'])->name('home');
Route::get('/tour/{tour}', [PublicController::class,'showTour'])->name('tour.show');
Route::get('/journal/{id}', [PublicController::class,'showJournal'])->name('journal.show');
Route::get('/tour/{tour}/booking', [PublicController::class,'bookingForm'])->name('tour.booking');
Route::post('/tour/{tour}/booking', [PublicController::class,'submitBooking'])->name('tour.booking.submit');
Route::get('/booking/confirm/{id}', [PublicController::class,'bookingConfirm'])->name('booking.confirm');
Route::get('/booking/send-wa/{id}', [PublicController::class,'sendToWhatsApp'])->name('booking.sendwa');

// Admin auth
Route::prefix('admin')->name('admin.')->group(function () {
    // Halaman login & proses login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Proteksi admin
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.tours.index');
        })->name('dashboard');

        Route::resource('tours', TourController::class);
        Route::resource('journals', JournalController::class);
        Route::resource('users', UserController::class);

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::fallback(function(){
    return view('404');
});
