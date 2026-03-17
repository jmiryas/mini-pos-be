<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPenjualan extends Model
{
    protected $table = "item_penjualan";
    protected $keyType = "string";
    protected $fillable = ["NOTA", "KODE_BARANG", "Qty"];

    public $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'NOTA' => 'string',
        'KODE_BARANG' => 'string',
        'Qty' => 'integer',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, "NOTA", "ID_NOTA");
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, "KODE_BARANG", "KODE");
    }
}
