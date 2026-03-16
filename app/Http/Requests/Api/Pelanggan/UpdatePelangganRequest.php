<?php

namespace App\Http\Requests\Api\Pelanggan;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePelangganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nama" => "sometimes|required|string|max:50",
            "domisili" => "sometimes|required|string|max:50",
            "jenis_kelamin" => "sometimes|required|string|in:PRIA,WANITA",
        ];
    }
}
