<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Currency\Jobs\CreateCurrencyInputValidateJob;
use App\Domains\Currency\Jobs\CreateCurrencyInputFilterJob;
use App\Domains\Currency\Jobs\CreateCurrencyJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;

class CreateCurrencyFeature extends Feature
{
	

	public function __construct(  )
	{
		
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(CreateCurrencyInputValidateJob::class, ['input' => $request->all()]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(CreateCurrencyInputFilterJob::class);

		// Create model
		$created = $this->run(CreateCurrencyJob::class, ['input' => $filteredInputs]);

		// Response
		if (! $created) { return $this->run(new JsonErrorResponseJob('Unable to create Currency')); }

		return $this->run(new JsonResponseJob($created));
    }
}