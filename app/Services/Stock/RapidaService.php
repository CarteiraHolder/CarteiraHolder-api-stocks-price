<?php

namespace App\Services\Stock;

use App\Interfaces\Stock\ApiStockInterface;
use App\Objects\Stock\StockObject;
use App\Domains\Stock\RapidapiDomain;

use App\Services\Sector\SectorService;

use GuzzleHttp\Client;

class RapidaService extends SectorService implements ApiStockInterface, RapidapiDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        parent::__construct($httpClient);
        $this->httpClient = $httpClient;
    }

    public function callApi(StockObject $Stock) : StockObject
    {
        $url = self::URL . "?";
        $url .= "function=" . self::API_FUNC;
        $url .= "&symbol=" . $Stock->getCode();
        $url .= "&datatype=" . self::API_DATA_TYPE;
        $url .= "&output_size=" . self::API_OUTPUTSIZE;
        
        try {
            $request = $this->httpClient->get(
                $url,
                [ 
                    'headers' => [ 
                        'X-RapidAPI-Key' =>  self::API_X_RAPID_API_KEY,
                        'X-RapidAPI-Host' =>  self::API_X_RAPID_API_HOST,
                    ] 
                ]
            );

            $requestJson = json_decode($request->getBody()->getContents());

            $Stock->setValue($requestJson->{self::NODE}->{$this->getYesterday()}->{self::NODE_VALUE});
            $Stock->getCoin()->setCode("USD");
        } catch (\Throwable $th) {
            return $Stock;
        }

        return $Stock;
    }

    private function getYesterday() : string 
    {
        return date('Y-m-d',mktime(0,0,0,date("m"),date("d") - 3 ,date("Y")));
    }
}
