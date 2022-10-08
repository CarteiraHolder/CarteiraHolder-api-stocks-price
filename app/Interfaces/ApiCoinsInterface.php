<?php

namespace App\Interfaces;

use App\Objects\CurrencyQuoteObject;

interface ApiCoinsInterface 
{
    public function callApi(CurrencyQuoteObject $Coin) : CurrencyQuoteObject;
}