<?php

namespace App\Domains\Option\Jobs;

use App\Domains\Option\Validators\UpdateOptionValidator;
use Awok\Foundation\Job;

class UpdateOptionInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( UpdateOptionValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}