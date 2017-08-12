<?php

namespace App\Http\Controllers;

use Awok\Foundation\Controller;
use App\Features\ListCountryFeature;
use App\Features\GetCountryFeature;
use App\Features\CreateCountryFeature;
use App\Features\UpdateCountryFeature;
use App\Features\DeleteCountryFeature;


class CountriesController extends Controller
{
    public function index()
    {
        return $this->serve(ListCountryFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetCountryFeature::class, ['objectID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateCountryFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateCountryFeature::class, ['objectID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteCountryFeature::class, ['objectID' => $id]);
    }
}