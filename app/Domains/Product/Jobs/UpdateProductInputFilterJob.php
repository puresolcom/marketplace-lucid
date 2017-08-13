<?php

namespace App\Domains\Product\Jobs;

use Awok\Domains\Http\Jobs\InputFilterJob;
use Awok\Foundation\Http\Request;

class UpdateProductInputFilterJob extends InputFilterJob
{

	protected $expectedKeys = [/** @todo add array of expected input keys here */];
}