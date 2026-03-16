<?php

namespace App\Http\Requests\Api\Penjualan;

use Illuminate\Foundation\Http\FormRequest;

class IndexPenjualanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "filter" => "nullable|array",
            "filter.id_nota" => "nullable|string|max:50",
            "filter.kode_pelanggan" => "nullable|string|max:50",
            "filter.tgl_mulai" => "nullable|date",
            "filter.tgl_akhir" => "nullable|date",

            "sort" => "nullable|string",
            "include" => "nullable|string", // Mengizinkan query ?include=...
            "per_page" => "nullable|integer|min:1|max:100",
        ];
    }
}
