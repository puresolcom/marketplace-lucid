<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Option\Jobs\CreateOptionInputValidateJob;
use App\Domains\Option\Jobs\CreateOptionInputFilterJob;
use App\Domains\Option\Jobs\CreateOptionJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;

class CreateOptionFeature extends Feature
{
	

	public function __construct(  )
	{
		
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(CreateOptionInputValidateJob::class, ['input' => $request->all()]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(CreateOptionInputFilterJob::class);

		// Create model
		$created = $this->run(CreateOptionJob::class, ['input' => $filteredInputs]);

		// Response
		if (! $created) { return $this->run(new JsonErrorResponseJob('Unable to create Option')); }

		return $this->run(new JsonResponseJob($created));
    }
}