<?php

namespace App\Services\BrazilionStock;

use App\Interfaces\BrazilionStock\ApiBrazilionStockInterface;
use App\Objects\BrazilionStock\BrazilionStockObject;
use App\Domains\BrazilionStock\HgbrasilDomain;

use GuzzleHttp\Client;

class HgbrasilService implements ApiBrazilionStockInterface, HgbrasilDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
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

        $Stock->setValue($requestJson->results->{$Stock->getCode()}->price);
        $Stock->getCoin()->setCode($requestJson->results->{$Stock->getCode()}->currency);
        $Stock->setDate($requestJson->results->{$Stock->getCode()}->updated_at);

        return $Stock;
    }

}
