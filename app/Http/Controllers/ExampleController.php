<?php

namespace App\Http\Controllers;

use App\Features\ExampleFeature;
use Awok\Foundation\Controller;

class ExampleController extends Controller
{
    public function index()
    {
        return $this->serve(ExampleFeature::class, ['data' => 'dummy data']);
    }
}
