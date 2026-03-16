<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\IndexPenjualanBulananRequest;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $dashboardService) {}

    public function transactionReport(IndexPenjualanBulananRequest $request): JsonResponse
    {
        $filters = $request->validated();

        $data = $this->dashboardService->getPenjualanBulanan($filters);

        return $this->successResponse(
            data: $data,
            message: "Data statistik penjualan bulanan berhasil diambil"
        );
    }
}
