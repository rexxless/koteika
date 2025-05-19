<?php

use App\Http\Controllers\Api\AmenityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainPageController;
use App\Http\Controllers\Api\RoomController;
use Illuminate\Support\Facades\Route;


// Гость
Route::get('/main', [MainPageController::class, 'index'])->middleware(['throttle:api']);

Route::get('/rooms', [RoomController::class, 'index'])->middleware(['throttle:api']);

Route::get('/rooms/amenities', [AmenityController::class, 'index'])->middleware(['throttle:api']);

Route::get('/rooms/{room}', [RoomController::class, 'show'])->middleware(['throttle:api']);


//
Route::post('/login', [AuthController::class, 'login'])->middleware(['throttle:api']);
Route::post('/signup', [AuthController::class, 'signup'])->middleware(['throttle:api']);

# Потом надо будет все поместить под auth:sanctum
Route::get('/logout', [AuthController::class, 'logout'])->middleware('throttle:api', 'auth:sanctum');
//
//Route::get('/rooms/{id}/feedback', [FeedbackController::class, 'show'])
//    ->where('id', '[0-9]+');
//
// ошибка если неавторизованный пользователь
//Route::get('/unauthorized', [AuthController::class, 'unauthorized'])
//    ->name('login');
//
//
//Route::middleware('auth:sanctum')->group(function () {
//
   // Пользователь
//    Route::post('rooms/{id}/booking', [BookingController::class, 'store'])
//        ->where('id', '[0-9]+');
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


