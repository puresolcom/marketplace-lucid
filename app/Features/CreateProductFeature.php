<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Product\Jobs\CreateProductInputValidateJob;
use App\Domains\Product\Jobs\CreateProductInputFilterJob;
use App\Domains\Product\Jobs\CreateProductJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;

class CreateProductFeature extends Feature
{
	

	public function __construct(  )
	{
		
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(CreateProductInputValidateJob::class, ['input' => $request->all()]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(CreateProductInputFilterJob::class);

		// Create model
		$created = $this->run(CreateProductJob::class, ['input' => $filteredInputs]);

		// Response
		if (! $created) { return $this->run(new JsonErrorResponseJob('Unable to create Product')); }

		return $this->run(new JsonResponseJob($created));
    }
}