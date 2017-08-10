<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Location\Jobs\CreateLocationInputValidateJob;
use App\Domains\Location\Jobs\CreateLocationInputFilterJob;
use App\Domains\Location\Jobs\CreateLocationJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;

class CreateLocationFeature extends Feature
{
	

	public function __construct(  )
	{
		
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(CreateLocationInputValidateJob::class, ['input' => $request->all()]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(CreateLocationInputFilterJob::class);

		// Create model
		$created = $this->run(CreateLocationJob::class, ['input' => $filteredInputs]);

		// Response
		if (! $created) { return $this->run(new JsonErrorResponseJob('Unable to create Location')); }

		return $this->run(new JsonResponseJob($created));
    }
}