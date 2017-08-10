<?php

namespace App\Domains\User\Jobs;

use App\Domains\User\Validators\CreateUserValidator;
use Awok\Foundation\Job;

class CreateUserInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( CreateUserValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}