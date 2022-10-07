<?php

namespace App\Objects;

class CoinObject
{
    private string $code;
    private string $name;
    private float $price;

    public function __construct()
    {
        $this->setCode('');
        $this->setName('');
        $this->setPrice(0);   
    }

    public function setCode(string $code) : void
    {
        $this->code = $code;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function setPrice(float $price) : void
    {
        $this->price = $price;
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getPrice() : float 
    {
        return $this->price;
    }
    
}
