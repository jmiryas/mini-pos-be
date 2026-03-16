<?php

namespace Database\Seeders;

use App\Models\ItemPenjualan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenjualanItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itemPenjualanList = [
            ["NOTA" => "NOTA_1", "KODE_BARANG" => "BRG_1", "Qty" => 2],
            ["NOTA" => "NOTA_1", "KODE_BARANG" => "BRG_2", "Qty" => 2],
            ["NOTA" => "NOTA_2", "KODE_BARANG" => "BRG_6", "Qty" => 1],
            ["NOTA" => "NOTA_3", "KODE_BARANG" => "BRG_4", "Qty" => 1],
            ["NOTA" => "NOTA_3", "KODE_BARANG" => "BRG_7", "Qty" => 1],
            ["NOTA" => "NOTA_3", "KODE_BARANG" => "BRG_6", "Qty" => 1],
            ["NOTA" => "NOTA_4", "KODE_BARANG" => "BRG_9", "Qty" => 2],
            ["NOTA" => "NOTA_4", "KODE_BARANG" => "BRG_10", "Qty" => 2],
            ["NOTA" => "NOTA_5", "KODE_BARANG" => "BRG_3", "Qty" => 1],
            ["NOTA" => "NOTA_6", "KODE_BARANG" => "BRG_7", "Qty" => 1],
            ["NOTA" => "NOTA_6", "KODE_BARANG" => "BRG_5", "Qty" => 1],
            ["NOTA" => "NOTA_6", "KODE_BARANG" => "BRG_3", "Qty" => 1],
            ["NOTA" => "NOTA_7", "KODE_BARANG" => "BRG_5", "Qty" => 1],
            ["NOTA" => "NOTA_7", "KODE_BARANG" => "BRG_6", "Qty" => 1],
            ["NOTA" => "NOTA_7", "KODE_BARANG" => "BRG_7", "Qty" => 1],
            ["NOTA" => "NOTA_7", "KODE_BARANG" => "BRG_8", "Qty" => 1],
            ["NOTA" => "NOTA_8", "KODE_BARANG" => "BRG_5", "Qty" => 1],
            ["NOTA" => "NOTA_8", "KODE_BARANG" => "BRG_9", "Qty" => 1],
            ["NOTA" => "NOTA_9", "KODE_BARANG" => "BRG_5", "Qty" => 1]
        ];

        foreach ($itemPenjualanList as $item) {
            ItemPenjualan::create($item);
        }
    }
}
