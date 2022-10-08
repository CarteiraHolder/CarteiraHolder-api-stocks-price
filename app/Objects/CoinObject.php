<?php 

namespace App\Objects;

class CoinObject
{
    private float $value;

    public function __construct()
    {
        $this->setValue(0);
    }

    public function setValue(float $value) : void
    {
        $this->value =$value; 
    }

    public function getValue() : float
    {
        return $this->value;
    }
}
