<?php

namespace App\Domains\Location\Jobs;

use App\Data\Models\Location;
use Awok\Foundation\Job;

class UpdateLocationJob extends Job
{

	protected $model;
	protected $input;

    public function __construct( Location $model, array $input )
    {
    	$this->model     = $model;
		$this->input     = $input;
    }

    public function handle(  )
    {
    	return $this->model->update($this->input) ? $this->model : false;
    }
}