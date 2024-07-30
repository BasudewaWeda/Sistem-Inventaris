<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'user_id';
    protected $table = 'users';
    
    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'user_phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    static public function getUsers() {
        return self::get();
    }

    static public function getSingleUser($id) {
        return self::find($id);
    }

    static public function createUser(array $data) {
        $user = new self;
        $user->user_name = trim($data['user_name']);
        $user->email = trim($data['user_email']);
        $user->user_phone_number = trim($data['user_phone_number']);
        $user->password = Hash::make($data['user_password']);
        $user->current_role_id = $data['role_ids']->first();

        $user->save();

        $user->roles()->attach($data['role_ids']);
    }

    static public function updateUser($id, array $data) {
        $user = self::getSingleUser($id);

        if(!$user) throw new Exception('User not found');

        $user->user_name = trim($data['user_name']);
        $user->user_email = trim($data['user_email']);
        $user->user_phone_number = trim($data['user_phone_number']);

        $user->save();

        $user->roles()->sync($data['role_ids']);
    }

    public function roles(): BelongsToMany {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function currentRole(): BelongsTo {
        return $this->belongsTo(Role::class, 'current_role_id');
    }
}
