<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'permission_id';
    protected $table = 'permissions';

    protected $fillable = [
        'permission_name',
        'alias',
    ];

    static public function getPermissionRecords() {
        return self::get();
    }

    public function roles(): BelongsToMany {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id');
    }

    public function permissionGroup(): BelongsTo {
        return $this->belongsTo(PermissionGroup::class, 'permission_group_id');
    }
}
