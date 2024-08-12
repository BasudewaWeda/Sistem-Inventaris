<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lantai extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'lantai_id';
    protected $table = 'lantai';

    protected $fillables = [
        'nama_lantai'
    ];

    static public function getLantaiRecords() {
        return self::get();
    }

    public function kantor(): BelongsTo {
        return $this->belongsTo(Kantor::class, 'kantor_id');
    }

    public function ruangan(): HasMany {
        return $this->hasMany(Ruangan::class, 'lantai_id');
    }
}
