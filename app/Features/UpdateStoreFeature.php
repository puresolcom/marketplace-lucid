<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Store\Jobs\UpdateStoreInputValidateJob;
use App\Domains\Store\Jobs\UpdateStoreInputFilterJob;
use App\Domains\Store\Jobs\UpdateStoreJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use App\Data\Models\Store;

class UpdateStoreFeature extends Feature
{
	protected $objectID;

	public function __construct( int $objectID )
	{
		$this->objectID = $objectID;
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(UpdateStoreInputValidateJob::class, ['input' => $request->all()]);
		// Finding model
		$model = $this->run(FindObjectByIDJob::class,  ['model' => Store::class, 'objectID' => $this->objectID]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(UpdateStoreInputFilterJob::class);

		// Update model
		$updated = $this->run(UpdateStoreJob::class, ['model' => $model, 'input' => $filteredInputs]);

		// Response
		if (! $updated) { return $this->run(new JsonErrorResponseJob('Unable to update Store')); }

		return $this->run(new JsonResponseJob($updated));
    }
}