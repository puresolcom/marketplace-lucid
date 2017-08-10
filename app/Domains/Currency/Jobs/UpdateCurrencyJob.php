<?php

namespace App\Domains\Currency\Jobs;

use App\Data\Models\Currency;
use Awok\Foundation\Job;

class UpdateCurrencyJob extends Job
{

	protected $model;
	protected $input;

    public function __construct( Currency $model, array $input )
    {
    	$this->model     = $model;
		$this->input     = $input;
    }

    public function handle(  )
    {
    	return $this->model->update($this->input) ? $this->model : false;
    }
}