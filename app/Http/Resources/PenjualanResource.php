<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenjualanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id_nota" => $this->ID_NOTA,
            "tgl" => date("Y-m-d", strtotime($this->TGL)),
            "kode_pelanggan" => $this->KODE_PELANGGAN,
            "subtotal" => (float) $this->SUBTOTAL,

            // Relasi Eager Loading via Spatie
            "pelanggan" => new PelangganResource($this->whenLoaded("pelanggan")),
            "items" => ItemPenjualanResource::collection($this->whenLoaded("items")),
        ];
    }
}
