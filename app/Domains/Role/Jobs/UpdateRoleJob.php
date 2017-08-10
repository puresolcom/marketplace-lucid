<?php

namespace App\Domains\Role\Jobs;

use App\Data\Models\Role;
use Awok\Foundation\Job;

class UpdateRoleJob extends Job
{

	protected $model;
	protected $input;

    public function __construct( Role $model, array $input )
    {
    	$this->model     = $model;
		$this->input     = $input;
    }

    public function handle(  )
    {
    	return $this->model->update($this->input) ? $this->model : false;
    }
}