<?php

use App\Http\Middleware\DatabaseConnectionMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'connection' => DatabaseConnectionMiddleware::class,
        ]);
        $middleware->priority([
            'connection',
            'auth',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (Throwable $exception, Request $request) {
            if ($request->is('api/*')) {

                // Not Found (404)
                if ($exception instanceof NotFoundHttpException) {
                    return response()->json([
                        'message' => 'Resource not found',
                    ], 404);
                }

                // Method Not Allowed (405)
                if ($exception instanceof MethodNotAllowedHttpException) {
                    return response()->json([
                        'message' => 'Method not allowed',
                    ], 405);
                }

                // Validation Error (422)
                if ($exception instanceof ValidationException) {
                    return response()->json([
                        'message' => 'Validation error',
                        'errors' => $exception->errors(),
                    ], 422);
                }

                // Authentication Error (401)
                if ($exception instanceof AuthenticationException) {
                    return response()->json([
                        'message' => 'Unauthorized',
                    ], 401);
                }

                // Internal Server Error (500)
                return response()->json([
                    'message' => 'Something went wrong!',
                    'error' => $exception->getMessage(),
                ], 500);
            }
        });
    })->create();
