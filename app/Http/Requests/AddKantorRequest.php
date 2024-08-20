<?php

namespace App\Http\Requests;

use App\Models\Kabupaten;
use Illuminate\Foundation\Http\FormRequest;

class AddKantorRequest extends FormRequest
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
            'nama_kantor' => 'required|string|max:255|unique:kantor,nama_kantor',
            'kode_kantor' => 'required|numeric|digits:3|unique:kantor,kode_kantor',
            'nomor_telepon_kantor' => 'required|numeric|digits_between:9,12',
            'alamat_kantor' => 'required|string|max:255',
            'provinsi_id' => 'required|numeric|exists:provinsi,provinsi_id',
            'kabupaten_id' => [
                'required',
                'numeric',
                'exists:kabupaten,kabupaten_id',
                function ($attribute, $value, $fail) {
                    if ($value !== null) {
                        $kabupaten = Kabupaten::find($value);
                        if (!$kabupaten || $kabupaten->provinsi_id != $this->input('provinsi_id')) {
                            $fail('Kabupaten tidak terdapat pada provinsi tersebut');
                        }
                    }
                }
            ],
            'lantai.*.nama_lantai' => 'required|string|max:255',
            'lantai.*.ruangan.*.nama_ruangan' => 'required|string|max:255',
            'lantai.*.ruangan.*.detail_ruangan' => 'required|string|max:255',
        ];
    }
}
