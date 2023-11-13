<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PunkApiService
{
    public function getBeers(
        ?string $beer_name = null,
        ?string $food = null,
        ?string $malt = null,
        ?int $ibu_gt = null
    )
    {
        //FIXME:: underline não é boa pratica no PHP,
        //mais estamos resgatando pelo nome da variavel e usando o get_defined_vars

        $params = array_filter(get_defined_vars());

        return Http::punkapi()->get('/beers', $params)->throw()->json();
    }
}