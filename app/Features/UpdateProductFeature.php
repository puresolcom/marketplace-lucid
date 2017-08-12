<?php

namespace App\Features;

use App\Operations\UpdateProductInputValidateOperation;
use App\Operations\UpdateProductOperation;
use Awok\Domains\Authorization\Jobs\CapabilityCheckJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use App\Data\Models\Product;

class UpdateProductFeature extends Feature
{
    protected $objectID;

    public function __construct(int $objectID)
    {
        $this->objectID = $objectID;
    }

    public function handle(Request $request)
    {
        // Finding model
        $product = $this->run(FindObjectByIDJob::class, ['model' => Product::class, 'objectID' => $this->objectID]);

        // capability check
        $this->run(new CapabilityCheckJob(function($auth) use ($product) {
            if ($auth->hasRole('seller')) {
                return $auth->getUser()->id == $product->store->user_id;
            }

            return true;
        }));

        // Validate Request Inputs
        $this->run(UpdateProductInputValidateOperation::class, ['input' => $request->all()]);

        // update products
        $updated = $this->run(UpdateProductOperation::class, ['input' => $request->all(), 'product' => $product]);

        // Response
        if (! $updated) {
            return $this->run(new JsonErrorResponseJob('Unable to update Product'));
        }

        return $this->run(new JsonResponseJob($updated));
    }
}