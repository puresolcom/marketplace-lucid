<?php

namespace App\Domains\Country\Jobs;

use App\Domains\Country\Validators\CreateCountryValidator;
use Awok\Foundation\Job;

class CreateCountryInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( CreateCountryValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}