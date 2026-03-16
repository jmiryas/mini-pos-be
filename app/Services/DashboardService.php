<?php

namespace App\Services;

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function getPenjualanBulanan(array $filters): Collection
    {
        $baseQuery = Penjualan::query()
            ->selectRaw("
                YEAR(TGL) as tahun,
                MONTH(TGL) as bulan,
                SUM(SUBTOTAL) as total_penjualan,
                COUNT(ID_NOTA) as total_transaksi
            ")
            ->groupByRaw("YEAR(TGL), MONTH(TGL)");

        return QueryBuilder::for($baseQuery)
            ->allowedFilters([
                // Filter Periode Awal (>=)
                AllowedFilter::callback("periode_awal", function (Builder $query, $value) {
                    // Tambahkan -01 agar menjadi format tanggal lengkap Y-m-d (2023-01-01)
                    $query->where("TGL", ">=", $value . "-01");
                }),

                // Filter Periode Akhir (<=)
                AllowedFilter::callback("periode_akhir", function (Builder $query, $value) {
                    // Gunakan tgl terakhir di bulan tersebut (EOM)
                    // Atau simpelnya: cari yang kurang dari bulan berikutnya tanggal 1
                    $lastDate = date("Y-m-t", strtotime($value . "-01"));
                    $query->where("TGL", "<=", $lastDate);
                }),
            ])
            ->allowedSorts(["tahun", "bulan", "total_penjualan", "total_transaksi"])
            ->defaultSort("-tahun", "-bulan")
            ->get();
    }
}
