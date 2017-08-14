<?php

namespace App\Domains\Product\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;

class ExtractProductTagsJob extends InputFilterJob
{
    protected $expectedKeys = ['tag_ids'];
}