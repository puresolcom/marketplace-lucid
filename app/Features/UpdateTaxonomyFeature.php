<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Taxonomy\Jobs\UpdateTaxonomyInputValidateJob;
use App\Domains\Taxonomy\Jobs\UpdateTaxonomyInputFilterJob;
use App\Domains\Taxonomy\Jobs\UpdateTaxonomyJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use App\Data\Models\Taxonomy;

class UpdateTaxonomyFeature extends Feature
{
	protected $objectID;

	public function __construct( int $objectID )
	{
		$this->objectID = $objectID;
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(UpdateTaxonomyInputValidateJob::class, ['input' => $request->all()]);
		// Finding model
		$model = $this->run(FindObjectByIDJob::class,  ['model' => Taxonomy::class, 'objectID' => $this->objectID]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(UpdateTaxonomyInputFilterJob::class);

		// Update model
		$updated = $this->run(UpdateTaxonomyJob::class, ['model' => $model, 'input' => $filteredInputs]);

		// Response
		if (! $updated) { return $this->run(new JsonErrorResponseJob('Unable to update Taxonomy')); }

		return $this->run(new JsonResponseJob($updated));
    }
}