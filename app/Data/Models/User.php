<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }
}
