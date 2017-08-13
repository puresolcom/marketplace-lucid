<?php

namespace App\Domains\ProductsAttribute\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;

class ExtractCreateProductsAttributeOptionFieldsJob extends InputFilterJob
{
    protected $expectedKeys = [];
}