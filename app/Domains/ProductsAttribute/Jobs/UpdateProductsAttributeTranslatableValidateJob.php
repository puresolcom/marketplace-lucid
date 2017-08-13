<?php

namespace App\Domains\ProductsAttribute\Jobs;

use App\Domains\ProductsAttribute\Validators\UpdateProductsAttributeTranslatableValidator;
use Awok\Foundation\Job;

class UpdateProductsAttributeTranslatableValidateJob extends Job
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle(UpdateProductsAttributeTranslatableValidator $validator)
    {
        return $validator->validate($this->input);
    }
}