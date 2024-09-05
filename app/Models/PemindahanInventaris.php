<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PemindahanInventaris extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'pemindahan_inventaris_id';
    protected $table = 'pemindahan_inventaris';

    protected $fillable = [
        'judul_pemindahan_inventaris',
        'kantor_id_tujuan',
        'lantai_id_tujuan',
        'ruangan_id_tujuan',
        'approver_1',
        'approver_2',
        'status_pemindahan_inventaris',
        'creator_id',
    ];

    static public function createPemindahanInventaris(array $data) {
        $pemindahanInventaris = self::create([
            'judul_pemindahan_inventaris' => trim($data['judul_pemindahan_inventaris']),
            'kantor_id_tujuan' => trim($data['kantor_id_tujuan']),
            'lantai_id_tujuan' => trim($data['lantai_id_tujuan']),
            'ruangan_id_tujuan' => trim($data['ruangan_id_tujuan']),
            'approver_1' => trim($data['approver_1']),
            'approver_2' => trim($data['approver_2']),
            'status_pemindahan_inventaris' => 'Pending Approval',
            'creator_id' => User::getCurrentUser()->user_id,
        ]);

        $inventarisIdArray = Str::of($data['inventaris_ids'])->explode(',');

        $currentTimeStamp = Carbon::now();

        $pemindahanInventaris->inventaris()->attach($inventarisIdArray, [
            'created_at' => $currentTimeStamp,
            'updated_at' => $currentTimeStamp,
        ]);

        Inventaris::whereIn('inventaris_id', $inventarisIdArray)
            ->update(['status_inventaris' => 'Pending Approval Pemindahan', 'updated_at' => $currentTimeStamp]);
    }

    static public function getPemindahanInventarisByApprover() {
        $currentUser = User::getCurrentUser();
        
        $pemindahanInventaris = self::with(['kantorTujuan', 'lantaiTujuan', 'ruanganTujuan', 'creator'])->filter(request(['search']))
            ->where(function ($query) use ($currentUser) {
                $query->where('approver_1', $currentUser->user_id)
                      ->orWhere('approver_2', $currentUser->user_id);
            })
            ->orderByRaw("
                CASE
                    WHEN approver_1 = ? AND status_pemindahan_inventaris = 'Pending Approval' THEN 1
                    WHEN approver_1 = ? AND status_pemindahan_inventaris = 'Approval 1' THEN 3
                    WHEN approver_1 = ? AND status_pemindahan_inventaris = 'Approval 2' THEN 4
                    WHEN approver_2 = ? AND status_pemindahan_inventaris = 'Approval 1' THEN 2
                    WHEN approver_2 = ? AND status_pemindahan_inventaris = 'Pending Approval' THEN 5
                    WHEN approver_2 = ? AND status_pemindahan_inventaris = 'Approval 2' THEN 6
                    ELSE 7
                END
            ", [
                $currentUser->user_id,
                $currentUser->user_id,
                $currentUser->user_id,
                $currentUser->user_id,
                $currentUser->user_id,
                $currentUser->user_id,
            ])
            ->paginate(8)->withQueryString();
        
        return $pemindahanInventaris;
    }

    public function getPemindahanInventarisDetails() {
        $this->load(['kantorTujuan', 'lantaiTujuan', 'ruanganTujuan', 'creator', 'firstApprover', 'secondApprover', 'inventaris']);
    }

    public function approvePemindahanInventaris() {
        $currentUser = User::getCurrentUser();
        $currentStatus = $this->status_pemindahan_inventaris;
        
        if ($currentStatus == 'Pending Approval' && $this->approver_1 == $currentUser->user_id) {
            $this->status_pemindahan_inventaris = 'Approval 1';
            $this->approval_1_date = Carbon::now();
        }
        elseif ($currentStatus == 'Approval 1' && $this->approver_2 == $currentUser->user_id) {
            $this->status_pemindahan_inventaris = 'Approval 2';
            $this->approval_2_date = Carbon::now();
        }

        $this->save();
    }

    public function rejectPemindahanInventaris(string $alasanRejection) {
        $this->status_pemindahan_inventaris = 'Rejected';
        $this->alasan_rejection = $alasanRejection;
        $this->rejection_date = Carbon::now();

        $this->save();
    }

    static public function getLaporanPemindahanInventaris(array $request) {
        $query = self::with(['kantorTujuan', 'lantaiTujuan', 'ruanganTujuan', 'creator', 'firstApprover', 'secondApprover', 'inventaris'])
            ->whereDate('created_at', '>=', $request['start_date'])
            ->whereDate('created_at', '<=', $request['end_date']);

        if (!empty($request['kantor_id'])) {
            $query->where('kantor_id', $request['kantor_id']);
        }

        if (!empty($request['status'])) {
            $query->where('status_inventaris', $request['status']);
        }

        return $query->orderByDesc('created_at')->paginate(10)->withQueryString();
    }

    function scopeFilter(Builder $query, array $filters) : void {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $search = strtolower($search); // Convert search term to lowercase
    
            $query->where(function ($q) use ($search) {
                $columns = ['judul_pemindahan_inventaris', 'status_pemindahan_inventaris'];
    
                foreach ($columns as $column) {
                    $q->orWhereRaw('LOWER(' . $column . ') LIKE ?', ["%{$search}%"])->distinct();
                }
    
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

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function firstApprover(): BelongsTo {
        return $this->belongsTo(User::class, 'approver_1');
    }

    public function secondApprover(): BelongsTo {
        return $this->belongsTo(User::class, 'approver_2');
    }

    public function inventaris(): BelongsToMany {
        return $this->belongsToMany(Inventaris::class, 'pemindahan_inventaris_inventaris', 'pemindahan_inventaris_id', 'inventaris_id');
    }

    public function kantorTujuan(): BelongsTo {
        return $this->belongsTo(Kantor::class, 'kantor_id_tujuan');
    }

    public function lantaiTujuan(): BelongsTo {
        return $this->belongsTo(Lantai::class, 'lantai_id_tujuan');
    }

    public function ruanganTujuan(): BelongsTo {
        return $this->belongsTo(Ruangan::class, 'ruangan_id_tujuan');
    }
}
