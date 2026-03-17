<?php

namespace App\Services;

use App\Helpers\AutoId;
use App\Models\Barang;
use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class PenjualanService
{
    public function getList(array $filters): LengthAwarePaginator
    {
        $perPage = $filters["per_page"] ?? 10;

        return QueryBuilder::for(Penjualan::class)
            ->allowedFilters([
                AllowedFilter::partial("id_nota", "ID_NOTA"),
                AllowedFilter::exact("kode_pelanggan", "KODE_PELANGGAN"),

                // Filter Custom Rentang Tanggal
                AllowedFilter::callback("tgl_mulai", function (Builder $query, $value) {
                    $query->whereDate("TGL", ">=", $value);
                }),
                AllowedFilter::callback("tgl_akhir", function (Builder $query, $value) {
                    $query->whereDate("TGL", "<=", $value);
                }),
            ])
            ->allowedSorts([
                AllowedSort::field("id_nota", "ID_NOTA"),
                AllowedSort::field("tgl", "TGL"),
                AllowedSort::field("subtotal", "SUBTOTAL"),
            ])
            ->allowedIncludes(["pelanggan", "items", "items.barang"]) // Magic Eager Loading!
            ->paginate($perPage);
    }

    public function getById(string $id_nota): Penjualan
    {
        return QueryBuilder::for(Penjualan::class)
            ->allowedIncludes(["pelanggan", "items", "items.barang"])
            ->where("ID_NOTA", $id_nota)
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $newId = AutoId::generate("penjualan", "ID_NOTA", "NOTA_");

            $itemIds = array_column($data["items"], "kode_barang");

            $barangList = Barang::whereIn("KODE", $itemIds)->get()->keyBy("KODE");

            $subtotal = 0;
            $itemsPayload = [];

            foreach ($data["items"] as $item) {
                $kodeBarang = $item["kode_barang"];
                $qty = (int) $item["qty"];

                $hargaBarang = $barangList->get($kodeBarang)->HARGA;
                $subtotal += ($hargaBarang * $qty);

                $itemsPayload[] = [
                    "NOTA" => $newId,
                    "KODE_BARANG" => $kodeBarang,
                    "Qty" => $qty,
                ];
            }

            $penjualan = Penjualan::create([
                "ID_NOTA" => $newId,
                "KODE_PELANGGAN" => $data["kode_pelanggan"],
                "TGL" => $data["tgl"],
                "SUBTOTAL" => $subtotal,
            ]);

            ItemPenjualan::insert($itemsPayload);

            $penjualan->load(["pelanggan", "items.barang"]);

            return $penjualan;
        });
    }

    public function update(string $id_nota, array $data): Penjualan
    {
        return DB::transaction(function () use ($id_nota, $data) {

            $penjualan = Penjualan::findOrFail($id_nota);

            if (isset($data["kode_pelanggan"])) {
                $penjualan->KODE_PELANGGAN = $data["kode_pelanggan"];
            }
            if (isset($data["tgl"])) {
                $penjualan->TGL = $data["tgl"];
            }

            if (isset($data["items"])) {

                ItemPenjualan::where("NOTA", $id_nota)->delete();

                $itemIds = array_column($data["items"], "kode_barang");
                $barangList = Barang::whereIn("KODE", $itemIds)->get()->keyBy("KODE");

                $subtotal = 0;
                $itemsPayload = [];

                foreach ($data["items"] as $item) {
                    $kodeBarang = $item["kode_barang"];
                    $qty = (int) $item["qty"];

                    $hargaBarang = $barangList->get($kodeBarang)->HARGA;
                    $subtotal += ($hargaBarang * $qty);

                    $itemsPayload[] = [
                        "NOTA" => $id_nota,
                        "KODE_BARANG" => $kodeBarang,
                        "Qty" => $qty,
                    ];
                }

                ItemPenjualan::insert($itemsPayload);
                $penjualan->SUBTOTAL = $subtotal;
            }

            $penjualan->save();

            $penjualan->load(["pelanggan", "items.barang"]);

            return $penjualan;
        });
    }

    public function delete(string $id_nota): void
    {
        $penjualan = $this->getById($id_nota);

        $penjualan->delete();
    }
}
