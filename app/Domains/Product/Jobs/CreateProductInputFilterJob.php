<?php

namespace App\Domains\Product\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;
use Awok\Foundation\Http\Request;

class CreateProductInputFilterJob extends InputFilterJob
{
    protected $expectedKeys = [
        'title',
        'description',
        'upc',
        'sku',
        'price',
        'discount_price',
        'stock',
        'currency_id',
        'store_id',
        'attributes',
        'categories',
        'tags',
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