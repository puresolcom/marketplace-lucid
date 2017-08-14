<?php

namespace App\Operations;

use App\Data\Models\Product;
use App\Domains\Product\Jobs\ExtractUpdateProductFieldsJob;
use App\Domains\Product\Jobs\SaveProductTranslationJob;
use App\Domains\Product\Jobs\UpdateProductJob;
use Awok\Foundation\Exceptions\Exception;
use Awok\Foundation\Operation;
use Laravel\Lumen\Application;

class UpdateProductOperation extends Operation
{
    protected $input;

    protected $model;

    public function __construct(Product $model, array $input)
    {
        $this->input = $input;
        $this->model = $model;
    }

    public function handle(Application $app)
    {
        $app->make('db')->beginTransaction();

        try {
            $updated = $this->updateProduct();

            if (! $updated) {
                $app->make('db')->rollback();
                throw new Exception(trans('failed to update product'));
            }

            $this->updateProductTranslatable();
            $this->setProductTaxonomies();
        } catch (\Exception $e) {
            $app->make('db')->rollback();
            throw $e;
        }

        $app->make('db')->commit();

        return $updated->load(['translations', 'store', 'currency', 'approved_by', 'categories', 'tags']);
    }

    protected function updateProduct()
    {
        // Filter input fields
        $updateProductFields = $this->run(ExtractUpdateProductFieldsJob::class);

        // update product details
        $updated = $this->run(UpdateProductJob::class, [
            'model' => $this->model,
            'input' => $updateProductFields,
        ]);

        return $updated;
    }

    protected function updateProductTranslatable()
    {
        $productTranslations = $this->run(ExtractTranslatableFieldsOperation::class, [
            'input' => $this->input,
            'keys'  => ['title', 'description'],
        ]);

        if (! empty($productTranslations)) {
            $this->run(SaveProductTranslationJob::class, [
                'model' => $this->model,
                'input' => $productTranslations,
            ]);
        }
    }

    protected function setProductTaxonomies()
    {
        $this->run(SetProductTaxonomiesOperation::class, ['input' => $this->input, 'model' => $this->model]);
    }
}