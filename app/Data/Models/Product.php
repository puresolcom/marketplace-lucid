<?php

namespace App\Data\Models;

use Awok\Foundation\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [];

    public $timestamps = true;

    public $appends = ['title', 'description'];

    public function getTitleAttribute()
    {
        return $this->translations()->where('locale', config('app.base_locale'))->first()->title;
    }

    public function getDescriptionAttribute()
    {
        return $this->translations()->where('locale', config('app.base_locale'))->first()->description;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function translations()
    {
        return $this->hasMany(ProductsTranslation::class, 'translatable_id');
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