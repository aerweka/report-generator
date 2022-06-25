<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanRequest extends FormRequest
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
            'M_GRUP_ID' => ['required', 'integer'],
            'M_JENIS_LAPORAN_ID' => ['required', 'integer'],
            'JUDUL_LAPORAN' => ['required', 'string', 'max:255'],
            'COVER_LAPORAN' => ['file'],
            'KETERANGAN_LAPORAN' => ['string', 'max:255'],
        ];
    }
}
