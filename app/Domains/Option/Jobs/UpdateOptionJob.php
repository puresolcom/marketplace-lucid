<?php

namespace App\Domains\Option\Jobs;

use App\Data\Models\Option;
use Awok\Foundation\Job;

class UpdateOptionJob extends Job
{

	protected $model;
	protected $input;

    public function __construct( Option $model, array $input )
    {
    	$this->model     = $model;
		$this->input     = $input;
    }

    public function handle(  )
    {
    	return $this->model->update($this->input) ? $this->model : false;
    }
}