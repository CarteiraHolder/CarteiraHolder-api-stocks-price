<?php

namespace App\Services\Cripto;

use App\Interfaces\Cripto\ApiCriptoInterface;
use App\Objects\Cripto\CriptoObject;
use App\Domains\Cripto\CoinmarketcapDomain;

use GuzzleHttp\Client;

class CoinmarketcapService implements ApiCriptoInterface, CoinmarketcapDomain
{
    private Client $httpClient;

    public function __construct(Client $httpClient) {
        $this->httpClient = $httpClient;
    }

    public function callApi(CriptoObject $Cripto) : CriptoObject
    {

        $url = self::URL;
        $request = $this->httpClient->get($url);

        try {
            $requestJson = json_decode($request->getBody()->getContents());
        } catch (\Throwable $th) {
            return $Cripto;
        }

        $requestFind = $this->search($Cripto->getCode(), $requestJson->data->cryptoCurrencyList);

        $Cripto->setValue($requestFind->quotes[0]->price);
        $Cripto->getCoin()->setCode($requestFind->quotes[0]->name);

        return $Cripto;
    }

    private function search(string $code, array $array) : object
    {
        $result = (object) null;
        foreach ($array as $object) {
            if ($object->symbol === $code) {
                $result = $object;
                break;
            }
        }
        unset($object);
        return $result;
    }
}
