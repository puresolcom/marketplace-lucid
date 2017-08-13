<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;

class TaxonomyTranslation extends Model
{
    protected $table = 'taxonomies_translations';

    protected $guarded = [];

    protected $hidden = [];

    public $timestamps = false;
}