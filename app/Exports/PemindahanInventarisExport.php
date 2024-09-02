<?php

namespace App\Exports;

use App\Models\PemindahanInventaris;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemindahanInventarisExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        return PemindahanInventaris::getLaporanPemindahanInventaris($this->request)->getCollection()->map(function($item) {
            $created_at = $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A';
            $approval_1_date = $item->approval_1_date ?? 'N/A';
            $approval_2_date = $item->approval_2_date ?? 'N/A';
            $rejection_date = $item->rejection_date ?? 'N/A';
            $rejection_reason = $item->alasan_rejection ?? 'N/A';
            
            return [
                $item->judul_pemindahan_inventaris ?? 'N/A',
                $item->inventaris->count() ?? 0,
                $item->status_pemindahan_inventaris,
                $item->kantorTujuan->nama_kantor ?? 'N/A',
                $item->lantaiTujuan->nama_lantai ?? 'N/A',
                $item->ruanganTujuan->nama_ruangan ?? 'N/A',
                $item->creator ? $item->creator->user_name : 'N/A',
                $created_at,
                $item->firstApprover ? $item->firstApprover->user_name : 'N/A',
                $item->secondApprover ? $item->secondApprover->user_name : 'N/A',
                $approval_1_date,
                $approval_2_date,
                $rejection_date,
                $rejection_reason,
            ];
        });
    }

    public function headings(): array {
        return [
            'judul_pemindahan',
            'jumlah_inventaris',
            'status_pemindahan',
            'kantor_tujuan',
            'lantai_tujuan',
            'ruangan_tujuan',
            'creator',
            'created_at',
            'first_approver',
            'second_approver',
            'approval_1_date',
            'approval_2_date',
            'rejection_date',
            'rejection_reason'
        ];
    }
}
