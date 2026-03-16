<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangList = [
            [
                "KODE" => "BRG_1",
                "NAMA" => "PEN",
                "KATEOGRI" => "ATK",
                "HARGA" => 15000
            ],
            [
                "KODE" => "BRG_2",
                "NAMA" => "PENSIL",
                "KATEOGRI" => "ATK",
                "HARGA" => 10000
            ],
            [
                "KODE" => "BRG_3",
                "NAMA" => "PAYUNG",
                "KATEOGRI" => "RT",
                "HARGA" => 70000
            ],
            [
                "KODE" => "BRG_4",
                "NAMA" => "PANCI",
                "KATEOGRI" => "MASAK",
                "HARGA" => 110000
            ],
            [
                "KODE" => "BRG_5",
                "NAMA" => "SAPU",
                "KATEOGRI" => "RT",
                "HARGA" => 40000
            ],
            [
                "KODE" => "BRG_6",
                "NAMA" => "KIPAS",
                "KATEOGRI" => "ELEKTRONIK",
                "HARGA" => 200000
            ],
            [
                "KODE" => "BRG_7",
                "NAMA" => "KUALI",
                "KATEOGRI" => "MASAK",
                "HARGA" => 120000
            ],
            [
                "KODE" => "BRG_8",
                "NAMA" => "SIKAT",
                "KATEOGRI" => "RT",
                "HARGA" => 30000
            ],
            [
                "KODE" => "BRG_9",
                "NAMA" => "GELAS",
                "KATEOGRI" => "RT",
                "HARGA" => 25000
            ],
            [
                "KODE" => "BRG_10",
                "NAMA" => "PIRING",
                "KATEOGRI" => "RT",
                "HARGA" => 35000
            ]
        ];

        foreach ($barangList as $barang) {
            Barang::create($barang);
        }
    }
}
