<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'ruangan_id';
    protected $table = 'ruangan';

    protected $fillables = [
        'nama_ruangan'
    ];

    static public function getRuanganRecords() {
        return self::get();
    }

    public function lantai(): BelongsTo {
        return $this->belongsTo(Lantai::class, 'lantai_id');
    }
}
