<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InputInventaris extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'input_inventaris_id';
    protected $table = 'input_inventaris';

    protected $fillable = [
        'judul_input_inventaris',
        'nama_inventaris',
        'jumlah_inventaris',
        'harga_inventaris',
        'tahun_penyusutan',
        'tanggal_pembelian',
        'kategori_id',
        'kantor_id',
        'lantai_id',
        'ruangan_id',
        'approver_1',
        'approver_2',
        'status_input_inventaris',
        'approval_1_date',
        'approval_2_date',
        'rejection_date',
        'creator_id',
    ];

    static public function getInputInventarisByApprover() {
        $currentUser = User::getCurrentUser();
        
        $inputInventaris = self::with(['kategori', 'kantor'])
            ->where(function ($query) use ($currentUser) {
                $query->where('approver_1', $currentUser->user_id)
                      ->orWhere('approver_2', $currentUser->user_id);
            })
            ->orderByRaw("
                CASE
                    WHEN approver_1 = ? AND status_input_inventaris = 'Pending Approval' THEN 1
                    WHEN approver_1 = ? AND status_input_inventaris = 'Approval 1' THEN 3
                    WHEN approver_1 = ? AND status_input_inventaris = 'Approval 2' THEN 4
                    WHEN approver_2 = ? AND status_input_inventaris = 'Approval 1' THEN 2
                    WHEN approver_2 = ? AND status_input_inventaris = 'Pending Approval' THEN 5
                    WHEN approver_2 = ? AND status_input_inventaris = 'Approval 2' THEN 6
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
        
        return $inputInventaris;
    }

    public function getInputInventarisDetails() {
        $this->load(['creator', 'firstApprover', 'secondApprover', 'kategori', 'kantor', 'lantai', 'ruangan', 'inventaris']);
    }

    static public function createInputInventaris(array $data) {
        return self::create([
            'judul_input_inventaris' => trim($data['judul_input_inventaris']),
            'nama_inventaris' => trim($data['nama_inventaris']),
            'jumlah_inventaris' => trim($data['jumlah_inventaris']),
            'harga_inventaris' => trim($data['harga_inventaris']),
            'tahun_penyusutan' => trim($data['tahun_penyusutan']),
            'tanggal_pembelian' => trim($data['tanggal_pembelian']),
            'kategori_id' => trim($data['kategori_id']),
            'kantor_id' => trim($data['kantor_id']),
            'lantai_id' => trim($data['lantai_id']),
            'ruangan_id' => trim($data['ruangan_id']),
            'approver_1' => trim($data['approver_1']),
            'approver_2' => trim($data['approver_2']),
            'status_input_inventaris' => 'Pending Approval',
            'creator_id' => User::getCurrentUser()->user_id,
        ]);
    }

    public function approveInputInventaris() {
        $currentUser = User::getCurrentUser();
        $currentStatus = $this->status_input_inventaris;
        
        if ($currentStatus == 'Pending Approval' && $this->approver_1 == $currentUser->user_id) {
            $this->status_input_inventaris = 'Approval 1';
            $this->approval_1_date = Carbon::now();
        }
        elseif ($currentStatus == 'Approval 1' && $this->approver_2 == $currentUser->user_id) {
            $this->status_input_inventaris = 'Approval 2';
            $this->approval_2_date = Carbon::now();
        }

        $this->save();
    }

    public function rejectInputInventaris(string $alasanRejection) {
        $this->status_input_inventaris = 'Rejected';
        $this->alasan_rejection = $alasanRejection;
        $this->rejection_date = Carbon::now();

        $this->save();
    }
    
    public function creator(): BelongsTo {
        return $this->belongsTo(USer::class, 'creator_id');
    }

    public function firstApprover(): BelongsTo {
        return $this->belongsTo(User::class, 'approver_1');
    }

    public function secondApprover(): BelongsTo {
        return $this->belongsTo(User::class, 'approver_2');
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

    public function inventaris(): HasMany {
        return $this->hasMany(Inventaris::class, 'input_inventaris_id');
    }
}
