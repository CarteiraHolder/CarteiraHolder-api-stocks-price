<?php

namespace App\Services\Stock;

use App\Interfaces\Stock\ApiStockInterface;
use App\Objects\Stock\StockObject;

class CurrencyQuoteStockService
{
    private ApiStockInterface $ApiStock;
    private StockObject $CurrencyQuote;

    public function __construct(ApiStockInterface $ApiStock, StockObject $CurrencyQuote)
    {
        $this->setApiStock($ApiStock);
        $this->CurrencyQuote = $CurrencyQuote;
    }

    public function setApiStock(ApiStockInterface $ApiStock) : void
    {
        $this->ApiStock = $ApiStock;
    }

    public function getApiStock() : ApiStockInterface
    {
        return $this->ApiStock;
    }

    public function getPrice() : StockObject 
    {
        $this->getApiStock()->callApi($this->CurrencyQuote);
        return $this->CurrencyQuote;
    }
    
}
