<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Inventaris extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'inventaris_id';
    protected $table = 'inventaris';

    protected $fillable = [
        'nama_inventaris',
        'harga_inventaris',
        'tanggal_pembelian',
        'tahun_penyusutan',
        'status_inventaris',
        'kondisi_inventaris',
        'kategori_id',
        'kantor_id',
        'lantai_id',
        'ruangan_id',
        'approver_1',
        'approver_2',
        'creator_id',
        'approval_1_date',
        'approval_2_date',
        'input_inventaris_id',
    ];

    protected $casts = [
        'tanggal_pembelian' => 'date',
        'created_at' => 'datetime',
    ];

    static public function getInventarisByIds($ids) {
        $relations = ['kategori', 'kantor', 'lantai', 'ruangan', 'firstApprover', 'secondApprover'];
        return self::with($relations)->whereIn('inventaris_id', $ids)->get();
    }

    static public function getInventarisRecord() {
        $relations = ['kategori', 'kantor', 'lantai', 'ruangan', 'creator'];
        return self::with($relations)->filter(request(['search']))->orderByDesc('updated_at', 'inventaris_id')->paginate(10)->withQueryString();
    }

    public function getInventarisDetails() {
        $this->load(['kategori', 'kantor', 'lantai', 'ruangan', 'creator', 'firstApprover', 'secondApprover', 'qrcode']);
    }

    static public function getLaporanInventaris(array $request) {
        $query = self::with(['kategori', 'kantor', 'lantai', 'ruangan', 'creator', 'firstApprover', 'secondApprover'])
            ->whereDate('created_at', '<=', $request['end_date']);

        if (!isset($request['proporsi'])) {
            $query->whereDate('created_at', '>=', $request['start_date']);
        }

        if (!empty($request['kategori_id'])) {
            $query->where('kategori_id', $request['kategori_id']);
        }

        if (!empty($request['kantor_id'])) {
            $query->where('kantor_id', $request['kantor_id']);
        }

        if (!empty($request['status'])) {
            $query->where('status_inventaris', $request['status']);
        }

        if (!empty($request['kondisi'])) {
            $query->where('kondisi_inventaris', $request['kondisi']);
        }

        return $query->orderByDesc('created_at')->paginate(10)->withQueryString();
    }

    function scopeFilter(Builder $query, array $filters) : void {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $search = strtolower($search); // Convert search term to lowercase
    
            $query->where(function ($q) use ($search) {
                $columns = ['nama_inventaris', 'status_inventaris'];
    
                foreach ($columns as $column) {
                    $q->orWhereRaw('LOWER(' . $column . ') LIKE ?', ["%{$search}%"])->distinct();
                }
    
                $q->orWhereHas('kategori', function ($q) use ($search) {
                    $q->whereRaw('LOWER(nama_kategori) LIKE ?', ["%{$search}%"]);
                });
    
                $q->orWhereHas('kantor', function ($q) use ($search) {
                    $q->whereRaw('LOWER(nama_kantor) LIKE ?', ["%{$search}%"]);
                });
    
                $q->orWhereHas('lantai', function ($q) use ($search) {
                    $q->whereRaw('LOWER(nama_lantai) LIKE ?', ["%{$search}%"]);
                });
    
                $q->orWhereHas('ruangan', function ($q) use ($search) {
                    $q->whereRaw('LOWER(nama_ruangan) LIKE ?', ["%{$search}%"]);
                });
    
                $q->orWhereHas('creator', function ($q) use ($search) {
                    $q->whereRaw('LOWER(user_name) LIKE ?', ["%{$search}%"]);
                });
            });
        });
    }

    static public function createInventaris(array $data, $inputId) {
        $inventarisData = [];
        $timestamp = now();

        for ($i = 0; $i < $data['jumlah_inventaris']; $i++) {
            $inventarisData[] = [
                'nama_inventaris' => $data['nama_inventaris'],
                'tanggal_pembelian' => $data['tanggal_pembelian'],
                'harga_inventaris' => $data['harga_inventaris'],
                'tahun_penyusutan' => $data['tahun_penyusutan'],
                'status_inventaris' => 'Pending Approval',
                'kondisi_inventaris' => 'Normal',
                'kategori_id' => $data['kategori_id'],
                'kantor_id' => $data['kantor_id'],
                'lantai_id' => $data['lantai_id'],
                'ruangan_id' => $data['ruangan_id'],
                'approver_1' => $data['approver_1'],
                'approver_2' => $data['approver_2'],
                'creator_id' => User::getCurrentUser()->user_id,
                'input_inventaris_id' => $inputId,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        self::insert($inventarisData);
    }

    public function ubahKondisiInventaris(string $kondisi) {
        $this->kondisi_inventaris = $kondisi;

        $this->save();
    }

    static public function approveInventaris(InputInventaris $inputInventaris) {
        $inventarisCollection = $inputInventaris->inventaris;
        $statusInputInventaris = $inputInventaris->status_input_inventaris;

        if ($statusInputInventaris == "Approval 2") {
            $kodeKantor = $inputInventaris->kantor->kode_kantor;
            $sequenceKantor = (int)$inputInventaris->kantor->sequence_kantor;
    
            $inventarisCollection->each(function ($inventaris) use ($statusInputInventaris, $kodeKantor, &$sequenceKantor) {
                $inventaris->nomor_inventaris = "INV/" . $kodeKantor . "/" . date('m') . "/" . date('y') . "/" . str_pad($sequenceKantor, 4, '0', STR_PAD_LEFT);
                $inventaris->status_inventaris = $statusInputInventaris;
                $inventaris->approval_2_date = Carbon::now();

                $qrCode = QRCodeInventaris::createQRCode($inventaris);
                $inventaris->qrcode_id = $qrCode->qrcode_id;
    
                $sequenceKantor++;
    
                $inventaris->save();
            });
    
            $inputInventaris->kantor->sequence_kantor = str_pad($sequenceKantor, 4, '0', STR_PAD_LEFT);
            $inputInventaris->kantor->save();
        }
        else {
            $inventarisIds = $inventarisCollection->pluck('inventaris_id');
            $currentTime = Carbon::now();

            self::whereIn('inventaris_id', $inventarisIds)
                ->update(['status_inventaris' => $statusInputInventaris, 'updated_at' => $currentTime, 'approval_1_date' => $currentTime]);
        }
    }

    static public function rejectInventaris(InputInventaris $inputInventaris) {
        $inventarisIds = $inputInventaris->inventaris->pluck('inventaris_id');

        self::whereIn('inventaris_id', $inventarisIds)->delete(); // Deleted because rejected
    }

    static public function approvePemindahanInventaris(PemindahanInventaris $pemindahanInventaris) {
        $inventarisCollection = $pemindahanInventaris->inventaris;
        $statusPemindahanInventaris = $pemindahanInventaris->status_pemindahan_inventaris;

        if ($statusPemindahanInventaris == "Approval 2") {
            $kantorTujuan = $pemindahanInventaris->kantorTujuan;

            $idKantorTujuan = $kantorTujuan->kantor_id;
            $idLantaiTujuan = $pemindahanInventaris->lantaiTujuan->lantai_id;
            $idRuanganTujuan = $pemindahanInventaris->ruanganTujuan->ruangan_id;

            $inventarisIds = $inventarisCollection->pluck('inventaris_id');

            self::whereIn('inventaris_id', $inventarisIds)->update([
                'status_inventaris' => $statusPemindahanInventaris,
                'kantor_id' => $idKantorTujuan,
                'lantai_id' => $idLantaiTujuan,
                'ruangan_id' => $idRuanganTujuan,
                'updated_at' => now()
            ]);
    
            // $inventarisCollection->each(function ($inventaris) use ($statusPemindahanInventaris, $kodeKantor, &$sequenceKantor, $idKantorTujuan, $idLantaiTujuan, $idRuanganTujuan) {
            //     $inventaris->nomor_inventaris = "INV/" . $kodeKantor . "/" . date('m') . "/" . date('y') . "/" . str_pad($sequenceKantor, 4, '0', STR_PAD_LEFT);
            //     $inventaris->status_inventaris = $statusPemindahanInventaris;
            //     $inventaris->kantor_id = $idKantorTujuan;
            //     $inventaris->lantai_id = $idLantaiTujuan;
            //     $inventaris->ruangan_id = $idRuanganTujuan;
    
            //     $sequenceKantor++;
    
            //     $inventaris->save();
            // });
    
            // $pemindahanInventaris->kantorTujuan->sequence_kantor = str_pad($sequenceKantor, 4, '0', STR_PAD_LEFT);
            // $pemindahanInventaris->kantorTujuan->save();
        }
        else {
            $inventarisIds = $inventarisCollection->pluck('inventaris_id');
            $currentTime = Carbon::now();

            self::whereIn('inventaris_id', $inventarisIds)
                ->update(['status_inventaris' => $statusPemindahanInventaris, 'updated_at' => $currentTime]);
        }
    }

    static public function rejectPemindahanInventaris(PemindahanInventaris $pemindahanInventaris) {
        $inventarisIds = $pemindahanInventaris->inventaris->pluck('inventaris_id');
        $currentTime = Carbon::now();

        self::whereIn('inventaris_id', $inventarisIds)
            ->update(['status_inventaris' => 'Approval 2', 'updated_at' => $currentTime]); // Back to approval 2 because pemindahan rejected
    }

    static public function getInventarisKondisiCount() {
        return self::select(DB::raw('count(inventaris_id), kondisi_inventaris'))
            ->groupBy('kondisi_inventaris')
            ->pluck('count', 'kondisi_inventaris');
    }

    static public function getInventarisStatusCount() {
        return self::select(DB::raw('count(inventaris_id), status_inventaris'))
            ->groupBy('status_inventaris')
            ->pluck('count', 'status_inventaris');
    }

    // Changing number format
    protected function hargaInventaris(): Attribute {
        return Attribute::make(
            get: fn (string $value) => 'Rp. ' . number_format($value, 2, ',', '.'),
            set: fn ($value) => $value,
        );
    }

    public function kategori(): BelongsTo {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function kantor(): BelongsTo {
        return $this->belongsTo(Kantor::class, 'kantor_id');
    }

    public function lantai(): BelongsTo {
        return $this->belongsTo(Lantai::class, 'lantai_id');
    }

    public function ruangan(): BelongsTo {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function qrcode(): BelongsTo {
        return $this->belongsTo(QRCodeInventaris::class, 'qrcode_id');
    }

    public function inputInventaris(): BelongsTo {
        return $this->belongsTo(InputInventaris::class, 'input_inventaris_id');
    }

    public function pemindahanInventaris(): BelongsToMany {
        return $this->belongsToMany(Inventaris::class, 'pemindahan_inventaris_inventaris', 'inventaris_id', 'pemindahan_inventaris_id');
    }

    public function firstApprover(): BelongsTo {
        return $this->belongsTo(User::class, 'approver_1');
    }

    public function secondApprover(): BelongsTo {
        return $this->belongsTo(User::class, 'approver_2');
    }

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
