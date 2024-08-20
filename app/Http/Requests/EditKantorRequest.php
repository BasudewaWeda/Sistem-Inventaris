<?php

namespace App\Http\Requests;

use App\Models\Kabupaten;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditKantorRequest extends FormRequest
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
        $kantorId = $this->route('kantor')->kantor_id;

        return [
            'nama_kantor' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kantor', 'nama_kantor')->ignore($kantorId, 'kantor_id')
            ],
            'kode_kantor' => [
                'required',
                'numeric',
                'digits:3',
                Rule::unique('kantor', 'kode_kantor')->ignore($kantorId, 'kantor_id')
            ],
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
            'lantai.*.lantai_id' => 'nullable|exists:lantai,lantai_id',
            'lantai.*.ruangan.*.ruangan_id' => 'nullable|exists:ruangan,ruangan_id',
            'lantai.*.ruangan.*.nama_ruangan' => 'required|string|max:255',
            'lantai.*.ruangan.*.detail_ruangan' => 'required|string|max:255',
        ];
    }
}
