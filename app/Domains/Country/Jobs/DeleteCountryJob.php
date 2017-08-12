<?php

namespace App\Domains\Country\Jobs;

use App\Data\Models\Country;
use Awok\Foundation\Job;

class DeleteCountryJob extends Job
{

	protected $model;

    public function __construct( Country $model )
    {
    	$this->model = $model;
    }

    public function handle(  )
    {
    	return $this->model->delete();
    }
}