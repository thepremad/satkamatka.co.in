<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StarLineStoreGameNameRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'name_hindi' => 'nullable|string',
            'today_open_time' => 'required|date_format:H:i',
            // 'today_close_time' => 'required|date_format:H:i',
            // 'status' => 'boolean',
            // 'market_status' => 'required|string',
        ];
    }
}
