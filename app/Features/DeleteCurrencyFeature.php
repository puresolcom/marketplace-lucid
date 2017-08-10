<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Currency\Jobs\DeleteCurrencyJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use App\Data\Models\Currency;

class DeleteCurrencyFeature extends Feature
{
	protected $objectID;

	public function __construct( int $objectID )
	{
		$this->objectID = $objectID;
	}

    public function handle(Request $request)
    {
        // Finding model
		$model = $this->run(FindObjectByIDJob::class, ['model' => Currency::class, 'objectID' => $this->objectID]);

		// Deleting model
		$deleted = $this->run(DeleteCurrencyJob::class, ['model' => $model]);

		// Response
		if (! $deleted) {return $this->run(new JsonErrorResponseJob('Unable to delete Currency'));}

		return $this->run(new JsonResponseJob('Currency Deleted Successfully'));
    }
}