<?php

namespace App\Domains\Currency\Jobs;

use App\Domains\Currency\Validators\UpdateCurrencyValidator;
use Awok\Foundation\Job;

class UpdateCurrencyInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( UpdateCurrencyValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}