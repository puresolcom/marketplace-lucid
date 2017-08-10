<?php

namespace App\Domains\Product\Jobs;

use App\Domains\Product\Validators\UpdateProductValidator;
use Awok\Foundation\Job;

class UpdateProductInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( UpdateProductValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}