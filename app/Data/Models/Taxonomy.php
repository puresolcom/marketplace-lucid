<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;

class Taxonomy extends Model
{
    protected $guarded = [];

    protected $hidden = ['translations'];

    public $timestamps = true;

    public $appends = ['name'];

    public function translations()
    {
        return $this->hasMany(TaxonomyTranslation::class, 'translatable_id', 'id');
    }

    public function getNameAttribute()
    {
        $baseLocale = $this->nameTranslations()->where('locale', config('app.base_locale'))->where('key', 'name')->first();
        $userLocale = $this->nameTranslations()->where('locale', config('app.locale'))->where('key', 'name')->first();

        return ! empty($userLocale) ? $userLocale->value : ! empty($baseLocale) ? $baseLocale->value : '';
    }

    public function nameTranslations()
    {
        return $this->hasMany(TaxonomyTranslation::class, 'translatable_id', 'id')->where('key', 'name');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_taxonomies', 'taxonomy_id', 'product_id')->withTimestamps();
    }
}