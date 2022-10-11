<?php

namespace App\Services\Cripto;

use App\Interfaces\Cripto\ApiCriptoInterface;
use App\Objects\Cripto\CriptoObject;
use App\Domains\Cripto\YahoofinanceDomain;

use GuzzleHttp\Client;

class YahoofinanceService implements ApiCriptoInterface, YahoofinanceDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function callApi(CriptoObject $Cripto) : CriptoObject
    {

        $url = self::URL_START . $Cripto->getCode() . "-USD" . self::URL_END;
        
        try {
            $request = $this->httpClient->get($url);
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Cripto;
        }

        $Cripto->setValue($requestJson->chart->result[0]->meta->regularMarketPrice);
        $Cripto->getCoin()->setCode($requestJson->chart->result[0]->meta->currency);

        return $Cripto;
    }
}
