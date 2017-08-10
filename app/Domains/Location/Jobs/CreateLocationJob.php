<?php

namespace App\Domains\Location\Jobs;

use App\Data\Models\Location;
use Awok\Foundation\Job;

class CreateLocationJob extends Job
{

	protected $data;

    public function __construct( array $input )
    {
    	$this->data = $input;
    }

    public function handle( Location $model )
    {
    	return $model->create($this->data);
    }
}