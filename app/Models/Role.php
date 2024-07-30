<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
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
        'role_name'
    ];

    static public function getRoles() {
        return self::get();
    }

    static public function getSingleRole($id) {
        return self::find($id);
    }

    static public function createRole(array $data) {
        $role = new self;
        $role->role_name = trim($data['role_name']);

        $role->save();

        $role->permissions()->attach($data['permission_ids']);
    }

    static public function updateRole($id, array $data) {
        $role = self::getSingleRole($id);
        
        if(!$role) throw new Exception('Role not found');

        $role->role_name = trim($data['role_name']);
        
        $role->save();

        $role->permissions()->sync($data['permission_ids']);
    }
    
    static public function checkPermission($permission_name): bool {
        $role = Auth::user()->currentRole;

        if ($role->permissions->contains('permission_name', $permission_name)) return true;

        return false;
    }

    static public function getRoleRecords() {
        return self::get();
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }

    public function permissions(): BelongsToMany {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }
}
