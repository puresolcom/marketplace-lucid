<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 *
 * @package App\Data\Models
 */
class User extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $guarded = [];

    protected $hidden = ['password'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }
}