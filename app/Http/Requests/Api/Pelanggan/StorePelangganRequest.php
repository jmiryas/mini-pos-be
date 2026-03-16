<?php

namespace App\Http\Requests\Api\Pelanggan;

use Illuminate\Foundation\Http\FormRequest;

class StorePelangganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nama" => "required|string|max:50",
            "domisili" => "required|string|max:50",
            "jenis_kelamin" => "required|string|in:PRIA,WANITA",
        ];
    }
}
