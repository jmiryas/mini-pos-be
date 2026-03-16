<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = "BARANG";
    protected $primaryKey = "KODE";
    protected $keyType = "string";
    protected $fillable = ["KODE", "NAMA", "KATEOGRI", "HARGA"];

    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'KODE' => 'string',
        'HARGA' => 'decimal:2',
    ];

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, "KODE_BARANG", "KODE");
    }
}
