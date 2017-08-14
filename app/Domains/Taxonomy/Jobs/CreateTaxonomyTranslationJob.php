<?php

namespace App\Domains\Taxonomy\Jobs;

use App\Data\Models\TaxonomyTranslation;
use Awok\Foundation\Job;

class CreateTaxonomyTranslationJob extends Job
{
    protected $translations;

    protected $model;

    public function __construct($translations, $model)
    {
        $this->translations = $translations;
        $this->model        = $model;
    }

    public function handle()
    {
        foreach ($this->translations as $key => $translations) {

            foreach ($translations as $translation) {
                if (empty($translation->getValue())) {
                    if ($translation->getLocale() == config('app.base_locale')) {
                        continue;
                    }
                    TaxonomyTranslation::where('translatable_id', '=', $this->model->id)
                        ->where('locale', '=', $translation->getLocale())->where('key', $key)->delete();
                } else {
                    $this->model->translations()->updateOrCreate([
                        'locale' => $translation->getLocale(),
                        'key'    => $key,
                    ], ['value' => $translation->getValue()]);
                }
            }
        }

        return true;
    }
}