<?php

use App\Http\Controllers\MasterController\Room\MasterRoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterController\Hotel\MasterHotelController;
use App\Http\Controllers\AdminController\Hotel\AdminHotelController;
use App\Http\Controllers\RecepcionistController\Hotel\RecepcionistHotelController;
use App\Http\Controllers\MasterController\User\MasterUserController;
use App\Http\Controllers\AdminController\User\AdminUserController;
use App\Http\Controllers\RecepcionistController\User\RecepcionistUserController;
use App\Http\Controllers\MasterController\Guest\MasterGuestController;
use App\Http\Controllers\GuestController\User\GuestUserController;
use App\Http\Controllers\GuestController\Hotel\GuestHotelController;
use App\Http\Controllers\AdminRoomController\Room\AdminRoomController;
use App\Http\Controllers\MasterController\RoomReservation\MasterReservationController;

Route::post('/register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'index']);




Route::middleware('auth:sanctum')->group( function () {
    Route::middleware('role:master')->group(function () {
        Route::prefix('/master')->group(function(){
            Route::prefix('/hotel')->group(function(){
                Route::post('/', [MasterHotelController::class, 'store']);
                Route::get('/', [MasterHotelController::class, 'index']);
                Route::get('/{id}', [MasterHotelController::class, 'index']);
                Route::put('/{id}', [MasterHotelController::class, 'update']);
                Route::delete('/{id}', [MasterHotelController::class, 'delete']);
            });
            Route::prefix('/users')->group(function(){
                Route::get('/', [MasterUserController::class, 'index']);
                Route::post('/', [MasterUserController::class, 'store']);
                Route::get('/{id}', [MasterUserController::class, 'index']);
                Route::put('/{id}', [MasterUserController::class, 'update']);
                Route::delete('/{id}', [MasterUserController::class, 'delete']);
            });
            Route::prefix('/guest')->group(function(){
                Route::get('/', [MasterGuestController::class, 'index']);
                Route::post('/', [MasterGuestController::class, 'store']);
                Route::get('/{id}', [MasterGuestController::class, 'index']);
                Route::put('/{id}', [MasterGuestController::class, 'update']);
                Route::delete('/{d}', [MasterGuestController::class, 'delete']);
            });
            Route::prefix('rooms')->group(function(){
                Route::get('/', [MasterRoomController::class, 'index']);
                Route::post('/', [MasterRoomController::class, 'store']);
                Route::get('/{id}', [MasterRoomController::class, 'index']);
                Route::put('/{id}', [MasterRoomController::class, 'update']);
                Route::delete('/{d}', [MasterRoomController::class, 'delete']);
            });
            Route::prefix('reservations')->group(function () {
                Route::post('/', [MasterReservationController::class, 'store']);
                Route::get('/', [MasterReservationController::class, 'index']);
                Route::get('/{id}', [MasterReservationController::class, 'index']);
                Route::put('/{id}', [MasterReservationController::class, 'update']);
                Route::delete('/{id}', [MasterReservationController::class, 'delete']);
                Route::put('/{id}/cancel', [MasterReservationController::class, 'cancel']);
            });
        });
    });
    Route::middleware('role:admin')->group(function () {
        Route::prefix('/admin')->group(function(){
            Route::prefix('/hotel')->group(function(){
                Route::get('/', [AdminHotelController::class, 'index']);
            });
            Route::prefix('/users')->group(function(){
                Route::get('/', [AdminUserController::class, 'index']);
                Route::post('/', [AdminUserController::class, 'store']);
                Route::put('/{id}', [AdminUserController::class, 'update']);
                Route::delete('/{id}', [AdminUserController::class, 'delete']);
            });
            Route::prefix('rooms')->group(function(){
                Route::get('/', [AdminRoomController::class, 'index']);
                Route::post('/', [AdminRoomController::class, 'store']);
                Route::get('/{id}', [AdminRoomController::class, 'show']);
                Route::put('/{id}', [AdminRoomController::class, 'update']);
                Route::delete('/{d}', [AdminRoomController::class, 'delete']);
            });
        });
    });
    Route::middleware('role:recepcionist')->group(function () {
        Route::prefix('receptionist')->group(function(){
            Route::prefix('hotel')->group(function(){
                Route::get('/', [RecepcionistHotelController::class, 'index']);
            });
            Route::prefix('user')->group(function(){
                Route::get('/', [RecepcionistUserController::class, 'index']);
            });
        
        });
    });
    Route::middleware('role:guest')->group(function () {
        Route::prefix('/guest')->group(function(){
            Route::prefix('/hotel')->group(function(){
                Route::get('/', [GuestHotelController::class, 'index']);
            });
            Route::prefix('user')->group(function(){
                Route::get('/', [GuestUserController::class, 'index']);
                Route::delete('/}', [GuestUserController::class, 'delete']);
            });
        });
    });
});