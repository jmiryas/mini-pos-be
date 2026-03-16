<?php

namespace Database\Seeders;

use App\Models\Penjualan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenjualanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penjualanList = [
            [
                "ID_NOTA" => "NOTA_1",
                "TGL" => "2018-01-01",
                "KODE_PELANGGAN" => "PELANGGAN_1",
                "SUBTOTAL" => 50000
            ],
            [
                "ID_NOTA" => "NOTA_2",
                "TGL" => "2018-01-01",
                "KODE_PELANGGAN" => "PELANGGAN_2",
                "SUBTOTAL" => 200000
            ],
            [
                "ID_NOTA" => "NOTA_3",
                "TGL" => "2018-01-01",
                "KODE_PELANGGAN" => "PELANGGAN_3",
                "SUBTOTAL" => 430000
            ],
            [
                "ID_NOTA" => "NOTA_4",
                "TGL" => "2018-01-02",
                "KODE_PELANGGAN" => "PELANGGAN_7",
                "SUBTOTAL" => 120000
            ],
            [
                "ID_NOTA" => "NOTA_5",
                "TGL" => "2018-01-02",
                "KODE_PELANGGAN" => "PELANGGAN_4",
                "SUBTOTAL" => 70000
            ],
            [
                "ID_NOTA" => "NOTA_6",
                "TGL" => "2018-01-03",
                "KODE_PELANGGAN" => "PELANGGAN_8",
                "SUBTOTAL" => 230000
            ],
            [
                "ID_NOTA" => "NOTA_7",
                "TGL" => "2018-01-03",
                "KODE_PELANGGAN" => "PELANGGAN_9",
                "SUBTOTAL" => 390000
            ],
            [
                "ID_NOTA" => "NOTA_8",
                "TGL" => "2018-01-03",
                "KODE_PELANGGAN" => "PELANGGAN_5",
                "SUBTOTAL" => 65000
            ],
            [
                "ID_NOTA" => "NOTA_9",
                "TGL" => "2018-01-04",
                "KODE_PELANGGAN" => "PELANGGAN_2",
                "SUBTOTAL" => 40000
            ]
        ];

        foreach ($penjualanList as $penjualan) {
            Penjualan::create($penjualan);
        }
    }
}
