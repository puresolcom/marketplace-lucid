<?php

namespace App\Domains\Product\Jobs;

use App\Data\Models\Product;
use Awok\Foundation\Job;

class DeleteProductJob extends Job
{

	protected $model;

    public function __construct( Product $model )
    {
    	$this->model = $model;
    }

    public function handle(  )
    {
    	return $this->model->delete();
    }
}