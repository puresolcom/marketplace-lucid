<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = ['translations'];

    public $timestamps = true;

    public $appends = ['title', 'description'];

    public function getTitleAttribute()
    {
        $baseLocale = $this->titleTranslations()->where('locale', config('app.base_locale'))->where('key', 'title')->first();
        $userLocale = $this->titleTranslations()->where('locale', config('app.locale'))->where('key', 'title')->first();

        return ! empty($userLocale) ? $userLocale->value : ! empty($baseLocale) ? $baseLocale->value : '';
    }

    public function getDescriptionAttribute()
    {
        $baseLocale = $this->descriptionTranslations()->where('locale', config('app.base_locale'))->first();
        $userLocale = $this->descriptionTranslations()->where('locale', config('app.locale'))->first();

        return ! empty($userLocale) ? $userLocale->value : ! empty($baseLocale) ? $baseLocale->value : '';
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function translations()
    {
        return $this->hasMany(ProductsTranslation::class, 'translatable_id');
    }

    public function titleTranslations()
    {
        return $this->hasMany(ProductsTranslation::class, 'translatable_id')->where('key', 'title');
    }

    public function descriptionTranslations()
    {
        return $this->hasMany(ProductsTranslation::class, 'translatable_id')->where('key', 'description');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}