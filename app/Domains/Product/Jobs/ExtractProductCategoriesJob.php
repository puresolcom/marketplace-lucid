<?php

namespace App\Domains\Product\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;

class ExtractProductCategoriesJob extends InputFilterJob
{
    protected $expectedKeys = [
        'category_ids',
    ];
}