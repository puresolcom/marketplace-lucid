<?php

namespace App\Operations;

use App\Domains\ProductsAttribute\Jobs\CreateProductsAttributeJob;
use App\Domains\ProductsAttribute\Jobs\CreateProductsAttributeOptionJob;
use App\Domains\ProductsAttribute\Jobs\ExtractCreateProductsAttributeFieldsJob;
use App\Domains\ProductsAttribute\Jobs\ExtractCreateProductsAttributeOptionFieldsJob;
use App\Domains\ProductsAttribute\Jobs\SaveProductsAttributeTranslatableJob;
use Awok\Foundation\Operation;
use Laravel\Lumen\Application;

class CreateProductsAttributeOperation extends Operation
{
    protected $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function handle(Application $app)
    {
        $app->make('db')->beginTransaction();

        $productAttribute             = $this->run(ExtractCreateProductsAttributeFieldsJob::class, ['input' => $this->input]);
        $productAttributeTranslatable = $this->run(ExtractTranslatableFieldsOperation::class, [
            'input' => $this->input,
            'keys'  => ['name'],
        ]);
        $productAttributeOption       = $this->run(ExtractCreateProductsAttributeOptionFieldsJob::class, ['input' => $this->input]);

        try {
            $model = $this->run(CreateProductsAttributeJob::class, ['input' => $productAttribute]);
            $this->run(SaveProductsAttributeTranslatableJob::class, [
                'model' => $model,
                'input' => $productAttributeTranslatable,
            ]);

            if (! empty($productAttributeOption)) {
                $this->run(CreateProductsAttributeOptionJob::class, [
                    'model' => $model,
                    'input' => $productAttributeOption,
                ]);
            }
        } catch (\Exception $e) {
            $app->make('db')->rollback();
            throw $e;
        }

        $results = $model->where('id', $model->id)->with(['translations'])->get();

        $app->make('db')->commit();

        return $results;
    }
}