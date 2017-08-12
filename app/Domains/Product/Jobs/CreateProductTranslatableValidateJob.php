<?php

namespace App\Domains\Product\Jobs;

use App\Domains\Product\Validators\CreateProductTranslatableValidator;
use Awok\Foundation\Job;

class CreateProductTranslatableValidateJob extends Job
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle(CreateProductTranslatableValidator $validator)
    {
        return $validator->validate($this->input);
    }
}