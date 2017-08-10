<?php

namespace App\Domains\Currency\Jobs;

use App\Data\Models\Currency;
use Awok\Foundation\Job;

class DeleteCurrencyJob extends Job
{

	protected $model;

    public function __construct( Currency $model )
    {
    	$this->model = $model;
    }

    public function handle(  )
    {
    	return $this->model->delete();
    }
}