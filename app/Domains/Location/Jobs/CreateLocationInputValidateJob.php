<?php

namespace App\Domains\Location\Jobs;

use App\Domains\Location\Validators\CreateLocationValidator;
use Awok\Foundation\Job;

class CreateLocationInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( CreateLocationValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}