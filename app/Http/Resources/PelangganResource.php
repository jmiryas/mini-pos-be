<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PelangganResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id_pelanggan" => $this->ID_PELANGGAN,
            "nama" => $this->NAMA,
            "domisili" => $this->DOMISILI,
            "jenis_kelamin" => $this->JENIS_KELAMIN,
        ];
    }
}
