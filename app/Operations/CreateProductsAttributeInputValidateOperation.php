<?php

namespace App\Operations;

use App\Domains\ProductsAttribute\Jobs\CreateProductsAttributeInputValidateJob;
use App\Domains\ProductsAttribute\Jobs\CreateProductsAttributeOptionTranslatableJob;
use App\Domains\ProductsAttribute\Jobs\CreateProductsAttributeOptionValidateJob;
use App\Domains\ProductsAttribute\Jobs\CreateProductsAttributeTranslatableValidateJob;
use Awok\Foundation\Operation;

class CreateProductsAttributeInputValidateOperation extends Operation
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle()
    {
        $this->run(CreateProductsAttributeInputValidateJob::class, ['input' => $this->input]);

        $this->run(CreateProductsAttributeTranslatableValidateJob::class, ['input' => $this->input]);

        $this->run(CreateProductsAttributeOptionValidateJob::class, ['input' => $this->input]);

        //$this->run(CreateProductsAttributeOptionTranslatableJob::class, ['input' => $this->input]);
    }
}