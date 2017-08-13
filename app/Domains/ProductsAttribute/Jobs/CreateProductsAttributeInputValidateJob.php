<?php

namespace App\Domains\ProductsAttribute\Jobs;

use App\Domains\ProductsAttribute\Validators\CreateProductsAttributeValidator;
use Awok\Foundation\Job;

class CreateProductsAttributeInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( CreateProductsAttributeValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}