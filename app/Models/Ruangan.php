<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $fillable = [
        'nama_ruangan',
        'detail_ruangan',
        'lantai_id',
        'creator_id',
        'editor_id',
    ];

    protected $touches = [
        'lantai',
    ];

    public function getRuanganDetails() {
        $this->load(['inventaris', 'lantai.kantor']);
    }

    static public function createRuangan(array $data, $lantaiId) {
        $currentUserId = User::getCurrentUser()->user_id;

        return self::create([
            'nama_ruangan' => trim($data['nama_ruangan']),
            'detail_ruangan' => trim($data['detail_ruangan']),
            'lantai_id' => $lantaiId,
            'creator_id' => $currentUserId,
            'editor_id' => $currentUserId,
        ]);
    }

    static public function updateRuangan($id, array $data) {
        $ruangan = self::find($id);
        $currentUserId = User::getCurrentUser()->user_id;

        $ruangan->nama_ruangan = trim($data['nama_ruangan']);
        $ruangan->detail_ruangan = trim($data['detail_ruangan']);
        $ruangan->editor_id = $currentUserId;

        $ruangan->save();
    }

    static public function deleteRuangan(array $ruanganIds, $lantaiId) {
        self::where('lantai_id', $lantaiId)
            ->whereNotIn('ruangan_id', $ruanganIds)
            ->delete();
    }

    static public function getRuanganByLantai($lantaiId) {
        return self::where('lantai_id', $lantaiId)->get();
    }

    public function lantai(): BelongsTo {
        return $this->belongsTo(Lantai::class, 'lantai_id');
    }

    public function inventaris(): HasMany {
        return $this->hasMany(Inventaris::class, 'ruangan_id');
    }

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
