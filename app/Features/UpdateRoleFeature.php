<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Role\Jobs\UpdateRoleInputValidateJob;
use App\Domains\Role\Jobs\UpdateRoleInputFilterJob;
use App\Domains\Role\Jobs\UpdateRoleJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use App\Data\Models\Role;

class UpdateRoleFeature extends Feature
{
	protected $objectID;

	public function __construct( int $objectID )
	{
		$this->objectID = $objectID;
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(UpdateRoleInputValidateJob::class, ['input' => $request->all()]);
		// Finding model
		$model = $this->run(FindObjectByIDJob::class,  ['model' => Role::class, 'objectID' => $this->objectID]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(UpdateRoleInputFilterJob::class);

		// Update model
		$updated = $this->run(UpdateRoleJob::class, ['model' => $model, 'input' => $filteredInputs]);

		// Response
		if (! $updated) { return $this->run(new JsonErrorResponseJob('Unable to update Role')); }

		return $this->run(new JsonResponseJob($updated));
    }
}