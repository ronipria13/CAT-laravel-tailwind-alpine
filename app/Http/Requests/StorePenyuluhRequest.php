<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenyuluhRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'penyuluh_name' => 'required',
            'penyuluh_province' => 'required',
            'penyuluh_regency' => 'required',
            'penyuluh_district' => 'required',
            'penyuluh_village' => 'required',
            'penyuluh_address' => 'required',
            'user_id' => 'required',
        ];
    }
}
