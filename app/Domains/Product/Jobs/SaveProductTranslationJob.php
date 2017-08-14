<?php

namespace App\Domains\Product\Jobs;

use App\Data\Models\Product;
use App\Data\Models\ProductsTranslation;
use Awok\Foundation\Job;

class SaveProductTranslationJob extends Job
{
    protected $data;

    protected $model;

    public function __construct(array $input, Product $model)
    {
        $this->data  = $input;
        $this->model = $model;
    }

    public function handle()
    {
        $baseLocale = config('app.base_locale');
        foreach ($this->data as $key => $translations) {
            foreach ($translations as $data) {
                if (empty($data->getValue())) {
                    if ($data->getLocale() == $baseLocale) {
                        continue;
                    }
                    ProductsTranslation::where('translatable_id', '=', $this->model->id)
                        ->where('locale', '=', $data->getLocale())->where('key', $key)->delete();
                } else {
                    $this->model->translations()->updateOrCreate([
                        'locale' => $data->getLocale(),
                        'key'    => $key,
                    ], ['value' => $data->getValue()]);
                }
            }
        }
    }
}