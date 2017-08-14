<?php

namespace App\Operations;

use App\Domains\Taxonomy\Jobs\CreateTaxonomyInputFilterJob;
use App\Domains\Taxonomy\Jobs\CreateTaxonomyInputValidateJob;
use App\Domains\Taxonomy\Jobs\CreateTaxonomyJob;
use App\Domains\Taxonomy\Jobs\CreateTaxonomyTranslationJob;
use App\Domains\Taxonomy\Jobs\SlugifyTaxonomyNameJob;
use Awok\Foundation\Operation;
use Laravel\Lumen\Application;

class CreateTaxonomyOperation extends Operation
{
    protected $app;

    public function handle(Application $app)
    {
        $this->app = $app;

        // Validate Request Inputs
        $this->run(CreateTaxonomyInputValidateJob::class, ['input' => $this->app->make('request')->all()]);

        // Exclude unwanted Inputs
        $filteredInputs = $this->run(CreateTaxonomyInputFilterJob::class);

        if (! isset($filteredInputs['slug'])) {
            $filteredInputs['slug'] = $this->run(SlugifyTaxonomyNameJob::class, ['rawSlug' => $filteredInputs['name']]);
        }

        $this->app->make('db')->beginTransaction();

        // Create taxonomy
        $taxonomyCreated = $this->run(CreateTaxonomyJob::class, ['input' => array_except($filteredInputs, ['name'])]);

        // Create translation
        $translations = $this->run(ExtractTranslatableFieldsOperation::class, [
            'input' => $filteredInputs,
            'keys'  => ['name'],
        ]);

        $translationCreated = $this->run(CreateTaxonomyTranslationJob::class, [
            'translations' => $translations,
            'model'        => $taxonomyCreated,
        ]);
        if (! $translationCreated) {
            $this->app->make('db')->rollback();

            return false;
        }

        if (! $taxonomyCreated) {
            $this->app->make('db')->rollback();
        }

        $this->app->make('db')->commit();

        return $taxonomyCreated->load(['nameTranslations']);
    }
}