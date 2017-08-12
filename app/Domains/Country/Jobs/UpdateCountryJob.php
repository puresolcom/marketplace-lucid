<?php

namespace App\Domains\Country\Jobs;

use App\Data\Models\Country;
use Awok\Foundation\Job;

class UpdateCountryJob extends Job
{

	protected $model;
	protected $input;

    public function __construct( Country $model, array $input )
    {
    	$this->model     = $model;
		$this->input     = $input;
    }

    public function handle(  )
    {
    	return $this->model->update($this->input) ? $this->model : false;
    }
}