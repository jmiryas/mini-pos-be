<?php

namespace App\Http\Requests\Api\Penjualan;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePenjualanRequest extends FormRequest
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
            "kode_pelanggan" => "sometimes|required|string|exists:PELANGGAN,ID_PELANGGAN",
            "tgl" => "sometimes|required|date",

            "items" => "sometimes|required|array|min:1",
            "items.*.kode_barang" => "required_with:items|string|exists:BARANG,KODE",
            "items.*.qty" => "required_with:items|integer|min:1",
        ];
    }
}
