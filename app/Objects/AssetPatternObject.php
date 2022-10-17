<?php 

namespace App\Objects;

use App\Objects\Coin\CurrencyQuoteCoinObject;

class AssetPatternObject
{
    private string $code;
    private float $value;
    private string $date;
    private string $name;
    private string $sector;
    private string $subsector;
    private string $segment;
    private CurrencyQuoteCoinObject $coin;

    public function __construct(CurrencyQuoteCoinObject $coin)
    {
        $this->setCoin($coin);
        $this->setCode('BRL');
        $this->setValue(0);
        $this->setDate(date('Y-m-d h:i:s'));
        $this->setName('');
        $this->setSector('');
        $this->setSubsector('');
        $this->setSegment('');
    }
    
    public function setCode(string $code) : void
    {
        $this->code = strtoupper($code);
    }

    public function setValue(float $value) : void
    {
        $this->value = $value;
    }

    public function setDate(string $date) : void
    {
        $this->date = $date;
    }

    public function setCoin(CurrencyQuoteCoinObject $coin) : void
    {
        $this->coin = $coin;
    }

    public function setName($name) : void
    {
        $this->name = $name;
    }

    public function setSector($sector) : void
    {
        $this->sector = $sector;
    }

    public function setSubsector($subsector) : void
    {
        $this->subsector = $subsector;
    }

    public function setSegment($segment) : void
    {
        $this->segment = $segment;
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getValue() : float
    {
        return $this->value;
    }

    public function getDate() : string
    {
        return $this->date;
    }

    public function getCoin() : CurrencyQuoteCoinObject
    {
        return $this->coin;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getValueInBrl() : float
    {
        return $this->value * $this->getCoin()->getValue();
    }

     public function GetSector() : string
    {
        return $this->sector;
    }

    public function GetSubsector() : string
    {
        return $this->subsector;
    }

    public function GetSegment() : string
    {
        return $this->segment;
    }
}
