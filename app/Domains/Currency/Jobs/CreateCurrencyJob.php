<?php

namespace App\Domains\Currency\Jobs;

use App\Data\Models\Currency;
use Awok\Foundation\Job;

class CreateCurrencyJob extends Job
{

	protected $data;

    public function __construct( array $input )
    {
    	$this->data = $input;
    }

    public function handle( Currency $model )
    {
    	return $model->create($this->data);
    }
}