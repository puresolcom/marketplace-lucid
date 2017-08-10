<?php

namespace App\Http\Controllers;

use Awok\Foundation\Controller;
use App\Features\ListCurrencyFeature;
use App\Features\GetCurrencyFeature;
use App\Features\CreateCurrencyFeature;
use App\Features\UpdateCurrencyFeature;
use App\Features\DeleteCurrencyFeature;


class CurrenciesController extends Controller
{
    public function index()
    {
        return $this->serve(ListCurrencyFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetCurrencyFeature::class, ['objectID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateCurrencyFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateCurrencyFeature::class, ['objectID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteCurrencyFeature::class, ['objectID' => $id]);
    }
}