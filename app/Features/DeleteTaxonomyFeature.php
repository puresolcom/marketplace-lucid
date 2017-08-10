<?php

namespace App\Features;

use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Taxonomy\Jobs\DeleteTaxonomyJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use App\Data\Models\Taxonomy;

class DeleteTaxonomyFeature extends Feature
{
	protected $objectID;

	public function __construct( int $objectID )
	{
		$this->objectID = $objectID;
	}

    public function handle(Request $request)
    {
        // Finding model
		$model = $this->run(FindObjectByIDJob::class, ['model' => Taxonomy::class, 'objectID' => $this->objectID]);

		// Deleting model
		$deleted = $this->run(DeleteTaxonomyJob::class, ['model' => $model]);

		// Response
		if (! $deleted) {return $this->run(new JsonErrorResponseJob('Unable to delete Taxonomy'));}

		return $this->run(new JsonResponseJob('Taxonomy Deleted Successfully'));
    }
}