<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ITEM_PENJUALAN', function (Blueprint $table) {
            $table->string("NOTA", 50);
            $table->string("KODE_BARANG", 50);
            $table->integer("Qty")->default(1);

            $table->primary(["NOTA", "KODE_BARANG"]);
            $table->foreign("NOTA")->references("ID_NOTA")->on("PENJUALAN")->onDelete("cascade");
            $table->foreign("KODE_BARANG")->references("KODE")->on("BARANG")->onDelete("restrict");

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ITEM_PENJUALAN');
    }
};
