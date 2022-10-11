<?php

namespace App\Services\Coin;

use App\Interfaces\Coin\ApiCoinsInterface;
use App\Objects\Coin\CurrencyQuoteCoinObject;

class CurrencyQuoteService
{
    private ApiCoinsInterface $ApiCoins;
    private CurrencyQuoteCoinObject $CurrencyQuote;

    public function __construct(ApiCoinsInterface $ApiCoins, CurrencyQuoteCoinObject $CurrencyQuote)
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

    public function getPrice() : CurrencyQuoteCoinObject 
    {
        $this->getApiCoins()->callApi($this->CurrencyQuote);
        return $this->CurrencyQuote;
    }
    
}
