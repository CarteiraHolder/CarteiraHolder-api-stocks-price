<?php

namespace App\Interfaces\Coin;

use App\Objects\Coin\CurrencyQuoteCoinObject;

interface ApiCoinsInterface 
{
    public function callApi(CurrencyQuoteCoinObject $Coin) : CurrencyQuoteCoinObject;
}