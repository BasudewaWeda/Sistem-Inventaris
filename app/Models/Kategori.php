<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */

    protected $primaryKey = 'kategori_id';
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
    ];

    public function inventaris(): HasMany {
        return $this->hasMany(Inventaris::class, 'inventaris_id');
    }
}
