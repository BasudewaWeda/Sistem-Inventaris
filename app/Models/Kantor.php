<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kantor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'kode_kantor';
    public $incrementing = false;

    protected $table = 'kantor';

    protected $fillables = [
        'nama_kantor',
        'sequence_kantor',
        'email_kantor',
        'nomor_telepon_kantor',
        'alamat_kantor',
    ];

    public function inventaris(): HasMany {
        return $this->hasMany(Inventaris::class, 'kode_kantor');
    }

    public function provinsi(): BelongsTo {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kabupaten(): BelongsTo {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function lantai(): HasMany {
        return $this->hasMany(Lantai::class, 'kode_kantor');
    }

    protected static function booted(): void {
        static::creating(function(Kantor $kantor) {
            $lastKantor = static::orderBy('kode_kantor', 'desc')->first();
            $kantor->kode_kantor = $lastKantor ? $lastKantor->kode_kantor + 1 : 1;
            $kantor->kode_kantor = str_pad($kantor->kode_kantor, 3, '0', STR_PAD_LEFT);
        });
    }
}
