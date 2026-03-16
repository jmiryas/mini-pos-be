<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelangganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelangganList = [
            [
                "ID_PELANGGAN" => "PELANGGAN_1",
                "NAMA" => "ANDI",
                "DOMISILI" => "JAK-UT",
                "JENIS_KELAMIN" => "PRIA"
            ],
            [
                "ID_PELANGGAN" => "PELANGGAN_2",
                "NAMA" => "BUDI",
                "DOMISILI" => "JAK-BAR",
                "JENIS_KELAMIN" => "PRIA"
            ],
            [
                "ID_PELANGGAN" => "PELANGGAN_3",
                "NAMA" => "JOHAN",
                "DOMISILI" => "JAK-SEL",
                "JENIS_KELAMIN" => "PRIA"
            ],
            [
                "ID_PELANGGAN" => "PELANGGAN_4",
                "NAMA" => "SINTHA",
                "DOMISILI" => "JAK-TIM",
                "JENIS_KELAMIN" => "WANITA"
            ],
            [
                "ID_PELANGGAN" => "PELANGGAN_5",
                "NAMA" => "ANTO",
                "DOMISILI" => "JAK-UT",
                "JENIS_KELAMIN" => "PRIA"
            ],
            [
                "ID_PELANGGAN" => "PELANGGAN_6",
                "NAMA" => "BUJANG",
                "DOMISILI" => "JAK-BAR",
                "JENIS_KELAMIN" => "PRIA"
            ],
            [
                "ID_PELANGGAN" => "PELANGGAN_7",
                "NAMA" => "JOWAN",
                "DOMISILI" => "JAK-SEL",
                "JENIS_KELAMIN" => "PRIA"
            ],
            [
                "ID_PELANGGAN" => "PELANGGAN_8",
                "NAMA" => "SINTIA",
                "DOMISILI" => "JAK-TIM",
                "JENIS_KELAMIN" => "WANITA"
            ],
            [
                "ID_PELANGGAN" => "PELANGGAN_9",
                "NAMA" => "BUTET",
                "DOMISILI" => "JAK-BAR",
                "JENIS_KELAMIN" => "WANITA"
            ],
            [
                "ID_PELANGGAN" => "PELANGGAN_10",
                "NAMA" => "JONNY",
                "DOMISILI" => "JAK-SEL",
                "JENIS_KELAMIN" => "WANITA"
            ]
        ];

        foreach ($pelangganList as $pelanggan) {
            Pelanggan::create($pelanggan);
        }
    }
}
