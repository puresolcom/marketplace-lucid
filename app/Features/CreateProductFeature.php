<?php

namespace App\Features;

use App\Operations\CreateProductInputValidateOperation;
use App\Operations\CreateProductOperation;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;
use App\Domains\Product\Jobs\CreateProductInputFilterJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;

class CreateProductFeature extends Feature
{
    public function __construct()
    {
    }

    public function handle(Request $request)
    {
        // Validate Request Inputs
        $this->run(CreateProductInputValidateOperation::class, ['input' => $request->all()]);

        // Create model
        $created = $this->run(CreateProductOperation::class, ['input' => $request->all()]);

        // Response
        if (! $created) {
            return $this->run(new JsonErrorResponseJob('Unable to create Product'));
        }

        return $this->run(new JsonResponseJob($created));
    }
}