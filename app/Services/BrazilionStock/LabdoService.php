<?php

namespace App\Services\BrazilionStock;

use App\Interfaces\BrazilionStock\ApiBrazilionStockInterface;
use App\Objects\BrazilionStock\BrazilionStockObject;
use App\Domains\BrazilionStock\LabdoDomain;

use GuzzleHttp\Client;

class LabdoService implements ApiBrazilionStockInterface, LabdoDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function callApi(BrazilionStockObject $Stock) : BrazilionStockObject
    {

        $url = self::URL . $Stock->getCode() . "/" . self::COUNT_RETURN;
        
        try {
            $request = $this->httpClient->get($url);
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Stock;
        }

        $Stock->setValue($requestJson[0]->vl_fechamento);
        $Stock->getCoin()->setCode($this->CoinRef($requestJson[0]->moeda_ref));

        return $Stock;
    }

    private function CoinRef(string $ref) : string
    {
        if($ref == "R$") return 'BRL';
        return 'USD';
    }
}
