<?php

namespace App\Services;

use App\Interfaces\ApiCoinsInterface;
use App\Objects\CurrencyQuoteObject;

class CurrencyQuoteService
{
    private ApiCoinsInterface $ApiCoins;
    private CurrencyQuoteObject $CurrencyQuote;

    public function __construct(ApiCoinsInterface $ApiCoins, CurrencyQuoteObject $CurrencyQuote)
    {
        $this->setApiCoins($ApiCoins);
        $this->CurrencyQuote = $CurrencyQuote;
    }

    public function setApiCoins(ApiCoinsInterface $ApiCoins) : void
    {
        $this->ApiCoins = $ApiCoins;
    }

    public function getApiCoins() : ApiCoinsInterface
    {
        return $this->ApiCoins;
    }

    public function getPrice() : CurrencyQuoteObject 
    {
        $this->getApiCoins()->callApi($this->CurrencyQuote);
        return $this->CurrencyQuote;
    }
    
}
