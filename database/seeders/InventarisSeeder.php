<?php

namespace Database\Seeders;

use App\Models\Inventaris;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'Furniture', 'slug' => 'furniture', 'creator_id' => 1, 'editor_id' => 1],
            ['nama_kategori' => 'Elektronik', 'slug' => 'elektronik', 'creator_id' => 1, 'editor_id' => 1],
            ['nama_kategori' => 'IT', 'slug' => 'it', 'creator_id' => 1, 'editor_id' => 1],
        ];

        foreach ($data as $kategori) {
            Kategori::create($kategori);
        }

        $data = [
            ['nama_inventaris' => 'Meja', 'harga_inventaris' => '500000', 'tanggal_pembelian' => Carbon::parse('2024-08-05 08:00:00'), 'tahun_penyusutan' => 5, 'kategori_id' => 1, 'kantor_id' => 1, 'lantai_id' => 1, 'ruangan_id' => 1, 'creator_id' => 2, 'approver_1' => 5, 'approver_2' => 3, 'status_inventaris' => 'Pending Approval', 'kondisi_inventaris' => 'Normal'],
            ['nama_inventaris' => 'Meja', 'harga_inventaris' => '500000', 'tanggal_pembelian' => Carbon::parse('2024-08-05 08:00:00'), 'tahun_penyusutan' => 5, 'kategori_id' => 1, 'kantor_id' => 1, 'lantai_id' => 1, 'ruangan_id' => 1, 'creator_id' => 2, 'approver_1' => 5, 'approver_2' => 3, 'status_inventaris' => 'Pending Approval', 'kondisi_inventaris' => 'Normal'],
            ['nama_inventaris' => 'Meja', 'harga_inventaris' => '500000', 'tanggal_pembelian' => Carbon::parse('2024-08-05 08:00:00'), 'tahun_penyusutan' => 5, 'kategori_id' => 1, 'kantor_id' => 1, 'lantai_id' => 1, 'ruangan_id' => 1, 'creator_id' => 2, 'approver_1' => 5, 'approver_2' => 3, 'status_inventaris' => 'Pending Approval', 'kondisi_inventaris' => 'Normal'],
            ['nama_inventaris' => 'Meja', 'harga_inventaris' => '500000', 'tanggal_pembelian' => Carbon::parse('2024-08-05 08:00:00'), 'tahun_penyusutan' => 5, 'kategori_id' => 1, 'kantor_id' => 1, 'lantai_id' => 1, 'ruangan_id' => 1, 'creator_id' => 2, 'approver_1' => 5, 'approver_2' => 3, 'status_inventaris' => 'Pending Approval', 'kondisi_inventaris' => 'Normal'],
            ['nama_inventaris' => 'Meja', 'harga_inventaris' => '500000', 'tanggal_pembelian' => Carbon::parse('2024-08-05 08:00:00'), 'tahun_penyusutan' => 5, 'kategori_id' => 1, 'kantor_id' => 1, 'lantai_id' => 1, 'ruangan_id' => 1, 'creator_id' => 2, 'approver_1' => 5, 'approver_2' => 3, 'status_inventaris' => 'Pending Approval', 'kondisi_inventaris' => 'Normal'],
            ['nama_inventaris' => 'Kursi', 'harga_inventaris' => '500000', 'tanggal_pembelian' => Carbon::parse('2024-08-05 08:00:00'), 'tahun_penyusutan' => 5, 'kategori_id' => 1, 'kantor_id' => 1, 'lantai_id' => 1, 'ruangan_id' => 1, 'creator_id' => 2, 'approver_1' => 5, 'approver_2' => 3, 'status_inventaris' => 'Pending Approval', 'kondisi_inventaris' => 'Normal'],
            ['nama_inventaris' => 'Kursi', 'harga_inventaris' => '500000', 'tanggal_pembelian' => Carbon::parse('2024-08-05 08:00:00'), 'tahun_penyusutan' => 5, 'kategori_id' => 1, 'kantor_id' => 1, 'lantai_id' => 1, 'ruangan_id' => 1, 'creator_id' => 2, 'approver_1' => 5, 'approver_2' => 3, 'status_inventaris' => 'Pending Approval', 'kondisi_inventaris' => 'Normal'],
            ['nama_inventaris' => 'Kursi', 'harga_inventaris' => '500000', 'tanggal_pembelian' => Carbon::parse('2024-08-05 08:00:00'), 'tahun_penyusutan' => 5, 'kategori_id' => 1, 'kantor_id' => 1, 'lantai_id' => 1, 'ruangan_id' => 1, 'creator_id' => 2, 'approver_1' => 5, 'approver_2' => 3, 'status_inventaris' => 'Pending Approval', 'kondisi_inventaris' => 'Normal'],
        ];

        foreach ($data as $inventaris) {
            Inventaris::create($inventaris);
        }
    }
}
