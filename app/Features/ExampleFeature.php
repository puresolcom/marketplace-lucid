<?php

namespace App\Features;

use App\Domains\Example\Jobs\ExampleJob;
use Awok\Domains\Http\Jobs\JsonResponseJob;
use Awok\Foundation\Feature;

class ExampleFeature extends Feature
{
    protected $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    // Request is injected automatically
    public function handle()
    {
        $jobResult = $this->run(ExampleJob::class, ['data' => $this->data]);

        return $this->run(new JsonResponseJob($jobResult));
    }
}