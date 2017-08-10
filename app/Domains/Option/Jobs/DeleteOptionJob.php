<?php

namespace App\Domains\Option\Jobs;

use App\Data\Models\Option;
use Awok\Foundation\Job;

class DeleteOptionJob extends Job
{

	protected $model;

    public function __construct( Option $model )
    {
    	$this->model = $model;
    }

    public function handle(  )
    {
    	return $this->model->delete();
    }
}