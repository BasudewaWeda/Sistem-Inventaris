<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'status_pemindahan_inventaris',
        'alasan_rejection'
    ];

    public function pengisiData(): BelongsTo {
        return $this->belongsTo(User::class, 'pengisi_data');
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
        return $this->belongsTo(Kantor::class, 'kode_kantor_tujuan');
    }
}
