<?php

namespace Awok\Foundation;

use Awok\Foundation\Http\Request;

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