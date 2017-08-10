<?php

namespace App\Domains\Option\Jobs;

use App\Data\Models\Option;
use Awok\Foundation\Job;

class CreateOptionJob extends Job
{

	protected $data;

    public function __construct( array $input )
    {
    	$this->data = $input;
    }

    public function handle( Option $model )
    {
    	return $model->create($this->data);
    }
}