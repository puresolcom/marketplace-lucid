<?php

namespace App\Operations;

use App\Data\Models\Taxonomy;
use App\Domains\Taxonomy\Jobs\CreateTaxonomyTranslationJob;
use App\Domains\Taxonomy\Jobs\UpdateTaxonomyInputFilterJob;
use App\Domains\Taxonomy\Jobs\UpdateTaxonomyInputValidateJob;
use App\Domains\Taxonomy\Jobs\UpdateTaxonomyJob;
use Awok\Foundation\Operation;
use Laravel\Lumen\Application;

class UpdateTaxonomyOperation extends Operation
{
    protected $model;

    protected $app;

    public function __construct(Taxonomy $model)
    {
        $this->model = $model;
    }

    public function handle(Application $app)
    {
        $this->app = $app;

        // Validate Request Inputs
        $this->run(UpdateTaxonomyInputValidateJob::class, ['input' => $this->app->make('request')->all()]);

        // Exclude unwanted Inputs
        $filteredInputs = $this->run(UpdateTaxonomyInputFilterJob::class);

        // Update taxonomy model
        $taxonomyUpdated = $this->run(UpdateTaxonomyJob::class, [
            'model' => $this->model,
            'input' => array_except($filteredInputs, ['name']),
        ]);

        // Create translation
        $translations = $this->run(ExtractTranslatableFieldsOperation::class, [
            'input' => $filteredInputs,
            'keys'  => ['name'],
        ]);

        $translationCreated = $this->run(CreateTaxonomyTranslationJob::class, [
            'translations' => $translations,
            'model'        => $taxonomyUpdated,
        ]);
        if (! $translationCreated) {
            $this->app->make('db')->rollback();

            return false;
        }

        if (! $taxonomyUpdated) {
            $this->app->make('db')->rollback();

            return false;
        }

        $this->app->make('db')->commit();

        return $taxonomyUpdated->load(['nameTranslations']);
    }
}