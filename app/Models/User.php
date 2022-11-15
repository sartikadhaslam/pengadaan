<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getMasterUser()
    {
        $getMasterUser = User::orderBy('name', 'asc')
        ->paginate(5);

        return $getMasterUser;
    }

    public static function getMasterUserbyId($id)
    {
        $getMasterUserbyId = User::findOrFail($id);

        return $getMasterUserbyId;
    }

    public static function storeMasterUser($name, $email, $password, $role)
    {        
        $storeMasterUser = new User();
        $storeMasterUser->name      = $name;
        $storeMasterUser->email     = $email;
        $storeMasterUser->password  = $password;
        $storeMasterUser->role      = $role;
        $storeMasterUser->save();

        return $storeMasterUser;
    }

    public static function updateMasterUser($id, $name, $email, $role)
    {
        $updateMasterUser = User::find($id);
        $updateMasterUser->name      = $name;
        $updateMasterUser->email     = $email;
        $updateMasterUser->role      = $role;
        $updateMasterUser->save();

        return $updateMasterUser;
    }

    public static function delMasterUserbyId($id)
    {
        $delMasterUserbyId = User::destroy($id);

        return $delMasterUserbyId;
    }
}
