<?php

namespace App\Domains\User\Jobs;

use App\Domains\User\Validators\UpdateUserValidator;
use Awok\Foundation\Job;

class UpdateUserInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( UpdateUserValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}