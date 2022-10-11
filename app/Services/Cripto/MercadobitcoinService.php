<?php

namespace App\Services\Cripto;

use App\Interfaces\Cripto\ApiCriptoInterface;
use App\Objects\Cripto\CriptoObject;
use App\Domains\Cripto\MercadobitcoinDomain;

use GuzzleHttp\Client;

class MercadobitcoinService implements ApiCriptoInterface, MercadobitcoinDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function callApi(CriptoObject $Cripto) : CriptoObject
    {

        $url = self::URL_START . $Cripto->getCode() . self::URL_END;
        
        try {
            $request = $this->httpClient->get($url);
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Cripto;
        }

        $Cripto->setValue($requestJson->ticker->last);
        $Cripto->getCoin()->setCode('BRL');

        return $Cripto;
    }
}
