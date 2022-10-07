<?php

namespace App\Services;

use App\Interfaces\ApiCoinsInterface;
use App\Objects\CoinObject;

class CoinPriceService
{
    private ApiCoinsInterface $ApiCoins;
    private CoinObject $Coin;

    public function __construct(ApiCoinsInterface $ApiCoins, CoinObject $Coin)
    {
        $this->setApiCoins($ApiCoins);
        $this->Coin = $Coin;
    }

    public function setApiCoins(ApiCoinsInterface $ApiCoins) : void
    {
        $this->ApiCoins = $ApiCoins;
    }

    public function getApiCoins() : ApiCoinsInterface
    {
        return $this->ApiCoins;
    }

    public function getPrice() : CoinObject 
    {
        $this->getApiCoins()->callApi($this->Coin);
        return $this->Coin;
    }
    
}
