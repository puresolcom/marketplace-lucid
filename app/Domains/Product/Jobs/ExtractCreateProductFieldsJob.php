<?php

namespace App\Domains\Product\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;

class ExtractCreateProductFieldsJob extends InputFilterJob
{
    protected $expectedKeys = [
        'upc',
        'sku',
        'stock',
        'price',
        'discount_price',
        'currency_id',
        'store_id',
        'active',
        'approved_by',
        ' approved',
    ];
}