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

    Route::get('/rooms/{room}', [RoomController::class, 'show'])
        ->where('room', '[0-9]+');

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/signup', [AuthController::class, 'signup']);


    Route::get('/rooms/{room}/feedback', [FeedbackController::class, 'show'])
        ->where('room', '[0-9]+');

    // Для авторизованного
    Route::middleware('auth:sanctum')->group(function () {

        // Пользователь
        Route::post('rooms/{room}/booking', [BookingController::class, 'store'])
            ->where('room', '[0-9]+');

        Route::post('rooms/{room}/feedback', [FeedbackController::class, 'store'])
            ->where('room', '[0-9]+');

        Route::patch('/profile', [UserController::class, 'update']);

        // Админ
        Route::post('/rooms', [RoomController::class, 'store']);
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])
            ->where('room', '[0-9]+');
        Route::patch('/rooms/{room}', [RoomController::class, 'update'])
            ->where('room', '[0-9]+');

        Route::post('/rooms/amenities', [AmenityController::class, 'store']);
        Route::delete('/rooms/amenities/{amenity}', [AmenityController::class, 'destroy'])
            ->where('amenity', '[0-9]+');
        Route::patch('/rooms/amenities/{amenity}', [AmenityController::class, 'update'])
            ->where('amenity', '[0-9]+');

        Route::post('/bookings/{booking}', [BookingController::class, 'approve'])
            ->where('booking', '[0-9]+');

        Route::patch('/main', [MainPageController::class, 'update']);

        Route::post('/main/social_links', [SocialLinkController::class, 'store']);

        Route::delete('/main/social_links/{link}', [SocialLinkController::class, 'destroy'])
            ->where('link', '[0-9]+');

        // Пользователь | Админ
        Route::get('/bookings', [BookingController::class, 'show']);

        Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])
            ->where('booking', '[0-9]+');

        // Выход
        Route::get('/logout', [AuthController::class, 'logout']);
    });
});


