<?php

namespace App\Domains\ProductsAttribute\Jobs;

use App\Domains\ProductsAttribute\Validators\CreateProductsAttributeOptionValidator;
use Awok\Foundation\Job;

class CreateProductsAttributeOptionTranslatableJob extends Job
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle(CreateProductsAttributeOptionValidator $validator)
    {
        $validator->validate($this->input);
    }
}