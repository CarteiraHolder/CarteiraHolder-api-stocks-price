<?php 

namespace App\Objects\Coin;

class CoinObject
{
    private string $code;
    private float $value;

    public function __construct()
    {
        $this->setCode("BRL");
        $this->setValue(1);
    }

    public function setCode(string $code) : void
    {
        $this->code = strtoupper($code);
    }

    public function setValue(float $value) : void
    {
        $this->value = $value; 
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getValue() : float
    {
        return $this->value;
    }
}
