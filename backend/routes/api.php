<?php

use App\Http\Controllers\Api\AmenityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AvatarController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\MainPageController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\SocialLinkController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// там где нет apiResource, они там просто не будут работать
// там где прописан явно where, там не работает без него

Route::middleware('throttle:api')->group(function () {

    // Гость
    Route::get('/main', [MainPageController::class, 'index']);

    Route::get('/rooms', [RoomController::class, 'index']);

    Route::get('/rooms/{room}', [RoomController::class, 'show']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/signup', [AuthController::class, 'signup']);

    Route::get('/rooms/{room}/feedback', [FeedbackController::class, 'show']);

    // Для авторизованного
    Route::middleware('auth:sanctum')->group(function () {

        // Пользователь
        Route::post('rooms/{room}/booking', [BookingController::class, 'store']);

        Route::post('/rooms/{room}/feedback', [FeedbackController::class, 'store']);
        Route::patch('/rooms/{room}/feedback', [FeedbackController::class, 'update']);
        Route::delete('/rooms/{room}/feedback', [FeedbackController::class, 'destroy']);

        Route::get('/profile', [UserController::class, 'show']);
        Route::patch('/profile', [UserController::class, 'update']);

        Route::post('/profile/avatar', [AvatarController::class, 'store']);
        Route::delete('/profile/avatar', [AvatarController::class, 'destroy']);

        // Админ
        Route::post('/amenities/{amenity}/icon', [AmenityController::class, 'updateIcon']);

        Route::apiResource('/amenities', AmenityController::class);

        Route::apiResource('/rooms', RoomController::class)
            ->only(['store', 'update', 'destroy']);

        Route::post('/bookings/{booking}', [BookingController::class, 'approve']);

        Route::patch('/main', [MainPageController::class, 'update']);

        Route::apiResource('/main/social_links', SocialLinkController::class)
            ->only(['store', 'destroy']);

        Route::apiResource('/rooms/{room}/photos', PhotoController::class)
            ->only(['store', 'destroy']);

        Route::delete('/rooms/{room}/photos/{photo}', [PhotoController::class, 'destroy']);

        Route::delete('/rooms/{room}/feedback/{feedback}', [FeedbackController::class, 'adminDestroy'])
            ->where(['feedback' => '[0-9]+', 'room' => '[0-9]+']);

        // Пользователь | Админ
        Route::get('/bookings', [BookingController::class, 'show']);

        Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);

        // Выход
        Route::get('/logout', [AuthController::class, 'logout']);
    });
});
