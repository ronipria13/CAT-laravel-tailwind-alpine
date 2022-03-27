<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSegmentRequest extends FormRequest
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
            'segment_code' => 'required|unique:segments,segment_code|max:10',
            'segment_name' => 'max:100',
            'segment_stratifikasi' => 'required|max:10',
            'segment_province' => 'required',
            'segment_regency' => 'required',
            'segment_district' => 'required',
            'segment_village' => 'required',
            'segment_address' => 'required',
            'segment_coordinate' => ['required','regex:/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/'],
            // 'segment_desc' => 'required',
            'penyuluh_id' => 'required',
        ];
    }

    /**
     * get custom attributes for validator errors.
     * 
     * @return array
     */
    public function attributes()
    {
        return [
            'segment_code' => 'Kode Segment',
            'segment_name' => 'Nama Segment',
            'segment_stratifikasi' => 'Stratifikasi',
            'segment_province' => 'Provinsi',
            'segment_regency' => 'Kabupaten/Kota',
            'segment_district' => 'Kecamatan',
            'segment_village' => 'Kelurahan',
            'segment_address' => 'Alamat',
            'segment_coordinate' => 'Koordinat',
            'segment_desc' => 'Keterangan',
            'penyuluh_id' => 'Penyuluh',
        ];
    }
}
