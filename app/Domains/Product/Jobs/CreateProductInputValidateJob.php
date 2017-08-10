<?php

namespace App\Domains\Product\Jobs;

use App\Domains\Product\Validators\CreateProductValidator;
use Awok\Foundation\Job;

class CreateProductInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( CreateProductValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}