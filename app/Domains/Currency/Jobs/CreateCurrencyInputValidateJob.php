<?php

namespace App\Domains\Currency\Jobs;

use App\Domains\Currency\Validators\CreateCurrencyValidator;
use Awok\Foundation\Job;

class CreateCurrencyInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( CreateCurrencyValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}