<?php

namespace App\Http\Requests\Api\Barang;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'     => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'harga'    => 'required|numeric|min:0',
        ];
    }
}
