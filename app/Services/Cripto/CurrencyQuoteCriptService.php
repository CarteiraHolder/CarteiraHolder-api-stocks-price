<?php

namespace App\Services\Cripto;

use App\Interfaces\Cripto\ApiCriptoInterface;
use App\Objects\Cripto\CriptoObject;

class CurrencyQuoteCriptService
{
    private ApiCriptoInterface $ApiCriptos;
    private CriptoObject $CurrencyQuote;

    public function __construct(ApiCriptoInterface $ApiCriptos, CriptoObject $CurrencyQuote)
    {
        $this->setApiCriptos($ApiCriptos);
        $this->CurrencyQuote = $CurrencyQuote;
    }

    public function setApiCriptos(ApiCriptoInterface $ApiCriptos) : void
    {
        $this->ApiCriptos = $ApiCriptos;
    }

    public function getApiCriptos() : ApiCriptoInterface
    {
        return $this->ApiCriptos;
    }

    public function getPrice() : CriptoObject 
    {
        $this->getApiCriptos()->callApi($this->CurrencyQuote);
        return $this->CurrencyQuote;
    }
    
}
