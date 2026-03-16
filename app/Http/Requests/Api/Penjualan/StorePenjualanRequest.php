<?php

namespace App\Http\Requests\Api\Penjualan;

use Illuminate\Foundation\Http\FormRequest;

class StorePenjualanRequest extends FormRequest
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
            "kode_pelanggan" => "required|string|max:50|exists:pelanggan,id_pelanggan",
            "tgl" => "required|date_format:Y-m-d",
            "items" => "required|array|min:1",
            "items.*.kode_barang" => "required|string|max:50|exists:barang,kode",
            "items.*.qty" => "required|integer|min:1"
        ];
    }
}
