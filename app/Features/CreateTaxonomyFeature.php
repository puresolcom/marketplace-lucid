<?php

namespace App\Features;

use App\Operations\CreateTaxonomyOperation;
use Awok\Domains\Http\Jobs\JsonErrorResponseJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;
use Awok\Foundation\Http\Request;

class CreateTaxonomyFeature extends Feature
{
    public function __construct()
    {
    }

    public function handle()
    {

        $created = $this->run(CreateTaxonomyOperation::class);

        // Response
        if (! $created) {
            return $this->run(new JsonErrorResponseJob('Unable to create Taxonomy'));
        }

        return $this->run(new JsonResponseJob($created));
    }
}