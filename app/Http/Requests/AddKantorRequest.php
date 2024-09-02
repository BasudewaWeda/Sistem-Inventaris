<?php

namespace App\Http\Requests;

use App\Models\Kabupaten;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
            'nama_kantor' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $slug = Str::slug($value);
        
                    // Query to check if the slug already exists
                    $exists = DB::table('kantor')
                        ->where('slug', $slug)
                        ->exists();
        
                    if ($exists) {
                        $fail('Kantor name already in system');
                    }
                },
            ],
            'kode_kantor' => 'required|numeric|digits:3|unique:kantor,kode_kantor',
            'nomor_telepon_kantor' => 'required|numeric|digits_between:10,13|unique:kantor',
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

    public function messages() {
        return [
            'kode_kantor.unique' => 'Kode kantor already in system',
            'provinsi_id.required' => 'Please select Provinsi',
            'kabupaten_id.required' => 'Please select Kabupaten',
            'lantai.*.nama_lantai.required' => 'Nama lantai field is required',
            'lantai.*.ruangan.*.nama_ruangan.required' => 'Nama ruangan field is required',
            'lantai.*.ruangan.*.detail_ruangan.required' => 'Detail ruangan field is required',
            'lantai.*.nama_lantai.max' => 'Nama lantai field cannot be more than 255 characters',
            'lantai.*.ruangan.*.nama_ruangan.max' => 'Nama ruangan field cannot be more than 255 characters',
            'lantai.*.ruangan.*.detail_ruangan.max' => 'Detail ruangan field cannot be more than 255 characters',
        ];
    }
}
