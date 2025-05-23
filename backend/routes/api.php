<?php

use App\Http\Controllers\Api\AmenityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\MainPageController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\SocialLinkController;
use App\Http\Controllers\Api\UserController;
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

        // Пользователь
        Route::post('rooms/{room}/booking', [BookingController::class, 'store']);

        Route::post('rooms/{room}/feedback', [FeedbackController::class, 'store']);

        Route::patch('/profile', [UserController::class, 'update']);

        // Админ
        Route::patch('/rooms/{room}', [RoomController::class, 'update']);

        Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);

        Route::post('/rooms', [RoomController::class, 'store']);

        Route::post('/rooms/amenities', [AmenityController::class, 'store']);

        Route::patch('/rooms/amenities/{amenity}', [AmenityController::class, 'update']);

        Route::post('/bookings/{booking}', [BookingController::class, 'approve']);

        Route::patch('/main', [MainPageController::class, 'update']);

        Route::post('/main/social_links', [SocialLinkController::class, 'store']);

        Route::delete('/main/social_links/{link}', [SocialLinkController::class, 'destroy']);

        // Пользователь | Админ
        Route::get('/bookings', [BookingController::class, 'show']);

        Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);

        // Выход
        Route::get('/logout', [AuthController::class, 'logout']);
    });
});


