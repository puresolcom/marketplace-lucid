<?php

namespace App\Domains\Taxonomy\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;
use Awok\Foundation\Http\Request;

class CreateTaxonomyInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'type',
        'parent_id',
        'name',
        'slug',
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