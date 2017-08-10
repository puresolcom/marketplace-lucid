<?php

namespace App\Domains\Option\Jobs;

use App\Domains\Option\Validators\CreateOptionValidator;
use Awok\Foundation\Job;

class CreateOptionInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( CreateOptionValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}