<?php

// priceFilter.php

namespace App\Filter;

class PriceFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('prezzo_al_pezzo', $value);
    }
}