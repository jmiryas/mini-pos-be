<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemPenjualanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "nota"        => $this->NOTA,
            "kode_barang" => $this->KODE_BARANG,
            "qty"         => (int) $this->Qty,

            // Akan muncul jika di-include oleh frontend
            "barang"      => new BarangResource($this->whenLoaded("barang")),
        ];
    }
}
