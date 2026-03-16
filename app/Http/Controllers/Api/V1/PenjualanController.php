<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Services\PenjualanService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PenjualanResource;
use App\Http\Requests\Api\Penjualan\IndexPenjualanRequest;
use App\Http\Requests\Api\Penjualan\StorePenjualanRequest;
use App\Http\Requests\Api\Penjualan\UpdatePenjualanRequest;

class PenjualanController extends Controller
{
    public function __construct(protected PenjualanService $penjualanService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(IndexPenjualanRequest $request): JsonResponse
    {
        $filters = $request->validated();

        $penjualan = $this->penjualanService->getList($filters);

        return $this->successResponse(
            data: [
                "items" => PenjualanResource::collection($penjualan),
                "current_page" => $penjualan->currentPage(),
                "last_page" => $penjualan->lastPage(),
                "total" => $penjualan->total(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenjualanRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        $penjualan = $this->penjualanService->create($attributes);

        return $this->successResponse(
            data: new PenjualanResource($penjualan),
            message: "Penjualan berhasil dilakukan"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_nota): JsonResponse
    {
        $penjualan = $this->penjualanService->getById($id_nota);

        return $this->successResponse(
            data: new PenjualanResource($penjualan),
            message: "Detail transaksi berhasil diambil"
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenjualanRequest $request, string $id_nota): JsonResponse
    {
        $data = $request->validated();

        $penjualan = $this->penjualanService->update($id_nota, $data);

        return $this->successResponse(
            data: new PenjualanResource($penjualan),
            message: "Detail transaksi berhasil diperbarui"
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_nota): JsonResponse
    {
        $this->penjualanService->delete($id_nota);

        return $this->successResponse(
            data: null,
            message: "Data penjualan beserta itemnya berhasil dihapus"
        );
    }
}
