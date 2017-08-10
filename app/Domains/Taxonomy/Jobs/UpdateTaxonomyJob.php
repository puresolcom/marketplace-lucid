<?php

namespace App\Domains\Taxonomy\Jobs;

use App\Data\Models\Taxonomy;
use Awok\Foundation\Job;

class UpdateTaxonomyJob extends Job
{

	protected $model;
	protected $input;

    public function __construct( Taxonomy $model, array $input )
    {
    	$this->model     = $model;
		$this->input     = $input;
    }

    public function handle(  )
    {
    	return $this->model->update($this->input) ? $this->model : false;
    }
}