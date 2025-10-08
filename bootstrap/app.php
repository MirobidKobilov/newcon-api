<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Spatie\Permission\Exceptions\UnauthorizedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withEvents(discover:[
        __DIR__ . '../app/Events',
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (UnauthorizedException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have the required role or permission.',
                'data' => null,
            ], 403);
        });

        $exceptions->render(function (AuthorizationException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to perform this action.',
                'data' => null,
            ], 403);
        });

        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'The requested resource was not found.',
                'data' => null,
            ], 404);
        });

        $exceptions->render(function (HttpException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'An error occurred.',
                'data' => null,
            ], $e->getStatusCode());
        });

        $exceptions->render(function (Throwable $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
                'data' => null,
            ], 500);
        });
    })
    ->create();
