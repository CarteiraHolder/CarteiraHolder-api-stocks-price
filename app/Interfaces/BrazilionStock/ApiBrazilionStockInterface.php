<?php

namespace App\Interfaces\BrazilionStock;

use App\Objects\BrazilionStock\BrazilionStockObject;

interface ApiBrazilionStockInterface 
{
    public function callApi(BrazilionStockObject $Stock) : BrazilionStockObject;
}