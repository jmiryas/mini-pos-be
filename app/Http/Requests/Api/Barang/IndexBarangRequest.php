<?php

namespace App\Http\Requests\Api\Barang;

use Illuminate\Foundation\Http\FormRequest;

class IndexBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'filter' => 'nullable|array',
            'filter.nama' => 'nullable|string|max:100',
            'filter.kategori' => 'nullable|string|max:50',
            'filter.harga_min' => 'nullable|numeric|min:0',
            'filter.harga_max' => 'nullable|numeric|min:0',

            'sort' => 'nullable|string',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }
}
