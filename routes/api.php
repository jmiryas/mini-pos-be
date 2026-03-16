<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BarangController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\PelangganController;
use App\Http\Controllers\Api\V1\PenjualanController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get("/", function () {
    return response()->json("Hello!");
});

Route::middleware(["throttle:api"])->prefix("v1")->group(function () {
    Route::apiResource("items", BarangController::class);
    Route::apiResource("customers", PelangganController::class);
    Route::apiResource("transactions", PenjualanController::class);
    Route::prefix("dashboard")->group(function () {
        Route::get("trx/report", [DashboardController::class, "transactionReport"]);
    });
});
