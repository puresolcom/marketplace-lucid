<?php

namespace App\Features;

use App\Data\Models\Store;
use App\Operations\UpdateStoreOperation;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;

class UpdateStoreFeature extends Feature
{
    protected $objectID;

    public function __construct(int $objectID)
    {
        $this->objectID = $objectID;
    }

    public function handle(Request $request)
    {
        // Finding model
        $model = $this->run(FindObjectByIDJob::class, ['model' => Store::class, 'objectID' => $this->objectID]);

        $updated = $this->run(UpdateStoreOperation::class, ['model' => $model]);

        // Response
        if (! $updated) {
            return $this->run(new JsonErrorResponseJob(trans('Unable to update Store')));
        }

        return $this->run(new JsonResponseJob($updated));
    }
}