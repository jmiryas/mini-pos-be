<?php

namespace App\Http\Requests\Api\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class IndexPenjualanBulananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "filter" => "nullable|array",
            "filter.periode_awal" => "nullable|date_format:Y-m",
            "filter.periode_akhir" => "nullable|date_format:Y-m",
            "sort" => "nullable|string",
        ];
    }
}
