<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Services\PelangganService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PelangganResource;
use App\Http\Requests\Api\Pelanggan\IndexPelangganRequest;
use App\Http\Requests\Api\Pelanggan\StorePelangganRequest;
use App\Http\Requests\Api\Pelanggan\UpdatePelangganRequest;

class PelangganController extends Controller
{
    public function __construct(protected PelangganService $pelangganService) {}

    public function index(IndexPelangganRequest $request): JsonResponse
    {
        $filters = $request->validated();
        $pelanggan = $this->pelangganService->getList($filters);

        return $this->successResponse(
            data: [
                "items" => PelangganResource::collection($pelanggan),
                "current_page" => $pelanggan->currentPage(),
                "last_page" => $pelanggan->lastPage(),
                "total" => $pelanggan->total(),
            ]
        );
    }

    public function store(StorePelangganRequest $request): JsonResponse
    {
        $data = $request->validated();
        $pelanggan = $this->pelangganService->create($data);

        return $this->successResponse(
            data: new PelangganResource($pelanggan),
            message: "Pelanggan berhasil ditambahkan",
            statusCode: 201
        );
    }

    public function show(string $id_pelanggan): JsonResponse
    {
        $pelanggan = $this->pelangganService->getById($id_pelanggan);

        return $this->successResponse(
            data: new PelangganResource($pelanggan),
            message: "Detail pelanggan berhasil diambil"
        );
    }

    public function update(UpdatePelangganRequest $request, string $id_pelanggan): JsonResponse
    {
        $data = $request->validated();
        $pelanggan = $this->pelangganService->update($id_pelanggan, $data);

        return $this->successResponse(
            data: new PelangganResource($pelanggan),
            message: "Pelanggan berhasil diperbarui"
        );
    }

    public function destroy(string $id_pelanggan): JsonResponse
    {
        $this->pelangganService->delete($id_pelanggan);

        return $this->successResponse(
            data: null,
            message: "Pelanggan berhasil dihapus"
        );
    }
}
