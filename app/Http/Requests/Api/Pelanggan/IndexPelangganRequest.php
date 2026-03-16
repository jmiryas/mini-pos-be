<?php

namespace App\Http\Requests\Api\Pelanggan;

use Illuminate\Foundation\Http\FormRequest;

class IndexPelangganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "filter" => "nullable|array",
            "filter.nama" => "nullable|string|max:50",
            "filter.domisili" => "nullable|string|max:50",
            "filter.jenis_kelamin" => "nullable|string|in:PRIA,WANITA",
            "sort" => "nullable|string",
            "per_page" => "nullable|integer|min:1|max:100",
        ];
    }
}
