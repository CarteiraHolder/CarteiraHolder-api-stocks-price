<?php 

namespace App\Objects\BrazilionStock;

use App\Objects\AssetPatternObject;
use App\Objects\Coin\CurrencyQuoteCoinObject;

class BrazilionStockObject extends AssetPatternObject 
{
    private string $name;
    private string $cnpj;
    private string $sector;
    private string $subsector;
    private string $segment;

    public function __construct(CurrencyQuoteCoinObject $coin)
    {
        parent::__construct($coin);
        $this->setName('');
        $this->setCnpj('');
        $this->setSector('');
        $this->setSubsector('');
        $this->setSegment('');
    }

    public function setName($name) : void
    {
        $this->name = $name;
    }

    public function setCnpj($cnpj) : void
    {
        $this->cnpj = $cnpj;
        $this->cnpj = str_replace(".","",$this->cnpj);
        $this->cnpj = str_replace("/","",$this->cnpj);
        $this->cnpj = str_replace("-","",$this->cnpj);
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

    public function GetName() : string
    {
        return $this->name;
    }

    public function GetCnpj() : string
    {
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5",  $this->cnpj);
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
