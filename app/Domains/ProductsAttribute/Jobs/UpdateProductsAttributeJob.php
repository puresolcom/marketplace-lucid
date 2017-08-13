<?php

namespace App\Domains\ProductsAttribute\Jobs;

use App\Data\Models\ProductsAttribute;
use Awok\Foundation\Job;

class UpdateProductsAttributeJob extends Job
{

	protected $model;
	protected $input;

    public function __construct( ProductsAttribute $model, array $input )
    {
    	$this->model     = $model;
		$this->input     = $input;
    }

    public function handle(  )
    {
    	return $this->model->update($this->input) ? $this->model : false;
    }
}