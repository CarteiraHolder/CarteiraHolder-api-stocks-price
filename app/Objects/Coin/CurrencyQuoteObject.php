<?php

namespace App\Objects\Coin;

use App\Objects\Coin\CoinObject;

class CurrencyQuoteObject extends CoinObject
{
    private string $code;
    private string $codeIn;
    private string $date;

    public function __construct()
    {
        $this->setCode("USD");
        $this->setCodeIn("BRL");
        $this->setDate(date("Y-m-d H:i:s"));
        $this->setValue(0);   
    }

    public function setCode(string $code) : void
    {
        $this->code = strtoupper($code);
    }

    private function setCodeIn(string $codeIn) : void
    {
        $this->codeIn = strtoupper($codeIn);
    }

    public function setDate(string $date) : void
    {
        $this->date = strtoupper($date);
    }

    public function getCode() : string
    {
        return $this->code;
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
