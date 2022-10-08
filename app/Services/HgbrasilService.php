<?php 

namespace App\Services;

use App\Interfaces\ApiCoinsInterface;
use App\Domains\HgbrasilDomain;

use App\Objects\CurrencyQuoteObject;

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

        $requestJson = json_decode($request->getBody()->getContents());
        
        $CurrencyQuote->setValue(
            $requestJson->results->currencies->{$CurrencyQuote->GetCode()}->buy
        );

        return $CurrencyQuote;
    }
}
