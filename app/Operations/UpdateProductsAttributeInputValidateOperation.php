<?php

namespace App\Operations;

use App\Domains\ProductsAttribute\Jobs\UpdateProductsAttributeInputValidateJob;
use App\Domains\ProductsAttribute\Jobs\UpdateProductsAttributeTranslatableValidateJob;
use Awok\Foundation\Operation;

class UpdateProductsAttributeInputValidateOperation extends Operation
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle()
    {
        $this->run(UpdateProductsAttributeInputValidateJob::class, ['input' => $this->input]);

        $this->run(UpdateProductsAttributeTranslatableValidateJob::class, ['input' => $this->input]);
    }
}