<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Страница не найдена.'
                ], 404);
            } return null;
        });

        $exceptions->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'message' => 'Доступно только для авторизованных пользователей.',
            ], 401);
        });

        $exceptions->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json([
                'message' => 'HTTP-метод не поддерживается для данного маршрута.',
            ], 405);
        });

        $exceptions->renderable(function (AccessDeniedHttpException $e, $request) {
            return response()->json([
                'message' => 'Не доступно для вас.',
            ], 403);
        });
    })
    ->create();
