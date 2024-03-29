<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post(){
        return $this->hasMany(Post::class); 
    }

    public function roles()
    {
        return User::select("users.*", "users_roles.*")->join("users_roles", "users_roles.id", "=", "users.role_id");
    }

    public function hasRole($role_name)
    {
        return $this->roles()->where('users.id', '=', auth()->user()->id)->where('users_roles.name', '=', $role_name)->count() == 1;
    }
}
