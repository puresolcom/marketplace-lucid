<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    protected $hidden = ['pivot'];

    public $timestamps = false;
}