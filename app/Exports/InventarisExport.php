<?php

namespace App\Exports;

use App\Models\Inventaris;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventarisExport implements FromCollection, WithHeadings
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
        return Inventaris::getLaporanInventaris($this->request)->getCollection()->map(function($item) {
            $harga_inventaris = intval(substr(str_replace(['Rp', '.', ',', ' '], '', $item->harga_inventaris), 0, -2));
            $tahun_penyusutan = intval($item->tahun_penyusutan);
            $tanggal_pembelian = $item->tanggal_pembelian ? $item->tanggal_pembelian->format('Y-m-d') : 'N/A';
            $created_at = $item->created_at ? $item->created_at->format('Y-m-d') : 'N/A';
            $approval_1_date = $item->approval_1_date ?? 'N/A';
            $approval_2_date = $item->approval_2_date ?? 'N/A';

            return [
                $item->nomor_inventaris ?? 'N/A',
                $item->nama_inventaris ?? 'N/A',
                $harga_inventaris,
                $tanggal_pembelian ?? 'N/A',
                $tahun_penyusutan ?? 'N/A',
                $item->kategori ? $item->kategori->nama_kategori : 'N/A', 
                $item->status_inventaris ?? 'N/A',
                $item->kondisi_inventaris ?? 'N/A',
                $item->kantor ? $item->kantor->nama_kantor : 'N/A',
                $item->lantai ? $item->lantai->nama_lantai : 'N/A',
                $item->ruangan ? $item->ruangan->nama_ruangan : 'N/A',
                $item->creator ? $item->creator->user_name : 'N/A',
                $created_at,
                $item->firstApprover ? $item->firstApprover->user_name : 'N/A',
                $item->secondApprover ? $item->secondApprover->user_name : 'N/A',
                $approval_1_date,
                $approval_2_date,
            ];
        });
    }

    public function headings(): array {
        return [
            'nomor_inventaris',
            'nama_inventaris',
            'harga_inventaris',
            'tanggal_pembelian',
            'tahun_penyusutan',
            'kategori', 
            'status_inventaris',
            'kondisi_inventaris',
            'kantor',
            'lantai',
            'ruangan',
            'creator',
            'created_at',
            'first_approver',
            'second_approver',
            'approval_1_date',
            'approval_2_date',
        ];
    }
}
