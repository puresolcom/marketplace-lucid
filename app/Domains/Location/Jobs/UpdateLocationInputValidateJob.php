<?php

namespace App\Domains\Location\Jobs;

use App\Domains\Location\Validators\UpdateLocationValidator;
use Awok\Foundation\Job;

class UpdateLocationInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( UpdateLocationValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}