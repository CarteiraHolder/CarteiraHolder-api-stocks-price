<?php 

namespace App\Services;

use App\Interfaces\ApiCoinsInterface;
use App\Domains\AwesomeapiDomain;

use App\Objects\CurrencyQuoteObject;

use GuzzleHttp\Client;

class AwesomeapiService implements ApiCoinsInterface, AwesomeapiDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }
    
    public function callApi(CurrencyQuoteObject $CurrencyQuote) : CurrencyQuoteObject
    {
        $exchange = $CurrencyQuote->GetCode() . '-' . $CurrencyQuote->GetCodeIn();
        $node = $CurrencyQuote->GetCode() . $CurrencyQuote->GetCodeIn();

        $request = $this->httpClient->get(self::URL . $exchange);

        $requestJson = json_decode($request->getBody()->getContents());

        $CurrencyQuote->setValue($requestJson->{$node}->bid);
        $CurrencyQuote->setDate($requestJson->{$node}->create_date);

        return $CurrencyQuote;
    }
}
