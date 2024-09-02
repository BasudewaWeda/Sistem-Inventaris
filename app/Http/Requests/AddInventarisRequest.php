<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Lantai;
use App\Models\Ruangan;
use Illuminate\Foundation\Http\FormRequest;

class AddInventarisRequest extends FormRequest
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
            'judul_input_inventaris' => 'required|string|max:255',
            'nama_inventaris' => 'required|string|max:255',
            'jumlah_inventaris' => 'required|numeric',
            'harga_inventaris' => [
                'required',
                'regex:/^Rp\. \d{1,3}(\.\d{3})*(,\d{2})?$/',
                'string'
            ],
            'kategori_id' =>'required|numeric|exists:kategori,kategori_id',
            'tanggal_pembelian' => 'required|date|before_or_equal:today',
            'tahun_penyusutan' => 'required|numeric',
            'kantor_id' => 'required|numeric|exists:kantor,kantor_id',
            'lantai_id' => [
                'required',
                'numeric',
                'exists:lantai,lantai_id',
                function ($attribute, $value, $fail) {
                    if ($value !== null) {
                        $lantai = Lantai::find($value);
                        if (!$lantai || $lantai->kantor_id != $this->input('kantor_id')) {
                            $fail('Lantai tidak terdapat pada kantor tersebut');
                        }
                    }
                }
            ],
            'ruangan_id' => [
                'required',
                'numeric',
                'exists:ruangan,ruangan_id',
                function ($attribute, $value, $fail) {
                    if ($value !== null) {
                        $ruangan = Ruangan::find($value);
                        if (!$ruangan || $ruangan->lantai_id != $this->input('lantai_id')) {
                            $fail('Ruangan tidak terdapat pada lantai tersebut');
                        }
                    }
                }
            ],
            'approver_1' => [
                'required',
                'numeric',
                'exists:users,user_id',
                function ($attribute, $value, $fail) {
                    if(!User::approverCheck($value, 1)) {
                        $fail('User bukan approver 1');
                    }
                }
            ],
            'approver_2' => [
                'required',
                'numeric',
                'exists:users,user_id',
                function ($attribute, $value, $fail) {
                    if(!User::approverCheck($value, 2)) {
                        $fail('User bukan approver 1');
                    }
                }
            ]
        ];
    }

    public function messages() {
        return [
            'kategori_id.required' => 'Select a Kategori',
            'kantor_id.required' => 'Select a Kantor',
            'lantai_id.required' => 'Select a Lantai',
            'ruangan_id.required' => 'Select a Ruangan',
            'approver_1.required' => 'Select Approver 1',
            'approver_2.required' => 'Select Approver 2',
            'tanggal_pembelian.before_or_equal' => 'Tanggal pembelian cannot be later than today',
        ];
    }
}
