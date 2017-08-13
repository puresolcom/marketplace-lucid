<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;

class Taxonomy extends Model
{
    protected $guarded = [];

    protected $hidden = [];

    public $timestamps = true;

    public function translations()
    {
        return $this->hasMany(TaxonomyTranslation::class, 'translatable_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_taxonomies', 'taxonomy_id', 'product_id')->withTimestamps();
    }
}