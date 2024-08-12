<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PermissionGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'permission_group_id';
    protected $table = 'permission_groups';

    protected $fillable = [
        'permission_group_name',
        'alias',
    ];

    static public function getPermissionGroups() {
        return self::with('permissions')->get();
    }

    public function permissions(): HasMany {
        return $this->hasMany(Permission::class, 'permission_group_id');
    }
}
