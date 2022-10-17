<?php

namespace App\Services\Stock;

use App\Interfaces\Stock\ApiStockInterface;
use App\Objects\Stock\StockObject;
use App\Domains\Stock\YahoofinanceDomain;

use App\Services\Sector\SectorService;

use GuzzleHttp\Client;

class YahoofinanceStockService extends SectorService implements ApiStockInterface, YahoofinanceDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        parent::__construct($httpClient);
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

        $StockJson = $requestJson->quoteSummary->result[0]->price;

        $Stock->setValue($StockJson->regularMarketPreviousClose->raw);
        $Stock->getCoin()->setCode($StockJson->currency);

        $Stock->setName($StockJson->longName);

        $this->getSector($Stock->getCode(), $Stock);

        return $Stock;
    }
}
