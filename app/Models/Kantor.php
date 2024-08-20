<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kantor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'kantor_id';

    protected $table = 'kantor';

    protected $fillable = [
        'nama_kantor',
        'kode_kantor',
        'slug',
        'sequence_kantor',
        'nomor_telepon_kantor',
        'alamat_kantor',
        'provinsi_id',
        'kabupaten_id',
        'creator_id',
        'editor_id',
    ];

    static public function getKantorRecords() {
        return self::get();
    }

    static public function getDetailedKantorRecords() {
        return self::with(['kabupaten', 'provinsi'])->filter(request(['search']))->orderByDesc('updated_at')->paginate(8)->withQueryString();
    }

    static public function getKantorDetails(self $kantor) {
        $kantor->load(['lantai.ruangan', 'kabupaten', 'provinsi']);
        return $kantor;
    }

    function scopeFilter(Builder $query, array $filters) : void {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $search = strtolower($search);
            $query->where(function ($q) use ($search) {
                $columns = ['nama_kantor', 'alamat_kantor', 'nomor_telepon_kantor'];
    
                foreach ($columns as $column) {
                    $q->orWhereRaw('LOWER(' . $column . ') LIKE ?', ["%{$search}%"])->distinct();
                }
    
                $q->orWhereHas('kabupaten', function ($q) use ($search) {
                    $q->whereRaw('LOWER(nama_kabupaten) LIKE ?', ["%{$search}%"])
                      ->orWhereHas('provinsi', function ($q2) use ($search) {
                          $q2->whereRaw('LOWER(nama_provinsi) LIKE ?', ["%{$search}%"]);
                      });
                });
            })->distinct();
        });
    }

    static public function createKantor(array $data) {
        $currentUserId = User::getCurrentUser()->user_id;

        return self::create([
            'nama_kantor' => trim($data['nama_kantor']),
            'slug' => Str::slug($data['nama_kantor']),
            'kode_kantor' => trim($data['kode_kantor']),
            'nomor_telepon_kantor' => trim($data['nomor_telepon_kantor']),
            'alamat_kantor' => trim($data['alamat_kantor']),
            'provinsi_id' => trim($data['provinsi_id']),
            'kabupaten_id' => trim($data['kabupaten_id']),
            'creator_id' => $currentUserId,
            'editor_id' => $currentUserId,
        ]);
    }

    static public function updateKantor(self $kantor, array $data) {
        if(!$kantor) throw new Exception('Kantor not found');

        $currentUserId = User::getCurrentUser()->user_id;

        $kantor->nama_kantor = trim($data['nama_kantor']);
        $kantor->slug = Str::slug($data['nama_kantor']);
        $kantor->kode_kantor = trim($data['kode_kantor']);
        $kantor->nomor_telepon_kantor = trim($data['nomor_telepon_kantor']);
        $kantor->alamat_kantor = trim($data['alamat_kantor']);
        $kantor->provinsi_id = trim($data['provinsi_id']);
        $kantor->kabupaten_id = trim($data['kabupaten_id']);
        $kantor->editor_id = $currentUserId;

        $kantor->save();
    }

    public function inventaris(): HasMany {
        return $this->hasMany(Inventaris::class, 'kantor_id');
    }

    public function provinsi(): BelongsTo {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kabupaten(): BelongsTo {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function lantai(): HasMany {
        return $this->hasMany(Lantai::class, 'kantor_id');
    }

    // protected static function booted(): void {
    //     static::creating(function(Kantor $kantor) {
    //         $lastKantor = static::orderBy('kode_kantor', 'desc')->first();
    //         $kantor->kode_kantor = $lastKantor ? $lastKantor->kode_kantor + 1 : 1;
    //         $kantor->kode_kantor = str_pad($kantor->kode_kantor, 3, '0', STR_PAD_LEFT);
    //     });
    // }

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function editor(): BelongsTo {
        return $this->belongsTo(User::class, 'editor_id');
    }
}
