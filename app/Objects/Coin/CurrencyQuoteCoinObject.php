<?php

namespace App\Objects\Coin;

use App\Objects\Coin\CoinObject;

class CurrencyQuoteCoinObject extends CoinObject
{
    private string $codeIn;
    private string $date;

    public function __construct()
    {
        $this->setCode("BRL");
        $this->setCodeIn("BRL");
        $this->setDate(date("Y-m-d H:i:s"));
        $this->setValue(1);   
    }

    private function setCodeIn(string $codeIn) : void
    {
        $this->codeIn = strtoupper($codeIn);
    }

    public function setDate(string $date) : void
    {
        $this->date = strtoupper($date);
    }

    public function getCodeIn() : string
    {
        return $this->codeIn;
    }

    public function getDate() : string
    {
        return $this->date;
    }
    
}
