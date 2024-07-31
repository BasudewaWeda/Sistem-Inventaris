<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'nomor_inventaris',
        'harga_inventaris',
        'status_inventaris',
        'tanggal_pembelian',
    ];

    public function kategori(): BelongsTo {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function kantor(): BelongsTo {
        return $this->belongsTo(Kantor::class, 'kode_kantor');
    }

    public function barcode(): BelongsTo {
        return $this->belongsTo(BarcodeInventaris::class, 'barcode_id');
    }

    public function inputInventaris(): BelongsTo {
        return $this->belongsTo(InputInventaris::class, 'input_inventaris_id');
    }

    public function pemindahanInventaris(): BelongsToMany {
        return $this->belongsToMany(Inventaris::class, 'pemindahan_inventaris_inventaris', 'inventaris_id', 'pemindahan_inventaris_id');
    }

    public function pengisiData(): BelongsTo {
        return $this->belongsTo(User::class, 'pengisi_data');
    }

    public function firstApprover(): BelongsTo {
        return $this->belongsTo(User::class, 'approver_1');
    }

    public function secondApprover(): BelongsTo {
        return $this->belongsTo(User::class, 'approver_2');
    }
}
