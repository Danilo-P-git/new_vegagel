<?php

// ProductFilter.php

namespace App\Filter;

use App\Filter\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    protected $filters = [
        'prezzo_al_pezzo' => PriceFilter::class
    ];
}