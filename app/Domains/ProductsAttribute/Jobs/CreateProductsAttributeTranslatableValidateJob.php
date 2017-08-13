<?php

namespace App\Domains\ProductsAttribute\Jobs;

use App\Domains\ProductsAttribute\Validators\CreateProductsAttributeTranslatableValidator;
use Awok\Foundation\Job;

class CreateProductsAttributeTranslatableValidateJob extends Job
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle(CreateProductsAttributeTranslatableValidator $validator)
    {
        return $validator->validate($this->input);
    }
}