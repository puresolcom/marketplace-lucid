<?php

namespace App\Operations;

use App\Domains\Product\Jobs\UpdateProductInputValidateJob;
use App\Domains\Product\Jobs\UpdateProductTranslatableValidateJob;
use Awok\Foundation\Operation;

class UpdateProductInputValidateOperation extends Operation
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle()
    {
        $this->run(UpdateProductInputValidateJob::class, ['input' => $this->input]);

        $this->run(UpdateProductTranslatableValidateJob::class, ['input' => $this->input]);
    }
}