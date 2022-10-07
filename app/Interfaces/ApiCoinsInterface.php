<?php

namespace App\Interfaces;

use App\Objects\CoinObject;

interface ApiCoinsInterface 
{
    public function callApi(CoinObject $Coin) : CoinObject;
}