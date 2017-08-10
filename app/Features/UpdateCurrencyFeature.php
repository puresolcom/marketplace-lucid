<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Currency\Jobs\UpdateCurrencyInputValidateJob;
use App\Domains\Currency\Jobs\UpdateCurrencyInputFilterJob;
use App\Domains\Currency\Jobs\UpdateCurrencyJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use App\Data\Models\Currency;

class UpdateCurrencyFeature extends Feature
{
	protected $objectID;

	public function __construct( int $objectID )
	{
		$this->objectID = $objectID;
	}

    public function handle(Request $request)
    {
        // Validate Request Inputs
		$this->run(UpdateCurrencyInputValidateJob::class, ['input' => $request->all()]);
		// Finding model
		$model = $this->run(FindObjectByIDJob::class,  ['model' => Currency::class, 'objectID' => $this->objectID]);

		// Exclude unwanted Inputs
		$filteredInputs = $this->run(UpdateCurrencyInputFilterJob::class);

		// Update model
		$updated = $this->run(UpdateCurrencyJob::class, ['model' => $model, 'input' => $filteredInputs]);

		// Response
		if (! $updated) { return $this->run(new JsonErrorResponseJob('Unable to update Currency')); }

		return $this->run(new JsonResponseJob($updated));
    }
}