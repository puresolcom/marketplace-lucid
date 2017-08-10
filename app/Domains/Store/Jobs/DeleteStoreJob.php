<?php

namespace App\Domains\Store\Jobs;

use App\Data\Models\Store;
use Awok\Foundation\Job;

class DeleteStoreJob extends Job
{

	protected $model;

    public function __construct( Store $model )
    {
    	$this->model = $model;
    }

    public function handle(  )
    {
    	return $this->model->delete();
    }
}