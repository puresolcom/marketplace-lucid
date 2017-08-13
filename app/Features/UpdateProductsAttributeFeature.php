<?php

namespace App\Features;

use App\Operations\UpdateProductsAttributeInputValidateOperation;
use App\Operations\UpdateProductsAttributeOperation;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\ProductsAttribute\Jobs\UpdateProductsAttributeInputValidateJob;
use App\Domains\ProductsAttribute\Jobs\UpdateProductsAttributeInputFilterJob;
use App\Domains\ProductsAttribute\Jobs\UpdateProductsAttributeJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Data\Jobs\FindObjectByIDJob;
use App\Data\Models\ProductsAttribute;

class UpdateProductsAttributeFeature extends Feature
{
    protected $objectID;

    public function __construct(int $objectID)
    {
        $this->objectID = $objectID;
    }

    public function handle(Request $request)
    {
        // Finding model
        $model = $this->run(FindObjectByIDJob::class, [
            'model'    => ProductsAttribute::class,
            'objectID' => $this->objectID,
        ]);

        // Validate Request Inputs
        $this->run(UpdateProductsAttributeInputValidateOperation::class, ['input' => $request->all()]);

        // Update model
        $model = $this->run(UpdateProductsAttributeOperation::class, ['model' => $model, 'input' => $request->all()]);

        // Response
        if (! $model) {
            return $this->run(new JsonErrorResponseJob('Unable to update ProductsAttribute'));
        }

        return $this->run(new JsonResponseJob($model));
    }
}