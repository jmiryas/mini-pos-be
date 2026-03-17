<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = "pelanggan";
    protected $primaryKey = "ID_PELANGGAN";
    protected $keyType = "string";
    protected $fillable = ["ID_PELANGGAN", "NAMA", "DOMISILI", "JENIS_KELAMIN"];

    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'ID_PELANGGAN' => 'string',
        'NAMA' => 'string',
        'DOMISILI' => 'string',
        'JENIS_KELAMIN' => 'string',
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, "KODE_PELANGGAN", "ID_PELANGGAN");
    }
}
