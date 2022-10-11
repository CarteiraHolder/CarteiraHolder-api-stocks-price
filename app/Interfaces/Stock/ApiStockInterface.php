<?php

namespace App\Interfaces\Stock;

use App\Objects\Stock\StockObject;

interface ApiStockInterface 
{
    public function callApi(StockObject $Stock) : StockObject;
}