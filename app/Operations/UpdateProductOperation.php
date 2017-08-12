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

    protected $product;

    public function __construct(Product $product, array $input)
    {
        $this->input   = $input;
        $this->product = $product;
    }

    public function handle(Application $app)
    {
        // begin transaction
        $app->make('db')->beginTransaction();

        try {
            $updated = $this->updateProduct();
            
            if (! $updated) {
                $app->make('db')->rollback();
                throw new Exception(trans('failed to update product'));
            }

            $this->updateProductTranslatable();
        } catch (\Exception $e) {
            // rollback
            $app->make('db')->rollback();
            throw $e;
        }

        // commit
        $app->make('db')->commit();

        return true;
    }

    protected function updateProduct()
    {
        // Filter input fields
        $updateProductFields = $this->run(ExtractUpdateProductFieldsJob::class);

        // update product details
        $updated = $this->run(UpdateProductJob::class, [
            'model' => $this->product,
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
                'model' => $this->product,
                'input' => $productTranslations,
            ]);
        }
    }
}