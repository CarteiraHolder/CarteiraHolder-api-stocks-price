<?php

namespace App\Services\BrazilionStock;

use App\Interfaces\BrazilionStock\ApiBrazilionStockInterface;
use App\Objects\BrazilionStock\BrazilionStockObject;
use App\Domains\BrazilionStock\YahoofinanceDomain;

use GuzzleHttp\Client;

class YahoofinanceBrazilionStockService implements ApiBrazilionStockInterface, YahoofinanceDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function callApi(BrazilionStockObject $Stock) : BrazilionStockObject
    {

        $url = self::URL_START . $Stock->getCode() . self::STOCK_ACRONYM . self::URL_END;
        
        try {
            $request = $this->httpClient->get($url);
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Stock;
        }

        $Stock->setValue($requestJson->chart->result[0]->meta->regularMarketPrice);
        $Stock->getCoin()->setCode($requestJson->chart->result[0]->meta->currency);

        return $Stock;
    }
}
