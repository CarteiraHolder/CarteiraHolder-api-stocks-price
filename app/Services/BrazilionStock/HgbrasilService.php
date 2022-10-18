<?php

namespace App\Services\BrazilionStock;

use App\Interfaces\BrazilionStock\ApiBrazilionStockInterface;
use App\Objects\BrazilionStock\BrazilionStockObject;
use App\Domains\BrazilionStock\HgbrasilDomain;

use App\Services\Sector\SectorService;

use GuzzleHttp\Client;

class HgbrasilService extends SectorService implements ApiBrazilionStockInterface, HgbrasilDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        parent::__construct($httpClient);
        $this->httpClient = $httpClient;
    }

    public function callApi(BrazilionStockObject $Stock) : BrazilionStockObject
    {

        $url = self::URL;
        $url .= "?key=" . self::API_KEY;
        $url .= "&symbol=" . $Stock->getCode() ;
        
        try {
            $request = $this->httpClient->get($url);
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Stock;
        }

        if(isset($requestJson->results->{$Stock->getCode()}->error)){
            return $Stock;
        }

        $StockJson = $requestJson->results->{$Stock->getCode()};

        $Stock->setValue($StockJson->price);
        $Stock->getCoin()->setCode($StockJson->currency);
        $Stock->setDate($StockJson->updated_at);

        $Stock->setName($StockJson->company_name);
        $Stock->setCnpj($StockJson->document);

        return $Stock;
    }

}
