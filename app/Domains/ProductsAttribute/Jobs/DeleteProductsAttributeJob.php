<?php

namespace App\Domains\ProductsAttribute\Jobs;

use App\Data\Models\ProductsAttribute;
use Awok\Foundation\Job;

class DeleteProductsAttributeJob extends Job
{

	protected $model;

    public function __construct( ProductsAttribute $model )
    {
    	$this->model = $model;
    }

    public function handle(  )
    {
    	return $this->model->delete();
    }
}