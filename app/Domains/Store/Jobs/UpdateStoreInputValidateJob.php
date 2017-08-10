<?php

namespace App\Domains\Store\Jobs;

use App\Domains\Store\Validators\UpdateStoreValidator;
use Awok\Foundation\Job;

class UpdateStoreInputValidateJob extends Job
{

	protected $input;

    public function __construct( array $input )
    {
    	$this->input = $input;
    }

    public function handle( UpdateStoreValidator $validator )
    {
    	return $validator->validate($this->input);
    }
}