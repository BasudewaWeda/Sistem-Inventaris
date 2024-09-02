<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Lantai;
use App\Models\Ruangan;
use Illuminate\Foundation\Http\FormRequest;

class AddPemindahanInventarisRequest extends FormRequest
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
            'judul_pemindahan_inventaris' => 'required|string|max:255',
            'inventaris_ids' => 'required|string',
            'kantor_id_tujuan' => 'required|numeric|exists:kantor,kantor_id',
            'lantai_id_tujuan' => [
                'required',
                'numeric',
                'exists:lantai,lantai_id',
                function ($attribute, $value, $fail) {
                    if ($value !== null) {
                        $lantai = Lantai::find($value);
                        if (!$lantai || $lantai->kantor_id != $this->input('kantor_id_tujuan')) {
                            $fail('Lantai tidak terdapat pada kantor tersebut');
                        }
                    }
                }
            ],
            'ruangan_id_tujuan' => [
                'required',
                'numeric',
                'exists:ruangan,ruangan_id',
                function ($attribute, $value, $fail) {
                    if ($value !== null) {
                        $ruangan = Ruangan::find($value);
                        if (!$ruangan || $ruangan->lantai_id != $this->input('lantai_id_tujuan')) {
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
            'kantor_id_tujuan.required' => 'Select Kantor',
            'lantai_id_tujuan.required' => 'Select Lantai',
            'ruangan_id_tujuan.required' => 'Select Ruangan',
            'approver_1.required' => 'Select Approver 1',
            'approver_2.required' => 'Select Approver 2',
        ];
    }
}
