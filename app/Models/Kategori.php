<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'slug',
        'creator_id',
        'editor_id',
    ];

    static public function getKategoriRecords() {
        return self::get();
    }

    static public function getKategori() {
        return self::with(['creator', 'editor'])->orderByDesc('updated_at')->paginate(10);
    }

    static public function createKategori(array $data) {
        $currentUserId = User::getCurrentUser()->user_id;

        self::create([
            'nama_kategori' => trim($data['nama_kategori']),
            'slug' => Str::slug(trim($data['nama_kategori'])),
            'creator_id' => $currentUserId,
            'editor_id' => $currentUserId,
        ]);
    }

    static public function updateKategori(self $kategori, array $data) {
        if(!$kategori) throw new Exception('Kantor not found');

        $currentUserId = User::getCurrentUser()->user_id;

        $kategori->nama_kategori = trim($data['nama_kategori']);
        $kategori->editor_id = $currentUserId;

        $kategori->save();
    }

    public function inventaris(): HasMany {
        return $this->hasMany(Inventaris::class, 'inventaris_id');
    }

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function editor(): BelongsTo {
        return $this->belongsTo(User::class, 'editor_id');
    }
}
