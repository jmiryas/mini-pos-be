<?php

namespace App\Services;

use App\Helpers\AutoId;
use App\Models\Pelanggan;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;

class PelangganService
{
    public function getList(array $filters): LengthAwarePaginator
    {
        $perPage = $filters["per_page"] ?? 10;

        return QueryBuilder::for(Pelanggan::class)
            ->allowedFilters([
                AllowedFilter::partial("nama", "NAMA"),
                AllowedFilter::exact("domisili", "DOMISILI"),
                AllowedFilter::exact("jenis_kelamin", "JENIS_KELAMIN"),
            ])
            ->allowedSorts([
                AllowedSort::field("nama", "NAMA"),
                AllowedSort::field("domisili", "DOMISILI"),
                AllowedSort::field("jenis_kelamin", "JENIS_KELAMIN"),
            ])
            ->paginate($perPage);
    }

    public function getById(string $id_pelanggan): Pelanggan
    {
        return Pelanggan::findOrFail($id_pelanggan);
    }

    public function create(array $data): Pelanggan
    {
        $newId = AutoId::generate("PELANGGAN", "ID_PELANGGAN", "PELANGGAN_");

        return Pelanggan::create([
            "ID_PELANGGAN"  => $newId,
            "NAMA"          => $data["nama"],
            "DOMISILI"      => $data["domisili"],
            "JENIS_KELAMIN" => $data["jenis_kelamin"],
        ]);
    }

    public function update(string $id_pelanggan, array $data): Pelanggan
    {
        $pelanggan = $this->getById($id_pelanggan);

        $payload = [];
        if (isset($data["nama"])) $payload["NAMA"] = $data["nama"];
        if (isset($data["domisili"])) $payload["DOMISILI"] = $data["domisili"];
        if (isset($data["jenis_kelamin"])) $payload["JENIS_KELAMIN"] = $data["jenis_kelamin"];

        $pelanggan->update($payload);
        return $pelanggan;
    }

    public function delete(string $id_pelanggan): void
    {
        $pelanggan = $this->getById($id_pelanggan);

        try {
            $pelanggan->delete();
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                abort(400, "Pelanggan tidak bisa dihapus karena memiliki riwayat transaksi penjualan.");
            }
            throw $e;
        }
    }
}
