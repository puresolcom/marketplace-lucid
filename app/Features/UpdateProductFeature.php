<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Product\Jobs\UpdateProductInputValidateJob;
use App\Domains\Product\Jobs\UpdateProductInputFilterJob;
use App\Domains\Product\Jobs\UpdateProductJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use App\Data\Models\Product;

class UpdateProductFeature extends Feature
{
	protected $objectID;

	public function __construct( int $objectID )
	{
		$this->objectID = $objectID;
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(UpdateProductInputValidateJob::class, ['input' => $request->all()]);
		// Finding model
		$model = $this->run(FindObjectByIDJob::class,  ['model' => Product::class, 'objectID' => $this->objectID]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(UpdateProductInputFilterJob::class);

		// Update model
		$updated = $this->run(UpdateProductJob::class, ['model' => $model, 'input' => $filteredInputs]);

		// Response
		if (! $updated) { return $this->run(new JsonErrorResponseJob('Unable to update Product')); }

		return $this->run(new JsonResponseJob($updated));
    }
}