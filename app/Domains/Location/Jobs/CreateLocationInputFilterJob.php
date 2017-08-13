<?php

namespace App\Domains\Location\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;
use Awok\Foundation\Http\Request;

class CreateLocationInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'name',
        'slug',
        'type',
        'parent_id',
        'country_id',
    ];

    public function __construct(array $expectedKeys = [])
    {
        parent::__construct($expectedKeys);
    }

    public function handle(Request $request)
    {
        return parent::handle($request);
    }
}