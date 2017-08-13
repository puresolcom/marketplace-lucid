<?php

namespace App\Operations;

use App\Data\Models\ProductsAttribute;
use App\Domains\ProductsAttribute\Jobs\ExtractUpdateProductsAttributeFieldsJob;
use App\Domains\ProductsAttribute\Jobs\SaveProductsAttributeTranslatableJob;
use App\Domains\ProductsAttribute\Jobs\UpdateProductsAttributeJob;
use Awok\Foundation\Operation;
use Laravel\Lumen\Application;

class UpdateProductsAttributeOperation extends Operation
{
    protected $input;

    protected $model;

    public function __construct(ProductsAttribute $model, array $input)
    {
        $this->input = $input;
        $this->model = $model;
    }

    public function handle(Application $app)
    {
        $app->make('db')->beginTransaction();

        $productAttribute          = $this->run(ExtractUpdateProductsAttributeFieldsJob::class, ['input' => $this->input]);
        $productAttributeTranslate = $this->run(ExtractTranslatableFieldsOperation::class, [
            'input' => $this->input,
            'keys'  => ['name'],
        ]);

        try {
            $model = $this->run(UpdateProductsAttributeJob::class, [
                'model' => $this->model,
                'input' => $productAttribute,
            ]);
            $this->run(SaveProductsAttributeTranslatableJob::class, [
                'model' => $this->model,
                'input' => $productAttributeTranslate,
            ]);
        } catch (\Exception $e) {
            $app->make('db')->rollback();
            throw $e;
        }

        $model = $model->load(['translations']);

        $app->make('db')->commit();

        return $model;
    }
}