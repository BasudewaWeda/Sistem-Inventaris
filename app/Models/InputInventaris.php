<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'tanggal_pembelian',
        'jumlah_inventaris',
        'harga_inventaris',
        'status_input_inventaris',
        'alasan_rejection',
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

    public function kategori(): BelongsTo {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function kantor(): BelongsTo {
        return $this->belongsTo(Kantor::class, 'kode_kantor');
    }

    public function inventaris(): HasMany {
        return $this->hasMany(Inventaris::class, 'input_inventaris_id');
    }
}
