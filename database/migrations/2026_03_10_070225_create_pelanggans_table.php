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
        Schema::create('PELANGGAN', function (Blueprint $table) {
            $table->string("ID_PELANGGAN", 50)->primary();
            $table->string("NAMA", 100);
            $table->string("DOMISILI", 50);
            $table->enum("JENIS_KELAMIN", ["PRIA", "WANITA"]);

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PELANGGAN');
    }
};
