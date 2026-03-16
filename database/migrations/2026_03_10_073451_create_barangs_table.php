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
        Schema::create('BARANG', function (Blueprint $table) {
            $table->string("KODE", 50)->primary();
            $table->string("NAMA", 100);
            $table->string("KATEOGRI", 50);
            $table->decimal("HARGA", 15, 2)->default(0.00);

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('BARANG');
    }
};
