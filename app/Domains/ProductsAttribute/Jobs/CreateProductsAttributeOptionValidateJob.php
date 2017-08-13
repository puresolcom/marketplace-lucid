<?php

namespace App\Domains\ProductsAttribute\Jobs;

use App\Domains\ProductsAttribute\Validators\CreateProductsAttributeOptionValidator;
use Awok\Foundation\Job;

class CreateProductsAttributeOptionValidateJob extends Job
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle(CreateProductsAttributeOptionValidator $validator)
    {
        return $validator->validate($this->input);
    }
}