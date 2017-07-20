<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    protected $hidden = ['pivot', 'user_id', 'role_id'];

    public $timestamps = false;
}