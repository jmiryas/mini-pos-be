<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\BarangService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Http\Requests\Api\Barang\IndexBarangRequest;
use App\Http\Requests\Api\Barang\StoreBarangRequest;
use App\Http\Requests\Api\Barang\UpdateBarangRequest;

class BarangController extends Controller
{
    public function __construct(protected BarangService $barangService) {}

    public function index(IndexBarangRequest $request): JsonResponse
    {
        $filters = $request->validated();

        $barang = $this->barangService->getList($filters);

        return $this->successResponse(
            data: [
                "items" => BarangResource::collection($barang),
                "current_page" => $barang->currentPage(),
                "last_page" => $barang->lastPage(),
                "total" => $barang->total(),
            ]
        );
    }

    public function store(StoreBarangRequest $request): JsonResponse
    {
        $data = $request->validated();

        $barang = $this->barangService->create($data);

        return $this->successResponse(
            data: new BarangResource($barang),
            message: "Barang berhasil ditambahkan",
            statusCode: 201
        );
    }

    public function show(string $kode): JsonResponse
    {
        $barang = $this->barangService->getById($kode);

        return $this->successResponse(
            data: new BarangResource($barang),
            message: "Detail barang berhasil diambil"
        );
    }

    public function update(UpdateBarangRequest $request, string $kode): JsonResponse
    {
        $data = $request->validated();

        $barang = $this->barangService->update($kode, $data);

        return $this->successResponse(
            data: new BarangResource($barang),
            message: "Barang berhasil diperbarui"
        );
    }

    public function destroy(string $kode): JsonResponse
    {
        $this->barangService->delete($kode);

        return $this->successResponse(
            data: null,
            message: "Barang berhasil dihapus"
        );
    }
}
