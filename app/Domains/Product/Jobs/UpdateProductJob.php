<?php

namespace App\Domains\Product\Jobs;

use App\Data\Models\Product;
use Awok\Foundation\Job;

class UpdateProductJob extends Job
{

	protected $model;
	protected $input;

    public function __construct( Product $model, array $input )
    {
    	$this->model     = $model;
		$this->input     = $input;
    }

    public function handle(  )
    {
    	return $this->model->update($this->input) ? $this->model : false;
    }
}