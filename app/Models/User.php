<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\ForgotUserPassword;
use App\Mail\SendUserPassword;
use App\Mail\UserResetPassword;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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
        'slug',
        'email',
        'user_phone_number',
        'password',
        'status',
        'current_role_id',
        'creator_id',
        'editor_id',
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
        return self::with(['currentRole', 'creator', 'editor'])->filter(request(['search']))->orderByDesc('updated_at')->paginate(10)->withQueryString();
    }

    static public function getCurrentUser() {
        $currentUserId = Auth::user()->user_id;
        $currentUser = self::with(['roles', 'currentRole'])->find($currentUserId);
        return $currentUser;
    }

    // Getting users with permission 'approval-inventaris-1'
    static public function getFirstApprovers() {
        return self::whereHas('roles', function (Builder $query) {
            $query->whereHas('permissions', function (Builder $query2) {
                $query2->where('permission_name', '=', 'approval-inventaris-1');
            });
        })->get();
    }

    // Getting users with permission 'approval-inventaris-2'
    static public function getSecondApprovers() {
        return self::whereHas('roles', function (Builder $query) {
            $query->whereHas('permissions', function (Builder $query2) {
                $query2->where('permission_name', '=', 'approval-inventaris-2');
            });
        })->get();
    }

    // Getting users with permission 'approval-pemindahan-inventaris-1'
    static public function getPemindahanFirstApprovers() {
        return self::whereHas('roles', function (Builder $query) {
            $query->whereHas('permissions', function (Builder $query2) {
                $query2->where('permission_name', '=', 'approval-pemindahan-inventaris-1');
            });
        })->get();
    }

    // Getting users with permission 'approval-inventaris-pemindahan-2'
    static public function getPemindahanSecondApprovers() {
        return self::whereHas('roles', function (Builder $query) {
            $query->whereHas('permissions', function (Builder $query2) {
                $query2->where('permission_name', '=', 'approval-pemindahan-inventaris-2');
            });
        })->get();
    }

    // Checking if user is approver 1 or approver 2
    static public function approverCheck($id, $check) {
        $approver = self::with(['roles.permissions'])->find($id);

        if (!$approver) {
            return false;
        }
    
        if ($check === 1 && $approver->roles->contains(function ($role) {
            return $role->permissions->contains('permission_name', 'approval-inventaris-1');
        })) {
            return true;
        }
    
        if ($check === 2 && $approver->roles->contains(function ($role) {
            return $role->permissions->contains('permission_name', 'approval-inventaris-2');
        })) {
            return true;
        }
    
        if ($check === 3 && $approver->roles->contains(function ($role) {
            return $role->permissions->contains('permission_name', 'approval-pemindahan-inventaris-1');
        })) {
            return true;
        }
    
        if ($check === 4 && $approver->roles->contains(function ($role) {
            return $role->permissions->contains('permission_name', 'approval-pemindahan-inventaris-2');
        })) {
            return true;
        }

        return false;
    }

    static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    function scopeFilter(Builder $query, array $filters) : void {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $search = strtolower($search);
            $query->where(function ($q) use ($search) {
                $columns = ['user_name', 'email', 'user_phone_number'];

                foreach ($columns as $column) {
                    $q->orWhereRaw('LOWER(' . $column . ') LIKE ?', ["%{$search}%"])->distinct();
                }
            });
        });
    }

    static public function createUser(array $data) {
        $creator_id = self::getCurrentUser()->user_id;
        $generatedPassword = self::generateRandomString();

        $user = self::create([
            'user_name' => trim($data['user_name']),
            'slug' => Str::slug(trim($data['user_name'])),
            'email' => trim($data['email']),
            'user_phone_number' => trim($data['user_phone_number']),
            'password' => Hash::make($generatedPassword),
            'status' => 'active',
            'current_role_id' => $data['role_ids'][0],
            'creator_id' => $creator_id,
            'editor_id' => $creator_id,
        ]);

        $user->roles()->attach($data['role_ids']);

        Mail::to($data['email'])->send(new SendUserPassword(trim($data['user_name']), trim($data['email']), $generatedPassword));
    }

    static public function updateUser(self $user, array $data) {
        if(!$user) throw new Exception('User not found');

        $user->user_name = trim($data['user_name']);
        $user->slug = Str::slug(trim($data['user_name']));
        $user->email = trim($data['email']);
        $user->user_phone_number = trim($data['user_phone_number']);
        $user->status = trim($data['status']);

        $user->editor_id = self::getCurrentUser()->user_id;

        $user->save();

        $user->roles()->sync($data['role_ids']);
        $user->touch();
    }

    static public function updateCurrentRole(self $user, $data) {
        $user->current_role_id = $data['role'];

        $user->save();
    }

    static public function updatePassword(self $user, $data) {
        $user->password = Hash::make($data['new_password']);
        $user->has_changed_password = 1;

        $user->save();
    }

    static public function resetPassword(self $user) { // admin resets password
        $forgetCode = self::generateRandomString();

        $user->forget_code = Hash::make($forgetCode);
        $user->forget_expire = Carbon::now()->addDays(3);
        $user->password = Hash::make(self::generateRandomString());

        $user->save();

        Mail::to($user->email)->send(new UserResetPassword($user->user_name, $forgetCode));
    }

    static public function forgotPassword($email) {
        $user = self::where('email', $email)->first();

        $forgetCode = self::generateRandomString();

        $user->forget_code = Hash::make($forgetCode);
        $user->forget_expire = Carbon::now()->addDays(3);

        $user->save();

        Mail::to($email)->send(new ForgotUserPassword($user->user_name, $forgetCode));
    }

    static public function resetForgotPassword(array $data) {
        $user = User::where('email', $data['email'])->first();
        
        if (!Hash::check($data['forget_code'], $user->forget_code)) {
            return ['status' => 'fail', 'message' => 'Invalid reset code'];
        }

        if (Carbon::now()->greaterThan(($user->forget_expire))) {
            return ['status' => 'fail', 'message' => 'Forget code expired'];
        }

        $user->password = Hash::make($data['new_password']);
        $user->forget_code = null;
        $user->forget_expire = null;

        $user->save();
    }

    public function reassignCurrentRole()
    {
        $newRole = $this->roles()->first();
        if ($newRole) {
            $this->current_role_id = $newRole->role_id;
            $this->save();
        } else {
            $this->current_role_id = null;
            $this->save();
        }
    }

    public function roles(): BelongsToMany {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function currentRole(): BelongsTo {
        return $this->belongsTo(Role::class, 'current_role_id');
    }

    public function creator(): BelongsTo {
        return $this->belongsTo(self::class, 'creator_id');
    }

    public function editor(): BelongsTo {
        return $this->belongsTo(self::class, 'editor_id');
    }
}
