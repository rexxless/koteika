<?php

use App\Http\Controllers\Api\AmenityController;
use App\Http\Controllers\Api\AuthController;
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


    // Для авторизованного
    Route::middleware('auth:sanctum')->group(function () {


        Route::get('/logout', [AuthController::class, 'logout']);


    });

});
//
//Route::get('/rooms/{id}/feedback', [FeedbackController::class, 'show'])
//    ->where('id', '[0-9]+');
//
// ошибка если неавторизованный пользователь
//Route::get('/unauthorized', [AuthController::class, 'unauthorized'])
//    ->name('login');
//
//
//
   // Пользователь

//    Route::get('/bookings', [BookingController::class, 'show']);
//    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])
//        ->where('id', '[0-9]+');
//
//    Route::post('rooms/{id}/feedback', [FeedbackController::class, 'store'])
//        ->where('id', '[0-9]+');
//
//    Route::patch('/profile', [AuthController::class, 'update']);
//
   // Админ
//    Route::patch('/main', [MainPageController::class, 'update']);
//
//    Route::post('/rooms/amenities', [AmenityController::class, 'store']);
//    Route::patch('rooms/amenities/{amenity}', [AmenityController::class, 'update'])
//        ->where('amenity', '[0-9]+');
//    Route::delete('/rooms/amenities/{amenity}', [AmenityController::class, 'destroy'])
//        ->where('amenity', '[0-9]+');
//
//    Route::post('/bookings/{id}', [BookingController::class, 'approved'])
//        ->where('id', '[0-9]+');
//
//    Route::patch('/rooms/{id}', [RoomController::class, 'update'])
//        ->where('id', '[0-9]+');
//    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])
//        ->where('id', '[0-9]+');
//    Route::post('/rooms', [RoomController::class, 'store']);
//
//    Route::get('/bookings', [BookingController::class, 'index']);
//
   // тут удаление брони от админа, точно такой же роут есть от лица юзера, разграничивать будем через политику
   //Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])
   //    ->where('id', '[0-9]+');
//
   // выход

//});


