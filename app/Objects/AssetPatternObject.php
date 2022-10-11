<?php 

namespace App\Objects;

use App\Objects\Coin\CurrencyQuoteCoinObject;

class AssetPatternObject
{
    private string $code;
    private float $value;
    private CurrencyQuoteCoinObject $coin;

    public function __construct(CurrencyQuoteCoinObject $coin)
    {
        $this->setCoin($coin);
        $this->setCode('BRL');
        $this->setValue(0);
    }
    
    public function setCode(string $code) : void
    {
        $this->code = strtoupper($code);
    }

    public function setValue(float $value) : void
    {
        $this->value = $value;
    }

    public function setCoin(CurrencyQuoteCoinObject $coin) : void
    {
        $this->coin = $coin;
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getValue() : float
    {
        return $this->value;
    }

    public function getCoin() : CurrencyQuoteCoinObject
    {
        return $this->coin;
    }

    public function getValueInBrl() : float
    {
        return $this->value * $this->getCoin()->getValue();
    }
}
