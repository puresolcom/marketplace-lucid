<?php

namespace App\Domains\Store\Jobs;

use App\Data\Models\Store;
use Awok\Foundation\Job;

class UpdateStoreJob extends Job
{

	protected $model;
	protected $input;

    public function __construct( Store $model, array $input )
    {
    	$this->model     = $model;
		$this->input     = $input;
    }

    public function handle(  )
    {
    	return $this->model->update($this->input) ? $this->model : false;
    }
}