<?php 

namespace App\Services;

use App\Interfaces\ApiCoinsInterface;
use App\Domains\BcbDomain;

use App\Objects\CurrencyQuoteObject;

use GuzzleHttp\Client;

class BcbService implements ApiCoinsInterface, BcbDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }
    
    public function callApi(CurrencyQuoteObject $CurrencyQuote) : CurrencyQuoteObject
    {
        

        $url = self::URL_START . "'" . $this->getYesterday() . "'" . self::URL_END;
        $request = $this->httpClient->get($url);

        $requestJson = json_decode($request->getBody()->getContents());

        $CurrencyQuote->setValue($requestJson->value[0]->cotacaoCompra);
        $CurrencyQuote->setDate($requestJson->value[0]->dataHoraCotacao);

        return $CurrencyQuote;
    }

    public function getYesterday() : string 
    {
        return date('m-d-Y',mktime(0,0,0,date("m"),date("d")- 1 ,date("Y")));
    }
}
