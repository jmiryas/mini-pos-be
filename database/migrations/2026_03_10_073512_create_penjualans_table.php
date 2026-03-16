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
        Schema::create('PENJUALAN', function (Blueprint $table) {
            $table->string("ID_NOTA", 50)->primary();
            $table->date("TGL");
            $table->string("KODE_PELANGGAN", 50);
            $table->decimal("SUBTOTAL", 15, 2)->default(0.00);

            $table->foreign("KODE_PELANGGAN")->references("ID_PELANGGAN")->on("PELANGGAN")->onDelete("restrict");

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PENJUALAN');
    }
};
