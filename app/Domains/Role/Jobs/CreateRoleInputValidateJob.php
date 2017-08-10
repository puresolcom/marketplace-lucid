<?php

namespace App\Domains\Role\Jobs;

use App\Domains\Role\Validators\CreateRoleValidator;
use Awok\Foundation\Job;

class CreateRoleInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( CreateRoleValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}