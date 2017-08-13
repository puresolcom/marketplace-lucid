<?php

namespace App\Operations;

use App\Domains\Product\Jobs\CreateProductInputValidateJob;
use App\Domains\Product\Jobs\CreateProductTranslatableValidateJob;
use Awok\Foundation\Operation;

class CreateProductInputValidateOperation extends Operation
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle()
    {
        $this->run(CreateProductInputValidateJob::class, ['input' => $this->input]);

        $this->run(CreateProductTranslatableValidateJob::class, ['input' => $this->input]);
    }
}