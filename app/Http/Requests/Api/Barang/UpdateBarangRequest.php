<?php

namespace App\Http\Requests\Api\Barang;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'     => 'sometimes|required|string|max:100',
            'kategori' => 'sometimes|required|string|max:50',
            'harga'    => 'sometimes|required|numeric|min:0',
        ];
    }
}
