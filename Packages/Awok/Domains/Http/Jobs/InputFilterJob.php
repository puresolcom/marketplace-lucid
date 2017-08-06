<?php

namespace Awok\Domains\Http\Jobs;

use Awok\Foundation\Http\Request;
use Awok\Foundation\Job;

class InputFilterJob extends Job
{
    protected $expectedKeys = [];

    public function __construct($expectedKeys = [])
    {
        if (! empty($expectedKeys)) {
            $this->expectedKeys = $expectedKeys;
        }
    }

    public function handle(Request $request)
    {
        return $request->expect($this->expectedKeys);
    }
}