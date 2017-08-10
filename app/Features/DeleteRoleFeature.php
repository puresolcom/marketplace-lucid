<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Role\Jobs\DeleteRoleJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use App\Data\Models\Role;

class DeleteRoleFeature extends Feature
{
	protected $objectID;

	public function __construct( int $objectID )
	{
		$this->objectID = $objectID;
	}

    public function handle(Request $request)
    {
        // Finding model
		$model = $this->run(FindObjectByIDJob::class, ['model' => Role::class, 'objectID' => $this->objectID]);

		// Deleting model
		$deleted = $this->run(DeleteRoleJob::class, ['model' => $model]);

		// Response
		if (! $deleted) {return $this->run(new JsonErrorResponseJob('Unable to delete Role'));}

		return $this->run(new JsonResponseJob('Role Deleted Successfully'));
    }
}