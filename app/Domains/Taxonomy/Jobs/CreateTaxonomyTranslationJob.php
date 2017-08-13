<?php

namespace App\Domains\Taxonomy\Jobs;

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
                $this->model->translations()->updateOrCreate(['locale' => $translation->getLocale()], [$key => $translation->getValue()]);
            }
        }

        return true;
    }
}