<?php 

namespace App\Objects\BrazilionStock;

use App\Objects\AssetPatternObject;
use App\Objects\Coin\CurrencyQuoteCoinObject;

class BrazilionStockObject extends AssetPatternObject 
{
    private string $cnpj;

    public function __construct(CurrencyQuoteCoinObject $coin)
    {
        parent::__construct($coin);
        $this->setCnpj('');
    }

    public function setCnpj($cnpj) : void
    {
        $this->cnpj = $cnpj;
        $this->cnpj = str_replace(".","",$this->cnpj);
        $this->cnpj = str_replace("/","",$this->cnpj);
        $this->cnpj = str_replace("-","",$this->cnpj);
    }

    public function getCnpj() : string
    {
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5",  $this->cnpj);
    }

}
