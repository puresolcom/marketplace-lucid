<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Role\Jobs\CreateRoleInputValidateJob;
use App\Domains\Role\Jobs\CreateRoleInputFilterJob;
use App\Domains\Role\Jobs\CreateRoleJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;

class CreateRoleFeature extends Feature
{
	

	public function __construct(  )
	{
		
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(CreateRoleInputValidateJob::class, ['input' => $request->all()]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(CreateRoleInputFilterJob::class);

		// Create model
		$created = $this->run(CreateRoleJob::class, ['input' => $filteredInputs]);

		// Response
		if (! $created) { return $this->run(new JsonErrorResponseJob('Unable to create Role')); }

		return $this->run(new JsonResponseJob($created));
    }
}