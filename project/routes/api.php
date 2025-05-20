<?php

use App\Http\Controllers\Api\AmenityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\MainPageController;
use App\Http\Controllers\Api\RoomController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->group(function () {

    // Гость
    Route::get('/main', [MainPageController::class, 'index']);

    Route::get('/rooms', [RoomController::class, 'index']);

    Route::get('/rooms/amenities', [AmenityController::class, 'index']);

    Route::get('/rooms/{room}', [RoomController::class, 'show']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/signup', [AuthController::class, 'signup']);

    Route::get('/rooms/{room}/feedback', [FeedbackController::class, 'show']);


    // Для авторизованного
    Route::middleware('auth:sanctum')->group(function () {


        Route::get('/logout', [AuthController::class, 'logout']);
        Route::post('rooms/{room}/booking', [BookingController::class, 'store']);
        Route::post('rooms', [RoomController::class, 'store']);
        Route::get('/bookings', [BookingController::class, 'show']);


    });

});
//
//
// ошибка если неавторизованный пользователь
//Route::get('/unauthorized', [AuthController::class, 'unauthorized'])
//    ->name('login');
//
//
//
   // Пользователь


//    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);
//
//    Route::post('rooms/{room}/feedback', [FeedbackController::class, 'store']);
//
//    Route::patch('/profile', [AuthController::class, 'update']);
//
   // Админ
//    Route::patch('/main', [MainPageController::class, 'update']);
//
//    Route::post('/rooms/amenities', [AmenityController::class, 'store']);
//    Route::patch('rooms/amenities/{amenity}', [AmenityController::class, 'update'])
//    Route::delete('/rooms/amenities/{amenity}', [AmenityController::class, 'destroy'])
//
//    Route::post('/bookings/{booking}', [BookingController::class, 'approve']);
//
//    Route::patch('/rooms/{room}', [RoomController::class, 'update'])
//    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])

//
//    Route::get('/bookings', [BookingController::class, 'index']);
//
   // тут удаление брони от админа, точно такой же роут есть от лица юзера, разграничивать будем через политику
   //Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])
//
   // выход

//});


