<?php 

namespace App\Services\Coin;

use App\Interfaces\Coin\ApiCoinsInterface;
use App\Domains\Coin\AwesomeapiDomain;

use App\Objects\Coin\CurrencyQuoteCoinObject;

use GuzzleHttp\Client;

class AwesomeapiService implements ApiCoinsInterface, AwesomeapiDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }
    
    public function callApi(CurrencyQuoteCoinObject $CurrencyQuote) : CurrencyQuoteCoinObject
    {
        $exchange = $CurrencyQuote->GetCode() . '-' . $CurrencyQuote->GetCodeIn();
        $node = $CurrencyQuote->GetCode() . $CurrencyQuote->GetCodeIn();

        try {
            $request = $this->httpClient->get(self::URL . $exchange);
        } catch (\Throwable $th) {
            return $CurrencyQuote;
        }

        $requestJson = json_decode($request->getBody()->getContents());

        $CurrencyQuote->setValue($requestJson->{$node}->bid);
        $CurrencyQuote->setDate($requestJson->{$node}->create_date);

        return $CurrencyQuote;
    }
}
