<?php

namespace App\Domains\Product\Jobs;

use App\Domains\Product\Validators\UpdateProductTranslatableValidator;
use Awok\Foundation\Job;

class UpdateProductTranslatableValidateJob extends Job
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle(UpdateProductTranslatableValidator $validator)
    {
        return $validator->validate($this->input);
    }
}