<?php

namespace App\Domains\ProductsAttribute\Jobs;

use App\Data\Models\ProductsAttribute;
use Awok\Foundation\Job;

class CreateProductsAttributeJob extends Job
{

	protected $data;

    public function __construct( array $input )
    {
    	$this->data = $input;
    }

    public function handle( ProductsAttribute $model )
    {
    	return $model->create($this->data);
    }
}