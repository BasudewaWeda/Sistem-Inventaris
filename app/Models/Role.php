<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'role_id';
    protected $table = 'roles';

    protected $fillable = [
        'role_name',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($role) {
            // Get all users with this role as their current role
            $usersWithCurrentRole = User::where('current_role_id', $role->role_id)->get();

            foreach ($usersWithCurrentRole as $user) {
                $user->reassignCurrentRole();
            }
        });
    }

    static public function getRoles() {
        return self::with(['creator', 'editor'])->orderByDesc('updated_at')->paginate(10);
    }

    static public function getSingleRole($id) {
        return self::find($id);
    }

    static public function createRole(array $data) {
        $currentUser = User::getCurrentUser()->user_id;

        $role = self::create([
            'role_name' => trim($data['role_name']),
            'slug' => Str::slug(trim($data['role_name'])),
            'creator_id' => $currentUser,
            'editor_id' => $currentUser,
        ]);

        $role->permissions()->attach($data['permission_ids']);
    }

    static public function updateRole(self $role, array $data) {
        if(!$role) throw new Exception('Role not found');

        $role->role_name = trim($data['role_name']);
        $role->slug = Str::slug(trim($data['role_name']));
        $role->editor_id = User::getCurrentUser()->user_id;
        
        $role->save();

        $role->permissions()->sync($data['permission_ids']);
        $role->touch();
    }
    
    static public function checkPermission($permission_name): bool {
        $role = Auth::user()->currentRole;

        if ($role == null) return false;

        if ($role->permissions->contains('permission_name', $permission_name)) return true;

        return false;
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }

    public function permissions(): BelongsToMany {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function editor(): BelongsTo {
        return $this->belongsTo(User::class, 'editor_id');
    }
}
