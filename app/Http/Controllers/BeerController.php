<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeerRequest;
use App\Services\PunkApiService;

class BeerController extends Controller
{
    public function index(BeerRequest $request, PunkApiService $service)
    {
        return $service->getBeers(...$request->validated());
    }
}
