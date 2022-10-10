<?php

namespace App\Interfaces\Coin;

use App\Objects\Coin\CurrencyQuoteObject;

interface ApiCoinsInterface 
{
    public function callApi(CurrencyQuoteObject $Coin) : CurrencyQuoteObject;
}