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

    protected $fillable = [
        'nama_lantai',
        'kantor_id',
        'creator_id',
        'editor_id',
    ];

    protected $touches = [
        'kantor',
    ];

    static public function createLantai($namaLantai, $kantorId) {
        $currentUserId = User::getCurrentUser()->user_id;

        return self::create([
            'nama_lantai' => trim($namaLantai),
            'kantor_id' => $kantorId,
            'creator_id' => $currentUserId,
            'editor_id' => $currentUserId,
        ]);
    }

    static public function updateLantai($id, array $data) {
        $lantai = self::find($id);
        $currentUserId = User::getCurrentUser()->user_id;

        $lantai->nama_lantai = trim($data['nama_lantai']);
        $lantai->editor_id = $currentUserId;

        $lantai->save();
    }

    static public function deleteLantai(array $lantaiIds, $kantorId) {
        self::where('kantor_id', $kantorId)
            ->whereNotIn('lantai_id', $lantaiIds)
            ->delete();
    }

    static public function getLantaiByKantor($kantorId) {
        return self::where('kantor_id', $kantorId)->get();
    }

    public function kantor(): BelongsTo {
        return $this->belongsTo(Kantor::class, 'kantor_id');
    }

    public function ruangan(): HasMany {
        return $this->hasMany(Ruangan::class, 'lantai_id');
    }
}
