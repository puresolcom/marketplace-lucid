<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Country\Jobs\CreateCountryInputValidateJob;
use App\Domains\Country\Jobs\CreateCountryInputFilterJob;
use App\Domains\Country\Jobs\CreateCountryJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;

class CreateCountryFeature extends Feature
{
	

	public function __construct(  )
	{
		
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(CreateCountryInputValidateJob::class, ['input' => $request->all()]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(CreateCountryInputFilterJob::class);

		// Create model
		$created = $this->run(CreateCountryJob::class, ['input' => $filteredInputs]);

		// Response
		if (! $created) { return $this->run(new JsonErrorResponseJob('Unable to create Country')); }

		return $this->run(new JsonResponseJob($created));
    }
}