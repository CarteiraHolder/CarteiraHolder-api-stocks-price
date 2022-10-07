<?php 

namespace App\Services;

use App\Interfaces\ApiCoinsInterface;
use App\Domains\AwesomeapiDomain;

use App\Objects\CoinObject;

use GuzzleHttp\Client;

class AwesomeapiService implements ApiCoinsInterface, AwesomeapiDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }
    
    public function callApi(CoinObject $Coin) : CoinObject
    {
        $request = $this->httpClient->get(self::URL . 'USD-BRL');

        $requestJson = json_decode($request->getBody()->getContents());

        $Coin->setCode($requestJson->USDBRL->code);
        $Coin->setName($requestJson->USDBRL->name);
        $Coin->setPrice($requestJson->USDBRL->bid);

        return $Coin;
    }
}
