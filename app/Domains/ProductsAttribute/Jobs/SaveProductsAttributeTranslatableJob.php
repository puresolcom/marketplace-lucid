<?php

namespace App\Domains\ProductsAttribute\Jobs;

use App\Data\Models\ProductsAttribute;
use App\Data\Models\ProductsAttributesTranslation;
use Awok\Foundation\Job;

class SaveProductsAttributeTranslatableJob extends Job
{
    protected $data;

    protected $model;

    public function __construct(ProductsAttribute $model, array $input)
    {
        $this->model = $model;
        $this->data  = $input;
    }

    public function handle()
    {
        foreach ($this->data as $key => $translations) {
            foreach ($translations as $data) {
                if (empty($data->getValue())) {
                    $translationModel = ProductsAttributesTranslation::where('translatable_id', '=', $this->model->id)
                        ->where('locale', '=', $data->getLocale())->first();

                    if (empty($translationModel->name)) {
                        $translationModel->delete();
                    }
                } else {
                    $this->model->translations()->updateOrCreate(['locale' => $data->getLocale()], [$key => $data->getValue()]);
                }
            }
        }
    }
}