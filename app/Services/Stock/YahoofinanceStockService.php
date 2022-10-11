<?php

namespace App\Services\Stock;

use App\Interfaces\Stock\ApiStockInterface;
use App\Objects\Stock\StockObject;
use App\Domains\Stock\YahoofinanceDomain;

use GuzzleHttp\Client;

class YahoofinanceStockService implements ApiStockInterface, YahoofinanceDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function callApi(StockObject $Stock) : StockObject
    {

        $url = self::URL_START . $Stock->getCode() . self::URL_END;
        
        try {
            $request = $this->httpClient->get($url);
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Stock;
        }

        // print_r($requestJson);

        $Stock->setValue($requestJson->chart->result[0]->meta->regularMarketPrice);
        $Stock->getCoin()->setCode($requestJson->chart->result[0]->meta->currency);

        return $Stock;
    }
}
