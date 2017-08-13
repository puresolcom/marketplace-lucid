<?php

namespace App\Domains\ProductsAttribute\Jobs;

use App\Domains\ProductsAttribute\Validators\UpdateProductsAttributeValidator;
use Awok\Foundation\Job;

class UpdateProductsAttributeInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( UpdateProductsAttributeValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}