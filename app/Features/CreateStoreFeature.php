<?php

namespace App\Features;

use App\Operations\CreateStoreOperation;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;

class CreateStoreFeature extends Feature
{
    public function __construct()
    {
    }

    public function handle()
    {
        $created = $this->run(CreateStoreOperation::class);

        // Response
        if (! $created) {
            return $this->run(new JsonErrorResponseJob(trans('Unable to create Store')));
        }

        return $this->run(new JsonResponseJob($created));
    }
}