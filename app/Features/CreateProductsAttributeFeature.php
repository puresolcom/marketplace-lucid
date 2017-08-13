<?php

namespace App\Features;

use App\Operations\CreateProductsAttributeInputValidateOperation;
use App\Operations\CreateProductsAttributeOperation;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;

class CreateProductsAttributeFeature extends Feature
{
    public function __construct()
    {
    }

    public function handle(Request $request)
    {
        // Validate Request Inputs
        $this->run(CreateProductsAttributeInputValidateOperation::class, ['input' => $request->all()]);

        // Create model
        $model = $this->run(CreateProductsAttributeOperation::class, ['input' => $request->all()]);

        // Response
        if (! $model) {
            return $this->run(new JsonErrorResponseJob('Unable to create ProductsAttribute'));
        }

        return $this->run(new JsonResponseJob($model));
    }
}