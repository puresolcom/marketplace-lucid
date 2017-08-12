<?php

namespace App\Domains\Country\Jobs;

use App\Data\Models\Country;
use Awok\Foundation\Job;

class CreateCountryJob extends Job
{

	protected $data;

    public function __construct( array $input )
    {
    	$this->data = $input;
    }

    public function handle( Country $model )
    {
    	return $model->create($this->data);
    }
}