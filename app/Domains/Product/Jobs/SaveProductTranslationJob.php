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
                    if ($data->getValue() == $baseLocale) {
                        continue;
                    }
                    $translationModel = ProductsTranslation::where('translatable_id', '=', $this->model->id)
                        ->where('locale', '=', $data->getLocale())->first();

                    $translationModel->$key = $data->getValue();

                    if (empty($translationModel->description) && empty($translationModel->title)) {
                        $translationModel->delete();
                    }
                } else {
                    $this->model->translations()->updateOrCreate(['locale' => $data->getLocale()], [$key => $data->getValue()]);
                }
            }
        }
    }
}