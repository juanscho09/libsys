<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*$configArray = [];
switch(env('APP_ENV')){
    case 'local':
    case 'staging':
    case 'qa':
    case 'dev':
        $configArray = ['prefix' => 'v1','middleware' => ['cors']];
        break;
    case 'prod':
        $configArray = ['prefix' => 'v1'];
        break;
}*/


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::middleware(['cors'])->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('login');
//});


Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::group(['prefix' => 'books'], function(){
        Route::get('/', [BookController::class, 'index'])->name('book-list');
        Route::get('/{book}/show', [BookController::class, 'show'])->name('book-show');
        Route::get('/{book}/availability', [BookController::class, 'availability'])->name('book-availability');
        Route::post('/', [BookController::class, 'store'])->name('book-store');
        Route::put('/{book}', [BookController::class, 'update'])->name('book-update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('book-delete');
    });
    
    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [UserController::class, 'index'])->name('user-list');
        Route::get('/{user}/show', [UserController::class, 'show'])->name('user-show');
        Route::post('/', [UserController::class, 'store'])->name('user-store');
        Route::put('/{user}', [UserController::class, 'update'])->name('user-update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user-delete');
    });
    
    Route::group(['prefix' => 'bookings'], function(){
        Route::get('/', [BookingController::class, 'index'])->name('booking-list');
        Route::get('/pending-reservations', [BookingController::class, 'indexPendingReservations'])->name('booking-list-pending-reservations');
        Route::get('/loans', [BookingController::class, 'indexLoans'])->name('booking-list-loans');
        Route::get('/{booking}/show', [BookingController::class, 'show'])->name('booking-show');
        Route::post('/', [BookingController::class, 'store'])->name('booking-store');
        Route::post('/store-loan', [BookingController::class, 'storeLoan'])->name('booking-store-loan');
        Route::post('/store-booking', [BookingController::class, 'storeBooking'])->name('booking-store-booking');
        Route::put('/{booking}', [BookingController::class, 'update'])->name('booking-update');
        Route::put('/{booking}/returned', [BookingController::class, 'returned'])->name('booking-returned');
        Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('booking-delete');
    });
});

/*Route::group(['prefix' => 'v1','middleware' => ['cors', 'auth', 'permission', 'password_expired']], function(){
});*/