<?php

namespace App\Domains\Product\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;

class ExtractUpdateProductFieldsJob extends InputFilterJob
{
    protected $expectedKeys = ['upc', 'sku', 'stock', 'price', 'discount_price', 'currency_id', 'store_id', 'active'];
}