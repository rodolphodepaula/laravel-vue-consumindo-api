<?php

namespace App\Http\Controllers;

use App\Exports\BeerExport;
use App\Http\Requests\BeerRequest;
use App\Services\PunkApiService;
use Maatwebsite\Excel\Facades\Excel;

class BeerController extends Controller
{
    private $service;
    public function __construct(PunkApiService $service)
    {
        $this->service = $service;
    }

    public function index(BeerRequest $request)
    {
        return $this->service->getBeers(...$request->validated());
    }

    public function export(BeerRequest $request)
    {

       $beers = $this->service->getBeers(...$request->validated());

       $filteredBeers = collect($beers)->map(function($value, $key) {
        return collect($value)
            ->only(['name', 'tagline', 'first_brewed', 'description'])
            ->toArray();
       })->toArray();

        Excel::store(
            new BeerExport( $filteredBeers),
            'beer_report.xlsx',
            's3'
        );

        return 'relatorio criad';
    }
}
