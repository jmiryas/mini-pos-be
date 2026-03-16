<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class AutoId
{
    /**
     * Generate Custom ID (Contoh: BRG_1, BRG_2, dst)
     */
    public static function generate(string $table, string $column, string $prefix): string
    {
        // Trik SQL: Urutkan berdasarkan panjang karakternya dulu, baru urutan nilainya.
        // Ini memastikan BRG_10 (panjang 6) selalu di atas BRG_9 (panjang 5).
        $lastRecord = DB::table($table)
            ->orderByRaw("LENGTH({$column}) DESC")
            ->orderBy($column, 'desc')
            ->first();

        if (!$lastRecord) {
            return $prefix . '1';
        }

        $lastId = $lastRecord->{$column}; // Contoh: "BRG_10"

        // Buang prefix-nya ("BRG_") lalu jadikan angka (10)
        $lastNumber = (int) str_replace($prefix, '', $lastId);

        // Tambah 1 dan gabungkan kembali
        return $prefix . ($lastNumber + 1); // "BRG_11"
    }
}
