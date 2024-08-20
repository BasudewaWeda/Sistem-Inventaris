<?php

namespace Database\Seeders;

use App\Models\Kantor;
use App\Models\Lantai;
use App\Models\Ruangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kantor' => 'Super Branch BPR Lestari Sanur', 'slug' => 'super-branch-bpr-lestari-sanur', 'kode_kantor' => '001', 'nomor_telepon_kantor' => '0361272211', 'alamat_kantor' => 'Jl. By Pass Ngurah Rai No. 101X Denpasar Selatan', 'provinsi_id' => 17, 'kabupaten_id' => 282, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_kantor' => 'BPR Lestari Benoa', 'slug' => 'bpr-lestari-benoa', 'kode_kantor' => '002', 'nomor_telepon_kantor' => '03614481221', 'alamat_kantor' => 'Jalan Diponegoro, Pesanggaran, Denpasar', 'provinsi_id' => 17, 'kabupaten_id' => 282, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_kantor' => 'BPR Lestari WR Supratman', 'slug' => 'bpr-lestari-wr-supratman', 'kode_kantor' => '003', 'nomor_telepon_kantor' => '0361225710', 'alamat_kantor' => 'Jalan WR Supratman No. 141, Denpasar', 'provinsi_id' => 17, 'kabupaten_id' => 282, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_kantor' => 'BPR Lestari Jimbaran', 'slug' => 'bpr-lestari-jimbaran', 'kode_kantor' => '004', 'nomor_telepon_kantor' => '03614468794', 'alamat_kantor' => 'Jalan Raya Uluwatu, Jimbaran Arcade Blok F & G, Kuta Sel., Kabupaten Badung,', 'provinsi_id' => 17, 'kabupaten_id' => 274, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_kantor' => 'BPR Lestari Renon Square', 'slug' => 'bpr-lestari-renon-square', 'kode_kantor' => '005', 'nomor_telepon_kantor' => '0361247547', 'alamat_kantor' => 'Jalan Raya Puputan Renon no.174 Pertokoan Renon Square Blok F, Denpasar', 'provinsi_id' => 17, 'kabupaten_id' => 282, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_kantor' => 'BPR Lestari Renon', 'slug' => 'bpr-lestari-renon', 'kode_kantor' => '006', 'nomor_telepon_kantor' => '0361229931', 'alamat_kantor' => 'Jalan Letda Tantular No. 1 Blok A 16 Pertokoan Dewata Square, Denpasar', 'provinsi_id' => 17, 'kabupaten_id' => 282, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_kantor' => 'BPR Lestari Gatsu Tengah', 'slug' => 'bpr-lestari-gatsu-tengah', 'kode_kantor' => '007', 'nomor_telepon_kantor' => '03618450016', 'alamat_kantor' => 'JL. Gatot Subroto, No 356, Tonja, Denpasar', 'provinsi_id' => 17, 'kabupaten_id' => 282, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_kantor' => 'BPR Lestari Hayam Wuruk', 'slug' => 'bpr-lestari-hayam-wuruk', 'kode_kantor' => '008', 'nomor_telepon_kantor' => '0361222191', 'alamat_kantor' => 'Jalan Hayam Wuruk No. 113, Denpasar', 'provinsi_id' => 17, 'kabupaten_id' => 282, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_kantor' => 'BPR Lestari Pusat Teuku Umar', 'slug' => 'bpr-lestari-pusat-teuku-umar', 'kode_kantor' => '009', 'nomor_telepon_kantor' => '0361246706', 'alamat_kantor' => 'Jalan Teuku Umar 110 Denpasar Bali, Indonesia', 'provinsi_id' => 17, 'kabupaten_id' => 282, 'creator_id' => 1, 'editor_id' => 1],
        ];

        foreach ($data as $kantor) {
            Kantor::create($kantor);
        }

        $data = [
            ['nama_lantai' => 'Lantai 1', 'kantor_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_lantai' => 'Lantai 2', 'kantor_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_lantai' => 'Lantai 1', 'kantor_id' => 2, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_lantai' => 'Lantai 2', 'kantor_id' => 2, 'creator_id' => 1, 'editor_id' => 1],
        ];

        foreach ($data as $lantai) {
            Lantai::create($lantai);
        }

        $data = [
            ['nama_ruangan' => 'Ruangan Direksi', 'detail_ruangan' => 'Test 123',  'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 1, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 3, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 3, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 3, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 3, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 3, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Direksi', 'detail_ruangan' => 'Test 123',  'lantai_id' => 2, 'creator_id' => 1, 'editor_id' => 1],
            ['nama_ruangan' => 'Ruangan Pantry', 'detail_ruangan' => 'Test 123', 'lantai_id' => 2, 'creator_id' => 1, 'editor_id' => 1],
        ];

        foreach ($data as $ruangan) {
            Ruangan::create($ruangan);
        }
    }
}
