<?php

namespace App\Services\Cripto;

use App\Interfaces\Cripto\ApiCriptoInterface;
use App\Objects\Cripto\CriptoObject;
use App\Domains\Cripto\PolygonDomain;

use GuzzleHttp\Client;

class PolygonService implements ApiCriptoInterface, PolygonDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function callApi(CriptoObject $Stock) : CriptoObject
    {

        $url = self::URL . $Stock->getCode() . "/USD/" . $this->getYesterday() . "?adjusted=true";

        try {
            $request = $this->httpClient->get(
                $url,
                [ 'headers' => [ 'Authorization' => "Bearer " . self::API_KEY ] ]
            );

            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Stock;
        }

        $Stock->setValue($requestJson->open);
        $Stock->getCoin()->setCode("USD");

        return $Stock;
    }

    private function getYesterday() : string 
    {
        return date('Y-m-d',mktime(0,0,0,date("m"),date("d") - 1 ,date("Y")));
    }
}
