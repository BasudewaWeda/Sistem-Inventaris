<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provinsi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'provinsi_id';
    protected $table = 'provinsi';

    protected $fillable = [
        'nama_provinsi'
    ];
    
    public function kabupaten(): HasMany {
        return $this->hasMany(Kabupaten::class, 'provinsi_id');
    }

    public function kantor(): HasMany {
        return $this->hasMany(Kantor::class, 'kode_kantor');
    }
}
