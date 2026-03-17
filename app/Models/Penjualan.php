<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = "penjualan";
    protected $primaryKey = "ID_NOTA";
    protected $keyType = "string";
    protected $fillable = ["ID_NOTA", "TGL", "KODE_PELANGGAN", "SUBTOTAL"];

    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'ID_NOTA' => 'string',
        'KODE_PELANGGAN' => 'string',
        'TGL' => 'date:Y-m-d',
        'SUBTOTAL' => 'decimal:2',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, "KODE_PELANGGAN", "ID_PELANGGAN");
    }

    public function items()
    {
        return $this->hasMany(ItemPenjualan::class, "NOTA", "ID_NOTA");
    }
}
