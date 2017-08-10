<?php

namespace App\Http\Controllers;

use Awok\Foundation\Controller;
use App\Features\ListOptionFeature;
use App\Features\GetOptionFeature;
use App\Features\CreateOptionFeature;
use App\Features\UpdateOptionFeature;
use App\Features\DeleteOptionFeature;


class OptionsController extends Controller
{
    public function index()
    {
        return $this->serve(ListOptionFeature::class);
    }

    public function get($id)
    {
        return $this->serve(GetOptionFeature::class, ['objectID' => $id]);
    }

    public function create()
    {
        return $this->serve(CreateOptionFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateOptionFeature::class, ['objectID' => $id]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteOptionFeature::class, ['objectID' => $id]);
    }
}