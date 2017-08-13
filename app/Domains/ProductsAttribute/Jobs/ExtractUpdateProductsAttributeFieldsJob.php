<?php

namespace App\Domains\ProductsAttribute\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;

class ExtractUpdateProductsAttributeFieldsJob extends InputFilterJob
{
    protected $expectedKeys = ['slug', 'type', 'multiple', 'configuration', 'required', 'position'];
}