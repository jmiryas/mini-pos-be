<?php

namespace App\Services;

use App\Models\Barang;
use App\Helpers\AutoId;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class BarangService
{
    public function getList(array $filters): LengthAwarePaginator
    {
        $perPage = $filters['per_page'] ?? 10;

        return QueryBuilder::for(Barang::class)
            ->allowedFilters([
                AllowedFilter::partial('nama', 'NAMA'),
                AllowedFilter::exact('kategori', 'KATEOGRI'),
                AllowedFilter::callback('harga_min', function (Builder $query, $value) {
                    $query->where('HARGA', '>=', $value);
                }),
                AllowedFilter::callback('harga_max', function (Builder $query, $value) {
                    $query->where('HARGA', '<=', $value);
                }),
            ])
            ->allowedSorts([
                AllowedSort::field('nama', 'NAMA'),
                AllowedSort::field('kategori', 'KATEOGRI'),
                AllowedSort::field('harga', 'HARGA'),
            ])
            ->paginate($perPage);
    }

    public function getById(string $kode): Barang
    {
        return Barang::findOrFail($kode);
    }

    public function create(array $data): Barang
    {
        $newKode = AutoId::generate('barang', 'KODE', 'BRG_');

        return Barang::create([
            'KODE' => $newKode,
            'NAMA' => $data['nama'],
            'KATEOGRI' => $data['kategori'],
            'HARGA' => $data['harga'],
        ]);
    }

    public function update(string $kode, array $data): Barang
    {
        $barang = $this->getById($kode);

        $payload = [];
        if (isset($data['nama'])) $payload['NAMA'] = $data['nama'];
        if (isset($data['kategori'])) $payload['KATEOGRI'] = $data['kategori'];
        if (isset($data['harga'])) $payload['HARGA'] = $data['harga'];

        $barang->update($payload);
        return $barang;
    }

    public function delete(string $kode): void
    {
        $barang = $this->getById($kode);

        try {
            $barang->delete();
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                abort(400, "Barang tidak bisa dihapus karena sudah ada di riwayat penjualan.");
            }

            throw $e;
        }
    }
}
