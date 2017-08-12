<?php

namespace App\Domains\Country\Jobs;

use App\Domains\Country\Validators\UpdateCountryValidator;
use Awok\Foundation\Job;

class UpdateCountryInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( UpdateCountryValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}