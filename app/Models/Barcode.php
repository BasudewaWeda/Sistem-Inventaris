<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BarcodeInventaris extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'barcode_id';
    protected $table = 'barcode_inventaris';

    protected $fillable = [
        'file_path'
    ];

    public function Inventaris(): HasOne {
        return $this->hasOne(Inventaris::class, 'inventaris_id');
    }
}
