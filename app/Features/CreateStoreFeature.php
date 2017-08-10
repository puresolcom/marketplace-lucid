<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Store\Jobs\CreateStoreInputValidateJob;
use App\Domains\Store\Jobs\CreateStoreInputFilterJob;
use App\Domains\Store\Jobs\CreateStoreJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;

class CreateStoreFeature extends Feature
{
	

	public function __construct(  )
	{
		
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(CreateStoreInputValidateJob::class, ['input' => $request->all()]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(CreateStoreInputFilterJob::class);

		// Create model
		$created = $this->run(CreateStoreJob::class, ['input' => $filteredInputs]);

		// Response
		if (! $created) { return $this->run(new JsonErrorResponseJob('Unable to create Store')); }

		return $this->run(new JsonResponseJob($created));
    }
}