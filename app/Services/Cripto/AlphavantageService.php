<?php

namespace App\Services\Cripto;

use App\Interfaces\Cripto\ApiCriptoInterface;
use App\Objects\Cripto\CriptoObject;
use App\Domains\Cripto\AlphavantageDomain;

use GuzzleHttp\Client;

class AlphavantageService implements ApiCriptoInterface, AlphavantageDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function callApi(CriptoObject $Cripto) : CriptoObject
    {

        $url = self::URL_START . $Cripto->getCode() . self::URL_END . self::API_KEY;
        $request = $this->httpClient->get($url);

        try {
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Cripto;
        }

        print_r($requestJson);

        return $Cripto;
    }
}
