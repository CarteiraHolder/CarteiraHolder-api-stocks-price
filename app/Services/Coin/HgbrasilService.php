<?php 

namespace App\Services\Coin;

use App\Interfaces\Coin\ApiCoinsInterface;
use App\Domains\Coin\HgbrasilDomain;

use App\Objects\Coin\CurrencyQuoteObject;

use GuzzleHttp\Client;

class HgbrasilService implements ApiCoinsInterface, HgbrasilDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }
    
    public function callApi(CurrencyQuoteObject $CurrencyQuote) : CurrencyQuoteObject
    {
        $request = $this->httpClient->get(self::URL);

        try {
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $CurrencyQuote;
        }

        if($this->NotKeyInJson($CurrencyQuote, $requestJson)){
            return $CurrencyQuote;
        }

        $CurrencyQuote->setValue(
            $requestJson->results->currencies->{$CurrencyQuote->GetCode()}->buy
        );

        return $CurrencyQuote;
    }

    private function NotKeyInJson(CurrencyQuoteObject $CurrencyQuote, object $requestJson) : bool
    {
        return !property_exists($requestJson->results->currencies,$CurrencyQuote->GetCode());
    }
}
