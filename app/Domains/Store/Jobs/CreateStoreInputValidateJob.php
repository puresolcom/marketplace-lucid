<?php

namespace App\Domains\Store\Jobs;

use App\Domains\Store\Validators\CreateStoreValidator;
use Awok\Foundation\Job;

class CreateStoreInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( CreateStoreValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}