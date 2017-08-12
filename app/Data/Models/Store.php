<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [];

    public $timestamps = true;
}