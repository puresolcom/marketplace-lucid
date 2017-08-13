<?php

namespace App\Features;

use App\Data\Models\Taxonomy;
use App\Operations\UpdateTaxonomyOperation;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;

class UpdateTaxonomyFeature extends Feature
{
    protected $objectID;

    public function __construct(int $objectID)
    {
        $this->objectID = $objectID;
    }

    public function handle(Request $request)
    {
        // Finding model
        $model = $this->run(FindObjectByIDJob::class, ['model' => Taxonomy::class, 'objectID' => $this->objectID]);

        $updated = $this->run(UpdateTaxonomyOperation::class, ['model' => $model]);

        // Response
        if (! $updated) {
            return $this->run(new JsonErrorResponseJob('Unable to update Taxonomy'));
        }

        return $this->run(new JsonResponseJob($updated));
    }
}