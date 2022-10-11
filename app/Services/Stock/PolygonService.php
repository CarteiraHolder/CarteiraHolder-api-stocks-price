<?php

namespace App\Services\Stock;

use App\Interfaces\Stock\ApiStockInterface;
use App\Objects\Stock\StockObject;
use App\Domains\Stock\PolygonDomain;

use GuzzleHttp\Client;

class PolygonService implements ApiStockInterface, PolygonDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function callApi(StockObject $Stock) : StockObject
    {

        $url = self::URL . $Stock->getCode() . "/" . $this->getYesterday();
        
        try {
            $request = $this->httpClient->get(
                $url,
                [ 'headers' => [ 'Authorization' => "Bearer " . self::API_KEY ] ]
            );

            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Stock;
        }

        $Stock->setValue($requestJson->preMarket);
        $Stock->getCoin()->setDate($requestJson->from);
        $Stock->getCoin()->setCode("USD");

        return $Stock;
    }

    private function getYesterday() : string 
    {
        return date('Y-m-d',mktime(0,0,0,date("m"),date("d") - 1 ,date("Y")));
    }
}
