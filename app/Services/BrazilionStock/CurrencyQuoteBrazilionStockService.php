<?php

namespace App\Services\BrazilionStock;

use App\Interfaces\BrazilionStock\ApiBrazilionStockInterface;
use App\Objects\BrazilionStock\BrazilionStockObject;

class CurrencyQuoteBrazilionStockService
{
    private ApiBrazilionStockInterface $ApiStock;
    private BrazilionStockObject $CurrencyQuote;

    public function __construct(ApiBrazilionStockInterface $ApiStock, BrazilionStockObject $CurrencyQuote)
    {
        $this->setApiStock($ApiStock);
        $this->CurrencyQuote = $CurrencyQuote;
    }

    public function setApiStock(ApiBrazilionStockInterface $ApiStock) : void
    {
        $this->ApiStock = $ApiStock;
    }

    public function getApiStock() : ApiBrazilionStockInterface
    {
        return $this->ApiStock;
    }

    public function getPrice() : BrazilionStockObject 
    {
        $this->getApiStock()->callApi($this->CurrencyQuote);
        return $this->CurrencyQuote;
    }
    
}
