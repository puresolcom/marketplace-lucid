<?php

namespace App\Domains\Location\Jobs;

use App\Data\Models\Location;
use Awok\Foundation\Job;

class DeleteLocationJob extends Job
{

	protected $model;

    public function __construct( Location $model )
    {
    	$this->model = $model;
    }

    public function handle(  )
    {
    	return $this->model->delete();
    }
}