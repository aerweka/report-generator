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
        return false;
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
            'JENIS_LAPORAN' => ['required', 'string', 'max:255'],
            'JUDUL_LAPORAN' => ['required', 'string', 'max:255'],
            'COVER_LAPORAN' => ['required', 'file'],
            'KETERANGAN_LAPORAN' => ['string', 'max:255'],
        ];
    }
}
