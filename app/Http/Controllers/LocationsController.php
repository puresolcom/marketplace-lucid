<?php

namespace App\Http\Controllers;

use Awok\Foundation\Controller;
use App\Features\ListLocationFeature;
use App\Features\GetLocationFeature;
use App\Features\CreateLocationFeature;
use App\Features\UpdateLocationFeature;
use App\Features\DeleteLocationFeature;


class LocationsController extends Controller
{
    public function index()
    {
        return $this->serve(ListLocationFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetLocationFeature::class, ['objectID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateLocationFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateLocationFeature::class, ['objectID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteLocationFeature::class, ['objectID' => $id]);
    }
}