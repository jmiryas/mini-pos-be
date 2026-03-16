<?php

use App\Http\Middleware\ApiLogger;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(append: [
            ApiLogger::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // 1. Tangkap Error 404 GLOBAL (Untuk Web maupun API)
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                "success" => false,
                "message" => "Data atau Endpoint tidak ditemukan.",
            ], 404);
        });

        // 2. Tangkap Error Validasi GLOBAL
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                "success" => false,
                "message" => "Data yang dikirim tidak valid.",
                "errors"  => $e->errors(),
            ], 422);
        });

        // 3. Tangkap Error Database Umum GLOBAL
        $exceptions->render(function (QueryException $e, Request $request) {
            return response()->json([
                "success" => false,
                "message" => "Terjadi kesalahan pada sistem database.",
                "errors"  => env("APP_DEBUG") ? $e->getMessage() : null,
            ], 500);
        });

        // 4. Tangkap Error Exception Umum GLOBAL
        $exceptions->render(function (\Exception $e, Request $request) {
            // Ambil status code bawaan error, jika tidak ada default ke 500
            $statusCode = method_exists($e, "getStatusCode") ? $e->getStatusCode() : 500;

            return response()->json([
                "success" => false,
                "message" => env("APP_DEBUG") ? $e->getMessage() : "Terjadi kesalahan pada server.",
            ], $statusCode);
        });

        $exceptions->render(function (ThrottleRequestsException $e, Request $request) {
            return response()->json([
                "success" => false,
                "message" => "Too Many Requests",
            ], 429);
        });
    })->create();
