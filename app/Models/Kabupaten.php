<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kabupaten extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'kabupaten_id';
    protected $table = 'kabupaten';

    protected $fillable = [
        'nama_kabupaten'
    ];

    static public function getKabupatenByProvinsi($provinsiId) {
        return self::where('provinsi_id', $provinsiId)->get();
    }
     
    public function provinsi(): BelongsTo {
       return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kantor(): HasMany {
        return $this->hasMany(Kantor::class, 'kode_kantor');
    }
}
