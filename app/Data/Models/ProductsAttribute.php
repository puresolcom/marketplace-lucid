<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;

class ProductsAttribute extends Model
{
    protected $guarded = [];

    protected $hidden = [];

    public $timestamps = false;

    public function translations()
    {
        return $this->hasMany(ProductsAttributesTranslation::class, 'translatable_id');
    }
}