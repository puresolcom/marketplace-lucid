<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Taxonomy\Jobs\CreateTaxonomyInputValidateJob;
use App\Domains\Taxonomy\Jobs\CreateTaxonomyInputFilterJob;
use App\Domains\Taxonomy\Jobs\CreateTaxonomyJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;

class CreateTaxonomyFeature extends Feature
{
	

	public function __construct(  )
	{
		
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(CreateTaxonomyInputValidateJob::class, ['input' => $request->all()]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(CreateTaxonomyInputFilterJob::class);

		// Create model
		$created = $this->run(CreateTaxonomyJob::class, ['input' => $filteredInputs]);

		// Response
		if (! $created) { return $this->run(new JsonErrorResponseJob('Unable to create Taxonomy')); }

		return $this->run(new JsonResponseJob($created));
    }
}