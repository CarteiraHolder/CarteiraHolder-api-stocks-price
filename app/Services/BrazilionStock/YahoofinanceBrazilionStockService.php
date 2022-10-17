<?php

namespace App\Services\BrazilionStock;

use App\Interfaces\BrazilionStock\ApiBrazilionStockInterface;
use App\Objects\BrazilionStock\BrazilionStockObject;
use App\Domains\BrazilionStock\YahoofinanceDomain;

use App\Services\Sector\SectorService;

use GuzzleHttp\Client;

class YahoofinanceBrazilionStockService extends SectorService implements ApiBrazilionStockInterface, YahoofinanceDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        parent::__construct($httpClient);
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

        $StockJson = $requestJson->quoteSummary->result[0]->price;

        $Stock->setValue($StockJson->regularMarketPreviousClose->raw);
        $Stock->getCoin()->setCode($StockJson->currency);

        $Stock->setName($StockJson->longName);

        $this->getSector($Stock->getCode(), $Stock);

        return $Stock;
    }
}
