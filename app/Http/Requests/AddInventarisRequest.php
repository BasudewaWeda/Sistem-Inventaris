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
            'judul_input_inventaris' => 'required|string|max:50',
            'nama_inventaris' => 'required|string|max:50',
            'jumlah_inventaris' => 'required|numeric',
            'harga_inventaris' => 'required|numeric',
            'tanggal_pembelian' => 'required|date',
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
}
